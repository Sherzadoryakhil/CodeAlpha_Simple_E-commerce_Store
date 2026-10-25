<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $products = Product::whereIn('id', array_keys($cart))->get();

        $items = $products->map(fn($p) => [
            'product'  => $p,
            'quantity' => $cart[$p->id],
            'subtotal' => $p->price * $cart[$p->id],
        ]);

        $total = $items->sum('subtotal');

        return view('orders.checkout', compact('items', 'total'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'shipping_name'    => 'required|string|max:255',
            'shipping_phone'   => 'required|string|max:30',
            'shipping_address' => 'required|string|max:1000',
        ]);

        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        try {
            $order = DB::transaction(function () use ($cart, $data, $request) {
                // Lock rows so two buyers can't take the same stock
                $products = Product::whereIn('id', array_keys($cart))
                    ->lockForUpdate()
                    ->get();
                if ($products->count() !== count($cart)) {
                    throw new \Exception('Some products in your cart are no longer available.');
                }

                $total = 0;

                foreach ($products as $product) {
                    if ($cart[$product->id] > $product->stock) {
                        throw new \Exception("Not enough stock for {$product->name}.");
                    }
                    $total += $product->price * $cart[$product->id];
                }

                $order = Order::create([
                    'user_id'          => $request->user()->id,
                    'total'            => $total,
                    'status'           => 'pending',
                    'shipping_name'    => $data['shipping_name'],
                    'shipping_phone'   => $data['shipping_phone'],
                    'shipping_address' => $data['shipping_address'],
                ]);

                foreach ($products as $product) {
                    $order->items()->create([
                        'product_id' => $product->id,
                        'name'       => $product->name,
                        'price'      => $product->price,
                        'quantity'   => $cart[$product->id],
                    ]);

                    $product->decrement('stock', $cart[$product->id]);
                }

                return $order;
            });
        } catch (\Exception $e) {
            return redirect()->route('cart.index')->with('error', $e->getMessage());
        }

        session()->forget('cart');

        return redirect()->route('orders.show', $order)
            ->with('success', 'Order placed successfully!');
    }

    public function index(Request $request)
    {
        $orders = $request->user()->orders()->latest()->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function show(Request $request, Order $order)
    {
        abort_unless($order->user_id === $request->user()->id, 403);

        $order->load('items');

        return view('orders.show', compact('order'));
    }
}
