<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Http\Resources\CarDetailsResource;
use App\Http\Resources\CarResource;
use App\Models\Car;
use App\Repositories\CarRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
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


    public function store(StoreCarRequest $request): CarResource
    {
        $car = $this->carRepository->store($request->validated());
        return new CarResource($car);
    }


    public function show(int $id): CarDetailsResource
    {
        $car = $this->carRepository->findById($id);
        return new CarDetailsResource($car);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCarRequest  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCarRequest $request, Car $car)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $this->carRepository->delete($id);
        return new JsonResponse(null, ResponseAlias::HTTP_NO_CONTENT);
    }
}
