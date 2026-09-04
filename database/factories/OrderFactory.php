<?php

namespace Database\Factories;

use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => null,
            'email' => fake()->unique()->safeEmail(),
            'status' => OrderStatus::Pending,
            'total' => fake()->numberBetween(15000, 45000),
            'stripe_session_id' => null,
        ];
    }
}
