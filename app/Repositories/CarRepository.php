<?php

namespace App\Repositories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CarRepository implements CrudRepositoryInterface
{
    public function findAll(): Collection
    {
        return Car::all();
    }

    public function findById(int $id): Model
    {
        return Car::query()->findOrFail($id);
    }

    public function store(array $data): Model
    {
        return Car::query()->create($data);
    }

    public function update(array $data, int $id): void
    {
        // TODO: Implement update() method.
    }

    public function delete(int $id): void
    {
        Car::query()->findOrFail($id)->delete();
    }
}
