<?php

use App\Http\Controllers\Api\v1\Auth\SessionController;
use App\Http\Controllers\Api\v1\Tour\TourController;
use App\Http\Controllers\Api\v1\Travel\GetPublicTravelController;
use Illuminate\Support\Facades\Route;

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

Route::post('login', [SessionController::class, 'store']);
Route::post('logout', [SessionController::class, 'destroy']);