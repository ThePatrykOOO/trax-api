<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Trip;
use Illuminate\Database\Seeder;

class TripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $car = Car::factory()->create();

        Trip::factory(3)->create(
            [
                'car_id' => $car->id
            ]
        );
    }
}
