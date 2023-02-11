<?php

namespace App\Services;

use App\Exceptions\TripException;
use App\Http\Requests\StoreTripRequest;
use App\Models\Trip;
use App\Repositories\CarRepository;
use App\Repositories\TripRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TripService
{
    private TripRepository $tripRepository;
    private CarRepository $carRepository;

    public function __construct(TripRepository $tripRepository, CarRepository $carRepository)
    {
        $this->tripRepository = $tripRepository;
        $this->carRepository = $carRepository;
    }

    /**
     * @throws TripException
     */
    public function createNewTrip(StoreTripRequest $request): void
    {
        try {
            DB::beginTransaction();

            $car = $this->carRepository->findById($request->get('car_id'));

            $miles = $request->get('miles');
            $totalMiles = Trip::setTotalMiles($car, $miles);

            $tripData = [
                'date' => Carbon::parse($request->get('date'))->format('Y-m-d'),
                'miles' => $miles,
                'total' => $totalMiles,
                'car_id' => $car->id
            ];

            $this->tripRepository->store($tripData);

            $this->updateTripForCar($car, $totalMiles);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("TripService@createNewTrip: problem with creating trip", [
                'exception' => $exception->getMessage(),
                'request' => $request,
                'user_id' => $request->user()?->id,
            ]);
            throw new TripException("There was a problem with creating a trip.");
        }
    }

    private function updateTripForCar($car, float $totalMiles): void
    {
        $data = [
            'trip_count' => $car->trip_count + 1,
            'trip_miles' => $totalMiles,
        ];
        $this->carRepository->update($data, $car->id);
    }
}
