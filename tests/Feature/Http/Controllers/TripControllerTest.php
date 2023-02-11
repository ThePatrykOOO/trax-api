<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Car;
use App\Models\Trip;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TripControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $car = Car::factory()->create();

        Trip::factory(5)->create(
            [
                'car_id' => $car->id
            ]
        );

        $this->login();
        $this->get('/api/v1/trips')
            ->assertSuccessful()
            ->assertJsonStructure(
                [
                    'data' => [
                        '*' => [
                            'id',
                            'date',
                            'miles',
                            'total',
                            'car' => [
                                'id',
                                'make',
                                'model',
                                'year',
                            ]
                        ],
                    ]
                ]
            );
    }

    public function testIndexUnauthenticated()
    {
        $response = $this->get('/api/v1/trips');
        $this->assertEquals("Unauthenticated.", $response->exception->getMessage());
    }

    public function testStoreTrip()
    {
        $this->login();

        $car = Car::factory()->create(
            [
                'trip_count' => 2,
                'trip_miles' => 25,
            ]
        );

        $body = [
            'date' => '2020-01-01',
            'miles' => 10,
            'total' => 30,
            'car_id' => $car->id
        ];

        $response = $this->post('/api/v1/trips', $body)
            ->assertSuccessful();

        $response->assertJsonFragment(
            [
                'date' => '2020-01-01',
                'miles' => 10,
                'total' => 35,
            ]
        );

        $this->assertCount(1, Trip::all());

        $car->refresh();

        $this->assertEquals(35, $car->trip_miles);
        $this->assertEquals(3, $car->trip_count);
    }

}
