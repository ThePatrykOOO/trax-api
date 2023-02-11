<?php

namespace App\Repositories;

use App\Models\Trip;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class TripRepository implements CrudRepositoryInterface
{
    public function findAll(): Collection
    {
        return Trip::with('car')->get();
    }

    public function findById(int $id): Model
    {
        return Trip::query()->findOrFail($id);
    }

    public function store(array $data): Model
    {
        return Trip::query()->create($data);
    }

    public function update(array $data, int $id): void
    {
        // TODO: Implement update() method.
    }

    public function delete(int $id): void
    {
        Trip::query()->findOrFail($id)->delete();
    }

    public function deleteByCarId(int $carId): void
    {
        Trip::query()
            ->where(
                [
                    'car_id' => $carId
                ]
            )
            ->delete();
    }
}
