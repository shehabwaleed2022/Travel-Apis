<?php

namespace App\Http\Controllers\Api\v1\admin;

use App\Actions\TravelActions\CreateTravelAction;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Travel\StoreTravelRequest;
use App\Http\Resources\TravelResource;
use Illuminate\Http\JsonResponse;

class TravelController extends Controller
{
    public function store(StoreTravelRequest $request, CreateTravelAction $createTravelAction)
    {
        $travel = $createTravelAction->execute($request->validated());

        return ApiResponse::send(JsonResponse::HTTP_CREATED, 'Travel Created successfully. ', new TravelResource($travel));
    }
}
