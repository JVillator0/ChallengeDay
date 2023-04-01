<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryTypeController;
use App\Http\Controllers\EmissionTypeController;
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
