<?php

namespace App\Actions\TourActions;

use App\Models\Travel;

class CreateTourAction
{
    public function execute(array $tourData, Travel $travel)
    {
        $tour = $travel->tours()->create($tourData);

        return $tour;
    }
}
