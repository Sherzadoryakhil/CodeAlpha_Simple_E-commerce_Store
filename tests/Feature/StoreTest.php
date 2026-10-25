<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    private function product(int $stock = 5): Product
    {
        return Product::create([
            'name'  => 'Test Item',
            'slug'  => 'test-item',
            'price' => 10,
            'stock' => $stock,
        ]);
    }

    private function shipping(): array
    {
        return [
            'shipping_name'    => 'John Doe',
            'shipping_phone'   => '0700000000',
            'shipping_address' => 'Kabul, Street 1',
        ];
    }

    public function test_home_page_lists_products(): void
    {
        $this->product();
        $this->get('/')->assertOk()->assertSee('Test Item');
    }

    public function test_product_details_page_loads(): void
    {
        $p = $this->product();
        $this->get(route('products.show', $p))->assertOk()->assertSee('Test Item');
    }

    public function test_guest_can_add_to_cart(): void
    {
        $p = $this->product();
        $this->post(route('cart.add', $p), ['quantity' => 2])
            ->assertSessionHas("cart.{$p->id}", 2);
    }

    public function test_cannot_add_more_than_stock(): void
    {
        $p = $this->product(3);
        $this->post(route('cart.add', $p), ['quantity' => 5])
            ->assertSessionHas('error')
            ->assertSessionMissing("cart.{$p->id}");
    }

    public function test_checkout_requires_login(): void
    {
        $this->get(route('checkout'))->assertRedirect(route('login'));
    }

    public function test_user_can_place_order_and_stock_decreases(): void
    {
        $user = User::factory()->create();
        $p = $this->product(5);

        $this->actingAs($user)
            ->withSession(['cart' => [$p->id => 2]])
            ->post(route('orders.store'), $this->shipping())
            ->assertSessionHasNoErrors();

        $this->assertDatabaseCount('orders', 1);
        $this->assertDatabaseHas('order_items', [
            'product_id' => $p->id,
            'quantity'   => 2,
        ]);
        $this->assertEquals(3, $p->fresh()->stock);
    }

    public function test_order_fails_when_stock_is_too_low(): void
    {
        $user = User::factory()->create();
        $p = $this->product(1);

        $this->actingAs($user)
            ->withSession(['cart' => [$p->id => 3]])
            ->post(route('orders.store'), $this->shipping())
            ->assertSessionHas('error');

        $this->assertDatabaseCount('orders', 0);
        $this->assertEquals(1, $p->fresh()->stock);
    }

    public function test_user_cannot_view_another_users_order(): void
    {
        $owner = User::factory()->create();
        $other = User::factory()->create();

        $order = Order::create([
            'user_id'          => $owner->id,
            'total'            => 10,
            'status'           => 'pending',
            'shipping_name'    => 'A',
            'shipping_phone'   => '1',
            'shipping_address' => 'X',
        ]);

        $this->actingAs($other)->get(route('orders.show', $order))->assertForbidden();
    }

    public function test_normal_user_cannot_open_admin(): void
    {
        $this->actingAs(User::factory()->create())
            ->get('/admin/products')
            ->assertForbidden();
    }

    public function test_admin_can_open_admin(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $this->actingAs($admin)->get('/admin/products')->assertOk();
    }
}
