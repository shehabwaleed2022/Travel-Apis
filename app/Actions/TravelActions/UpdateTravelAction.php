<?php

namespace App\Actions\TravelActions;

use App\Models\Travel;

class UpdateTravelAction
{
    public function execute(array $travelData, Travel $travel)
    {
        $travel->update($travelData);

        return true;
    }
}
