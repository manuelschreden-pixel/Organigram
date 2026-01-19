<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'product_name' => 'Vollkornbrot',
            'category_id' => 1,
            'price' => 5.50,
            'stock_quantity' => 0,
        ]);

        Product::create([
            'product_name' => 'Bauernkornbrot',
            'category_id' => 1,
            'price' => 5,
            'stock_quantity' => 0,
        ]);

        Product::create([
            'product_name' => '10er Eierpackung',
            'category_id' => 2,
            'price' => 3.50,
            'stock_quantity' => 0,
        ]);
    }
}
