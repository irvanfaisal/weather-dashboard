<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StationController;
use App\Http\Controllers\ObservationController;
use App\Http\Controllers\ForecastController;
use App\Http\Controllers\LongtermForecastController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('station-list', [StationController::class, 'list'])->name('station.list');
Route::get('nearest-station', [StationController::class, 'nearest'])->name('station.nearest');
Route::get('observation', [ObservationController::class, 'list'])->name('observation.list');
Route::get('latestObservation', [ObservationController::class, 'latest'])->name('observation.latest');
Route::get('forecast', [ForecastController::class, 'list'])->name('forecast.list');
Route::get('longterm', [LongtermForecastController::class, 'list'])->name('longterm.list');