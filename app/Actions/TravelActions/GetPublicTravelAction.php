<?php
namespace App\Actions\TravelActions;

use App\Models\Travel;

class GetPublicTravelAction{
    public function execute(){
        $publicTravel = Travel::where('is_public', true)->get();
        return $publicTravel;
    }
}