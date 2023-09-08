<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\Tour\TourController;
use App\Http\Controllers\Api\v1\Travel\GetPublicTravelController;

/*ل
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */

Route::get('travels/public', GetPublicTravelController::class)->name('travels.public.index');

Route::get('travels/{travel}/tours', [TourController::class, 'index'])->name('travels.tours.index');