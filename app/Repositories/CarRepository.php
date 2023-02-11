<?php

namespace App\Repositories;

use App\Interfaces\ICarRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CarRepository implements ICarRepository
{
    public function findAll(): Collection
    {
        return DB::table('cars')->get();
    }

    public function findById(int $id)
    {
        $car = DB::table('cars')->find($id);
        if (!$car) {
            abort(404, 'Car not found');
        }
        return $car;
    }

    public function store(array $data): bool
    {
        return DB::table('cars')->insert($data);
    }

    public function update(array $data, int $id): void
    {
        DB::table('cars')->where('id', '=', $id)->update($data);
    }

    public function delete(int $id): void
    {
        DB::table('cars')->where('id', '=', $id)->delete();
    }
}
