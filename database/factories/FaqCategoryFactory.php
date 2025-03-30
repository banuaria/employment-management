<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FaqCategory>
 */
class FaqCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::withoutRole('editor')->inRandomOrder()->first();

        return [
            'status' => $this->faker->boolean,
            'title' => $this->faker->word,
            'created_by' => $user,
            'updated_by' => $user,
        ];
    }
}
