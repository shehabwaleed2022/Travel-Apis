<?php

use App\Http\Controllers\Api\v1\admin\CreateTourController;
use App\Http\Controllers\Api\v1\admin\CreateTravelController;
use App\Http\Controllers\Api\v1\admin\TravelController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::post('travels', CreateTravelController::class);
    Route::post('travels/{travel:slug}/tours', CreateTourController::class);
});
