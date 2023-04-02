<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryTypeController;
use App\Http\Controllers\ConsumptionController;
use App\Http\Controllers\DeparmentController;
use App\Http\Controllers\EmissionTypeController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\TypeController;
use Illuminate\Support\Facades\Route;

Route::get('/status', function () {
    return response()->json([
        'status' => 'ok',
    ]);
});

Route::apiResource('categories', CategoryController::class);
Route::apiResource('types', TypeController::class);
Route::apiResource('category-types', CategoryTypeController::class);
Route::apiResource('emissions-types', EmissionTypeController::class);
Route::apiResource('places', PlaceController::class);
Route::apiResource('deparments', DeparmentController::class);
Route::apiResource('trips', TripController::class);
Route::apiResource('consumptions', ConsumptionController::class);

Route::prefix('/metrics')->group(function () {
    Route::get('/anual-average-fuel-consumption-by-category', [
        CategoryTypeController::class,
        'anualAverageFuelConsumptionByCategory'
    ]);

    Route::get('/monthly-average-fuel-consumption', [
        ConsumptionController::class,
        'monthlyAverageFuelConsumption'
    ]);

    Route::get('/most-impact-segment', [
        ConsumptionController::class,
        'mostImpactSegment'
    ]);

    Route::get('/monthly-average-electricity-consumption', [
        ConsumptionController::class,
        'monthlyAverageElectricityConsumption'
    ]);

    Route::get('/monthly-comparison-electricity-fuel-consumption', [
        ConsumptionController::class,
        'monthlyComparisonElectricityFuelConsumption'
    ]);
});
