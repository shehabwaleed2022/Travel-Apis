<?php

use App\Http\Controllers\Api\v1\admin\CreateTourController;
use App\Http\Controllers\Api\v1\admin\TravelController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['auth:sanctum'])->group(function () {
    Route::middleware('role:admin')->group(function () {
        Route::post('travels', [TravelController::class, 'store']);
        Route::post('travels/{travel:slug}/tours', CreateTourController::class);
    });

    Route::patch('travels/{travel:slug}', [TravelController::class, 'update']);
});
