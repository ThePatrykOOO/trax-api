<?php

namespace App\Repositories;

use App\Interfaces\ITripRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TripRepository implements ITripRepository
{
    public function findAll(): Collection
    {
        return DB::table('trips')
            ->join('cars', 'cars.id', '=', 'trips.car_id')
            ->select('trips.*', 'cars.make', 'cars.model', 'cars.year')
            ->get();
    }

    public function store(array $data): bool
    {
        return DB::table('trips')->insert($data);
    }

    public function delete(int $id): void
    {
        DB::table('trips')->find($id)->delete();
    }

    public function deleteByCarId(int $carId): void
    {
        DB::table('trips')
            ->where('car_id', '=', $carId)
            ->delete();
    }
}
