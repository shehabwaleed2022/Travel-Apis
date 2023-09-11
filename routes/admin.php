<?php

use App\Http\Controllers\Api\v1\admin\TravelController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::resource('travels', TravelController::class)->only('store');
});
