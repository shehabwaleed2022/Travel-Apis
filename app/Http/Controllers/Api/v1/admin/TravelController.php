<?php

namespace App\Http\Controllers\Api\v1\admin;

use App\Actions\TravelActions\CreateTravelAction;
use App\Actions\TravelActions\UpdateTravelAction;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Travel\StoreTravelRequest;
use App\Http\Requests\Travel\UpdateTravelRequest;
use App\Http\Resources\TravelResource;
use App\Models\Travel;
use Illuminate\Http\JsonResponse;

class TravelController extends Controller
{
    public function store(StoreTravelRequest $request, CreateTravelAction $createTravelAction)
    {
        $travel = $createTravelAction->execute($request->validated());

        return ApiResponse::send(JsonResponse::HTTP_CREATED, 'Travel Created successfully. ', new TravelResource($travel));
    }

    public function update(Travel $travel, UpdateTravelRequest $request, UpdateTravelAction $updateTravelAction)
    {
        if ($updateTravelAction->execute($request->validated(), $travel)) {
            return ApiResponse::send(JsonResponse::HTTP_OK, 'Travel updated successfully.', new TravelResource($travel));
        }
    }
}
