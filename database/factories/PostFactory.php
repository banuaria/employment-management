<?php

namespace Database\Factories;

use App\Models\PostCategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $random = (bool)random_int(0, 1);
        $post_category = null;
        $post_subcategory = null;
        if ($random) {
            $post_category = PostCategory::inRandomOrder()->first();
            $post_subcategory = $post_category->postSubcategories->first();
        }
        $status = $this->faker->boolean;
        $sentence = $this->faker->sentence;
        $user = User::withoutRole('editor')->inRandomOrder()->first();

        return [
            'post_category_id' => $post_category,
            'post_subcategory_id' => $post_subcategory,
            'status' => $status,
            'title' => $sentence,
            'slug' => Str::slug($sentence),
            'content' => $this->faker->paragraph,
            'meta_title' => $this->faker->sentence,
            'meta_desc' => $this->faker->sentence,
            'meta_keywords' => implode(',', $this->faker->words(5)),
            'created_by' => $user,
            'updated_by' => $user,
            'published_by' => $status ? $user : null,
            'published_at' => $status ? Carbon::now() : null,
        ];
    }
}
