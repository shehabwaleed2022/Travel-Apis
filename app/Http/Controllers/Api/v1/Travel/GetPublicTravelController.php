<?php

namespace App\Http\Controllers\Api\v1\Travel;

use App\Actions\TravelActions\GetPublicTravelAction;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\TravelResource;

class GetPublicTravelController extends Controller
{
    public function __invoke(GetPublicTravelAction $getPublicTravelAction)
    {
        $travel = $getPublicTravelAction->execute();

        if ($travel->count() == 0) {
            return ApiResponse::send(200, 'No travel avaliable now');
        }

        return ApiResponse::send(200, 'Public travel retireved successfully.', TravelResource::collection($travel));
    }
}
