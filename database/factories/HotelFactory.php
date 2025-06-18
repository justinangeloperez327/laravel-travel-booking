<?php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hotel>
 */
class HotelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $location = Location::factory()->create();

        return [
            'name' => $this->faker->company().' Hotel',
            'description' => $this->faker->paragraph(),
            'location_id' => $location->id,
            'address' => $this->faker->address(),
            'star_rating' => $this->faker->randomFloat(1, 1, 5),
        ];
    }
}
