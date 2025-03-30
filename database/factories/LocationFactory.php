<?php

namespace Database\Factories;

use App\Models\LocationCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $locationCategory = LocationCategory::inRandomOrder()->first();
        $user = User::withoutRole('editor')->inRandomOrder()->first();

        return [
            'location_category_id' => $locationCategory->id,
            'status' => $this->faker->boolean,
            'name' => $this->faker->company,
            'address' => $this->faker->address,
            'email' => $this->faker->companyEmail,
            'phone' => $this->faker->phoneNumber,
            'mobile' => $this->faker->phoneNumber,
            'fax' => $this->faker->phoneNumber,
            'detail' => $this->faker->sentence,
            'desc' => $this->faker->sentence(10),
            'country' => $this->faker->country,
            'province' => $this->faker->state,
            'city' => $this->faker->city,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'created_by' => $user,
            'updated_by' => $user,
        ];
    }
}
