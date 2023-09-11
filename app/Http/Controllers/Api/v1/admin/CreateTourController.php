<?php

namespace App\Http\Controllers\Api\v1\admin;

use App\Actions\TourActions\CreateTourAction;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tour\TourRequest;
use App\Http\Resources\TourResource;
use App\Models\Travel;
use Illuminate\Http\JsonResponse;

class CreateTourController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Travel $travel, TourRequest $request, CreateTourAction $createTourAction)
    {
        $tour = $createTourAction->execute($request->validated(), $travel);

        return ApiResponse::send(JsonResponse::HTTP_CREATED, 'Tour created successfully.', new TourResource($tour));
    }
}
