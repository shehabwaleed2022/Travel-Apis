<?php

namespace App\Http\Controllers\Api\v1\admin;

use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\TravelResource;
use App\Http\Requests\Travel\StoreTravelRequest;
use App\Actions\TravelActions\CreateTravelAction;

class CreateTravelController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreTravelRequest $request, CreateTravelAction $createTravelAction)
    {
        $travel = $createTravelAction->execute($request->validated());

        return ApiResponse::send(JsonResponse::HTTP_CREATED, 'Travel Created successfully. ', new TravelResource($travel));
    }
}
