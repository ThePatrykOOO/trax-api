<?php

namespace Tests\Unit\Models;

use App\Models\Car;
use App\Models\Trip;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TripTest extends TestCase
{
    use RefreshDatabase;

    public function testCarRelationship()
    {
        $car = Car::factory()->create();

        $trip = Trip::factory()->create(
            [
                'car_id' => $car->id
            ]
        );

        $this->assertInstanceOf(Car::class, $trip->car);
    }

    public function testSetTotal()
    {
        $car = Car::factory()->make(
            [
                'trip_miles' => 20
            ]
        );

        $this->assertEquals(50, Trip::setTotalMiles($car, 30));
        $this->assertEquals(320.54, Trip::setTotalMiles($car, 300.54));
    }
}
