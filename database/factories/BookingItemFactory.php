<?php

namespace Database\Factories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookingItem>
 */
class BookingItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'booking_id' => Booking::factory(),
            'item_type' => $this->faker->randomElement(['App\Models\Flight', 'App\Models\Room']),
            'item_id' => 1, // You may want to seed real referenced models in tests
            'quantity' => 1,
            'price' => $this->faker->randomFloat(2, 100, 1000),
        ];
    }
}
