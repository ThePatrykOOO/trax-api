<?php

namespace App\Http\Controllers;

use App\Exceptions\TripException;
use App\Http\Requests\StoreTripRequest;
use App\Http\Resources\TripResource;
use App\Repositories\TripRepository;
use App\Services\TripService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class TripController extends Controller
{

    private TripRepository $tripRepository;

    public function __construct(TripRepository $tripRepository)
    {
        $this->tripRepository = $tripRepository;
    }

    public function index(): AnonymousResourceCollection
    {
        $cars = $this->tripRepository->findAll();
        return TripResource::collection($cars);
    }


    public function store(StoreTripRequest $request, TripService $tripService): TripResource|JsonResponse
    {
        try {
            $tripService->createNewTrip($request);
            return new JsonResponse(null, ResponseAlias::HTTP_NO_CONTENT);
        } catch (TripException $exception) {
            return new JsonResponse($exception->getMessage(), ResponseAlias::HTTP_FORBIDDEN);
        } catch (\Exception $exception) {
            Log::error("TripController@store: problem with creating trip", [
                'exception' => $exception->getMessage(),
                'request' => $request,
                'user_id' => $request->user()?->id,
            ]);
            return new JsonResponse("Something was wrong", ResponseAlias::HTTP_BAD_REQUEST);
        }
    }
}
