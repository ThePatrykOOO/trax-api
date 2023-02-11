<?php

namespace App\Interfaces;

use Illuminate\Support\Collection;

interface ITripRepository
{
    public function findAll(): Collection;

    public function store(array $data): bool;

    public function delete(int $id): void;

    public function deleteByCarId(int $carId): void;
}
