<?php

namespace Database\Factories;

use App\Models\FaqCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Faq>
 */
class FaqFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faqCategory = FaqCategory::inRandomOrder()->first();
        $user = User::withoutRole('editor')->inRandomOrder()->first();

        return [
            'faq_category_id' => $faqCategory->id,
            'status' => $this->faker->boolean,
            'question' => $this->faker->company,
            'answer' => $this->faker->paragraph,
            'created_by' => $user,
            'updated_by' => $user,
        ];
    }
}
