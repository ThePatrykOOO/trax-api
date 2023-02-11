<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarRequest;
use App\Http\Resources\CarDetailsResource;
use App\Http\Resources\CarResource;
use App\Repositories\CarRepository;
use App\Repositories\TripRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CarController extends Controller
{

    private CarRepository $carRepository;

    public function __construct(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    public function index(): AnonymousResourceCollection
    {
        $cars = $this->carRepository->findAll();
        return CarResource::collection($cars);
    }


    public function store(StoreCarRequest $request)
    {
        $this->carRepository->store($request->validated());
        return new JsonResponse(null, ResponseAlias::HTTP_NO_CONTENT);
    }


    public function show(int $id): CarDetailsResource
    {
        $car = $this->carRepository->findById($id);
        return new CarDetailsResource($car);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return JsonResponse
     */
    public function destroy(int $id, TripRepository $tripRepository): JsonResponse
    {
        try {
            DB::beginTransaction();

            $this->carRepository->delete($id);
            $tripRepository->deleteByCarId($id);

            DB::commit();
            return new JsonResponse(null, ResponseAlias::HTTP_NO_CONTENT);
        } catch (\Exception $exception) {
            Log::error("CarController@destroy: problem with creating trip", [
                'exception' => $exception->getMessage(),
                'id' => $id,
            ]);
            return new JsonResponse("Something was wrong", ResponseAlias::HTTP_BAD_REQUEST);
        }
    }
}
