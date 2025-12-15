<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // COFFEE
            [
                'name' => 'Espresso',
                'category' => 'coffee',
                'price' => 22000,
                'description' => 'Pure, bold, and intense espresso shot.',
            ],
            [
                'name' => 'Americano',
                'category' => 'coffee',
                'price' => 25000,
                'description' => 'Smooth espresso diluted with hot water.',
            ],
            [
                'name' => 'Cappuccino',
                'category' => 'coffee',
                'price' => 30000,
                'description' => 'Rich espresso with steamed milk and foam.',
            ],
            [
                'name' => 'Latte',
                'category' => 'coffee',
                'price' => 32000,
                'description' => 'Creamy milk with balanced espresso taste.',
            ],
            [
                'name' => 'Caramel Latte',
                'category' => 'coffee',
                'price' => 35000,
                'description' => 'Sweet caramel blended with smooth latte.',
            ],

            // NON-COFFEE
            [
                'name' => 'Chocolate Latte',
                'category' => 'non-coffee',
                'price' => 30000,
                'description' => 'Rich chocolate with creamy milk.',
            ],
            [
                'name' => 'Matcha Latte',
                'category' => 'non-coffee',
                'price' => 33000,
                'description' => 'Japanese matcha with smooth milk.',
            ],
            [
                'name' => 'Vanilla Milk',
                'category' => 'non-coffee',
                'price' => 28000,
                'description' => 'Sweet vanilla blended with fresh milk.',
            ],

            // TEA
            [
                'name' => 'Lemon Tea',
                'category' => 'tea',
                'price' => 24000,
                'description' => 'Fresh tea with a hint of lemon.',
            ],
            [
                'name' => 'Peach Tea',
                'category' => 'tea',
                'price' => 26000,
                'description' => 'Light tea with sweet peach aroma.',
            ],
            [
                'name' => 'Green Tea',
                'category' => 'tea',
                'price' => 23000,
                'description' => 'Clean and refreshing green tea.',
            ],

            // PASTRY
            [
                'name' => 'Croissant',
                'category' => 'pastry',
                'price' => 22000,
                'description' => 'Buttery and flaky French pastry.',
            ],
            [
                'name' => 'Chocolate Muffin',
                'category' => 'pastry',
                'price' => 25000,
                'description' => 'Soft muffin filled with chocolate.',
            ],
            [
                'name' => 'Banana Bread',
                'category' => 'pastry',
                'price' => 27000,
                'description' => 'Moist banana bread with rich flavor.',
            ],
            [
                'name' => 'Cheese Cake Slice',
                'category' => 'pastry',
                'price' => 32000,
                'description' => 'Creamy cheesecake slice.',
            ],
        ];

        foreach ($products as $product) {
            Product::create([
                'name' => $product['name'],
                'slug' => Str::slug($product['name']),
                'category' => $product['category'],
                'price' => $product['price'],
                'description' => $product['description'],
                'is_active' => true,
            ]);
        }
    }
}
