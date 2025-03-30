<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductTag>
 */
class ProductTagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product_category = ProductCategory::inRandomOrder()->first();
        $word = $this->faker->word;
        $user = User::withoutRole('editor')->inRandomOrder()->first();

        return [
            'product_category_id' => $product_category,
            'status' => $this->faker->boolean,
            'title' => $word,
            'slug' => Str::slug($word),
            'created_by' => $user,
            'updated_by' => $user,
        ];
    }
}
