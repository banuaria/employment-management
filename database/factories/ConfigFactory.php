<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ConfigModel>
 */
class ConfigFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_name' => $this->faker->company,
            'address' => $this->faker->address,
            'email' => $this->faker->companyEmail,
            'phone' => $this->faker->phoneNumber,
            'mobile' => $this->faker->phoneNumber,
            'fax' => $this->faker->phoneNumber,

            'instagram' => 'https://instagram.com/' . $this->faker->userName,
            'facebook' => 'https://facebook.com/' . $this->faker->userName,
            'x' => 'https://x.com/' . $this->faker->userName,  // Assuming 'x' refers to Twitter
            'linkedin' => 'https://linkedin.com/in/' . $this->faker->userName,
            'youtube' => 'https://youtube.com/' . $this->faker->userName,
            'tiktok' => 'https://tiktok.com/@' . $this->faker->userName,

            'meta_title' => $this->faker->sentence,
            'meta_desc' => $this->faker->paragraph,
            'meta_keywords' => implode(',', $this->faker->words(5)),

            'whatsapp_phone' => $this->faker->phoneNumber,
            'whatsapp_message' => $this->faker->sentence,

            'head_tag' => '<script>' . $this->faker->sentence . '</script>',
            'body_tag' => '<script>' . $this->faker->sentence . '</script>',
            'google_map_tag' => '<iframe src="' . $this->faker->url . '"></iframe>',
        ];
    }
}
