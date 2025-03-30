<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Testimony>
 */
class TestimonyFactory extends Factory
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
            'name' => $this->faker->name,
            'designation' => $this->faker->jobTitle,
            'content' => $this->faker->paragraph,
            'created_by' => $user,
            'updated_by' => $user,
        ];
    }
}
