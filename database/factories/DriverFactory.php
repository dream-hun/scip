<?php

namespace Database\Factories;

use App\Models\Driver;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Cooperative;

/**
 * @extends Factory<Driver>
 */
class DriverFactory extends Factory
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
            'license_number' => $this->faker->optional()->bothify('LIC-#####'),
            'license_expiry_date' => $this->faker->optional()->date(),
            'vehicle_type' => $this->faker->optional()->word(),
            'vehicle_registration_number' => $this->faker->optional()->bothify('REG-#####'),
            'status' => $this->faker->randomElement(['active', 'inactive', 'suspended']),
            'cooperative_id' => Cooperative::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
