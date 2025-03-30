<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostTag>
 */
class PostTagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $word = $this->faker->word;
        $user = User::withoutRole('editor')->inRandomOrder()->first();

        return [
            'status' => $this->faker->boolean,
            'title' => $word,
            'slug' => Str::slug($word),
            'created_by' => $user,
            'updated_by' => $user,
        ];
    }
}
