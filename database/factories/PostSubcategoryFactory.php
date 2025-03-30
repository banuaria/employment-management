<?php

namespace Database\Factories;

use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostSubcategory>
 */
class PostSubcategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $post_category = PostCategory::inRandomOrder()->first();
        $word = $this->faker->word;
        $user = User::withoutRole('editor')->inRandomOrder()->first();

        return [
            'post_category_id' => $post_category,
            'status' => $this->faker->boolean,
            'title' => $word,
            'slug' => Str::slug($word),
            'created_by' => $user,
            'updated_by' => $user,
        ];
    }
}
