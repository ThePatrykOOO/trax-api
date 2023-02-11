<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Car;
use App\Models\Trip;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CarControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        Car::factory(5)->create();

        $this->login();
        $this->get('/api/v1/cars')
            ->assertSuccessful()
            ->assertJsonStructure(
                [
                    'data' => [
                        '*' => [
                            'id',
                            'make',
                            'model',
                            'year',
                        ],
                    ]
                ]
            );
    }

    public function testIndexUnauthenticated()
    {
        $response = $this->get('/api/v1/cars');
        $this->assertEquals("Unauthenticated.", $response->exception->getMessage());
    }

    public function testStoreCar()
    {
        $this->login();

        $body = [
            'make' => "Test",
            'model' => "Tesla",
            'year' => 2020,
        ];

        $response = $this->post('/api/v1/cars', $body);
        $response->assertJsonFragment($body);

        $this->assertCount(1, Car::all());
    }

    public function testShow()
    {
        $car = Car::factory()->create();

        $this->login();

        $this->get('/api/v1/cars/'.$car->id)
            ->assertSuccessful()
            ->assertJsonStructure(
                [
                    'data' => [
                        'id',
                        'make',
                        'model',
                        'year',
                        'trip_count',
                        'trip_miles',
                    ]
                ]
            );
    }

    public function testShowCarNotFound()
    {
        $this->login();
        $carId = 0;
        $this->get('/api/v1/cars/'.$carId)
            ->assertNotFound();
    }

    public function testDestroy()
    {
        $car = Car::factory()->create();

        $this->login();

        $this->delete('/api/v1/cars/'.$car->id)
            ->assertNoContent();

        $this->assertCount(0, Car::all());
    }

    public function testDeleteTripsWhenCarWasDeleted()
    {
        $car = Car::factory()->create();

        Trip::factory(5)->create(
            [
                'car_id' => $car->id
            ]
        );
        $this->login();
        $this->delete('/api/v1/cars/'.$car->id)
            ->assertNoContent();

        $this->assertCount(0, Car::all());
        $this->assertCount(0, Trip::all());
    }

}
