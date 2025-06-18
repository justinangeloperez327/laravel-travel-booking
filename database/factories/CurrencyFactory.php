<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Currency>
 */
class CurrencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->currencyCode(),
            'name' => $this->faker->currencyCode(),
            'exchange_rate' => $this->faker->randomFloat(6, 0.01, 2.00),
        ];
    }
}
