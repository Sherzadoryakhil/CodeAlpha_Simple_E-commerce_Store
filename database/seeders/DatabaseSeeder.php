<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin', 'password' => Hash::make('password'), 'is_admin' => true]
        );

        $electronics = Category::updateOrCreate(['slug' => 'electronics'], ['name' => 'Electronics']);
        $clothing    = Category::updateOrCreate(['slug' => 'clothing'], ['name' => 'Clothing']);
        $home        = Category::updateOrCreate(['slug' => 'home'], ['name' => 'Home']);

        $products = [
            [
                'Wireless Headphones',
                'wireless-headphones',
                $electronics,
                59.99,
                'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'Smart Watch',
                'smart-watch',
                $electronics,
                129.00,
                'https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'Bluetooth Speaker',
                'bluetooth-speaker',
                $electronics,
                39.50,
                'https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'Cotton T-Shirt',
                'cotton-t-shirt',
                $clothing,
                15.00,
                'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'Denim Jacket',
                'denim-jacket',
                $clothing,
                79.90,
                'https://images.unsplash.com/photo-1542272604-787c3835535d?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'Coffee Mug',
                'coffee-mug',
                $home,
                8.50,
                'https://images.unsplash.com/photo-1514228742587-6b1558fcca3d?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'Desk Lamp',
                'desk-lamp',
                $home,
                24.00,
                'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?auto=format&fit=crop&w=1200&q=80',
            ],
        ];

        foreach ($products as [$name, $slug, $category, $price, $image]) {
            Product::updateOrCreate(['slug' => $slug], [
                'name'        => $name,
                'category_id' => $category->id,
                'price'       => $price,
                'stock'       => 25,
                'image'       => $image,
                'description' => "Sample description for {$name}.",
            ]);
        }
    }
}
