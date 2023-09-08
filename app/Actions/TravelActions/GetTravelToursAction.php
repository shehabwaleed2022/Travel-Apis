<?php

namespace App\Actions\TravelActions;

use App\Models\Travel;

class GetTravelToursAction
{
    public function execute(Travel $travel, array $filters = [])
    {
        $travelTours = $travel->tours()->filter($filters)->orderBy('starting_date')->get();

        return $travelTours;
    }
}
