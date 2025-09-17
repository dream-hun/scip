<?php

namespace Database\Factories;

use App\Models\Cooperative;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
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
            'name' => $this->faker->word(),
            'description' => $this->faker->optional()->sentence(),
            'price' => $this->faker->numberBetween(100, 10000),
            'quantity' => $this->faker->numberBetween(1, 1000),
            'unit' => $this->faker->randomElement(['kg', 'ton', 'litre', 'bag', 'crate']),
            'status' => $this->faker->randomElement(['available', 'unavailable', 'reserved']),
            'harvest_date' => $this->faker->optional()->date(),
            'cooperative_id' => Cooperative::factory(),
            'user_id' => User::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
