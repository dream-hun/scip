<?php

namespace Database\Factories;

use App\Models\Farmer;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Cooperative;

/**
 * @extends Factory<Farmer>
 */
class FarmerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'user_id' => User::factory(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone_number' => $this->faker->optional()->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'address' => $this->faker->address(),
            'cooperative_id' => Cooperative::factory(),
            'status' => $this->faker->randomElement(['active', 'inactive', 'suspended']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
