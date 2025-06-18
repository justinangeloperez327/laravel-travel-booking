<?php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Flight>
 */
class FlightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $origin = Location::factory()->create();
        $destination = Location::factory()->create();

        return [
            'airline' => $this->faker->company(),
            'flight_number' => strtoupper($this->faker->bothify('??###')),
            'origin_id' => $origin->id,
            'destination_id' => $destination->id,
            'departure_time' => now()->addDays(rand(1, 30)),
            'arrival_time' => now()->addDays(rand(1, 30))->addHours(rand(2, 12)),
            'base_price' => $this->faker->randomFloat(2, 100, 1000),
            'seats_available' => $this->faker->numberBetween(50, 300),
        ];
    }
}
