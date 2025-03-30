<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductTag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product_tags = ProductTag::factory(4)->create();

        $products = Product::inRandomOrder()->limit(2)->get();
        foreach ($products as $product) {
            $product->productTags()->sync($product_tags->random(rand(1, 4)));
        }
    }
}
