<?php

namespace App\Observers;

use App\Models\Car;
use App\Repositories\TripRepository;

class CarObserver
{

    private TripRepository $tripRepository;

    public function __construct(TripRepository $tripRepository)
    {
        $this->tripRepository = $tripRepository;
    }


    public function deleted(Car $car)
    {
        $this->tripRepository->deleteByCarId($car->id);
    }

}
