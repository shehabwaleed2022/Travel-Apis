<?php

namespace App\Http\Controllers\Api\v1\Tour;

use App\Actions\TravelActions\GetTravelToursAction;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\TourListRequest;
use App\Http\Resources\TourResource;
use App\Models\Travel;
use Illuminate\Http\JsonResponse;

class TourController extends Controller
{
    public function index(TourListRequest $request, Travel $travel, GetTravelToursAction $getTravelToursAction)
    {
        $tours = $getTravelToursAction->execute($travel, $request->only(['priceFrom', 'priceTo', 'dateFrom', 'dateTo', 'sortBy', 'sortOrder']));

        if ($tours->count() == 0) {
            return ApiResponse::send(JsonResponse::HTTP_NOT_FOUND, 'No tours found for this travel. ');
        }

        return ApiResponse::send(JsonResponse::HTTP_OK, 'Tours retireved successfully.', TourResource::collection($tours));
    }
}
