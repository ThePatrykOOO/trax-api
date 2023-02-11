<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trip>
 */
class TripFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'date' => $this->faker->date(),
            'miles' => $this->faker->randomFloat(2, 10, 300),
            'total' => $this->faker->randomFloat(2, 10, 300),
            'car_id' => null,
        ];
    }
}
