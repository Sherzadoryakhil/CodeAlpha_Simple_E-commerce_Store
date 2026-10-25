<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $products = Product::whereIn('id', array_keys($cart))->get();

        $items = $products->map(fn($p) => [
            'product'  => $p,
            'quantity' => $cart[$p->id],
            'subtotal' => $p->price * $cart[$p->id],
        ]);

        $total = $items->sum('subtotal');

        return view('cart.index', compact('items', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $qty = max(1, (int) $request->input('quantity', 1));
        $cart = session('cart', []);
        $newQty = ($cart[$product->id] ?? 0) + $qty;

        if ($newQty > $product->stock) {
            return back()->with('error', 'Not enough stock available.');
        }

        $cart[$product->id] = $newQty;
        session(['cart' => $cart]);

        return back()->with('success', 'Product added to cart.');
    }

    public function update(Request $request, Product $product)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        if ($request->quantity > $product->stock) {
            return back()->with('error', 'Not enough stock available.');
        }

        $cart = session('cart', []);
        if (isset($cart[$product->id])) {
            $cart[$product->id] = (int) $request->quantity;
            session(['cart' => $cart]);
        }

        return back()->with('success', 'Cart updated.');
    }

    public function remove(Product $product)
    {
        $cart = session('cart', []);
        unset($cart[$product->id]);
        session(['cart' => $cart]);

        return back()->with('success', 'Item removed.');
    }
}
