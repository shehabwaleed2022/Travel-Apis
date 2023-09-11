<?php
namespace App\Actions\TravelActions;

use App\Models\Travel;

class CreateTravelAction{
    public function execute(array $travelData){
        $travel = Travel::create($travelData);
        return $travel;
    }
}