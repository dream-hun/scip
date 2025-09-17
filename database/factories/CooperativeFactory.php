<?php

namespace Database\Factories;

use App\Models\Cooperative;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Cooperative>
 */
class CooperativeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => fake()->uuid(),
            'name' => fake()->company(),
            'region' => fake()->state(),
            'address' => fake()->optional()->address(),
            'contact_person' => fake()->optional()->name(),
            'phone' => fake()->optional()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'website' => fake()->optional()->url(),
            'registration_number' => fake()->unique()->bothify('REG-#####'),
            'registration_date' => fake()->optional()->date(),
            'number_of_members' => fake()->numberBetween(0, 500),
            'offer' => fake()->word(),
            'status' => fake()->randomElement(['active', 'inactive', 'suspended']),
            'user_id' => User::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
