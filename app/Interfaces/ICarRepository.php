<?php

namespace App\Interfaces;

use Illuminate\Support\Collection;

interface ICarRepository
{
    public function findAll(): Collection;

    public function findById(int $id);

    public function store(array $data): bool;

    public function update(array $data, int $id): void;

    public function delete(int $id): void;
}
