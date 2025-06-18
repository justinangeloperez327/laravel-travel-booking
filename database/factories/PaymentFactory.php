<?php

namespace Database\Factories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
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
            'payment_gateway' => $this->faker->randomElement(['Stripe', 'Paypal', 'Razorpay']),
            'amount' => $this->faker->randomFloat(2, 100, 2000),
            'status' => $this->faker->randomElement(['initiated', 'paid', 'failed']),
            'transaction_reference' => $this->faker->uuid(),
            'paid_at' => now(),
        ];
    }
}
