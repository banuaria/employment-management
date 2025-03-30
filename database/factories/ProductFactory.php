<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   
        $product_category = ProductCategory::inRandomOrder()->has('productSubcategories')->first();
        $product_subcategory = $product_category->productSubcategories->first();

        $status = $this->faker->boolean;
        $sentence = $this->faker->sentence;
        $user = User::withoutRole('editor')->inRandomOrder()->first();

        return [
            'product_category_id' => $product_category->id,
            'product_subcategory_id' => $product_subcategory->id,
            'status' => $status,
            'title' => $sentence,
            'slug' => Str::slug($sentence),
            'content' => $this->faker->paragraph,
            'usage' => $this->faker->paragraph,
            'meta_title' => $this->faker->sentence,
            'meta_desc' => $this->faker->sentence,
            'meta_keywords' => implode(',', $this->faker->words(5)),
            'created_by' => $user->id,
            'updated_by' => $user->id,
            'published_by' => $status ? $user->id : null,
            'published_at' => $status ? Carbon::now() : null,
        ];
    }
}
