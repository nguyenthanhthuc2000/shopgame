<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => Str::uuid()->toString(),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('admin'),
            'status' => $this->faker->randomElement([0, 1]),
            'role' => $this->faker->randomElement(['buyer', 'seller']),
            'seller_vnd' => $this->faker->randomFloat(2, 1000, 1000000),
            'buyer_vnd' => $this->faker->randomFloat(2, 1000, 1000000),
            'buyer_to_seller_rate' => 70,
            'seller_to_buyer_rate' => 0,
            'profit_rate' => 70,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
