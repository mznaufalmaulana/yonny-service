<?php

use App\Http\Controllers\Region\RegionController;
use Illuminate\Support\Facades\Route;

Route::prefix('region')->middleware('api')->group(function () {
  Route::get('list', [RegionController::class, 'getListRegion']);
  Route::get('{id}', [RegionController::class, 'getRegionById']);
  Route::post('store', [RegionController::class, 'storeRegion']);
  Route::put('{id}/update', [RegionController::class, 'updateRegion']);
  Route::delete('{id}/delete', [RegionController::class, 'deleteRegion']);
});

Route::fallback(function () {
  return response()->json([
    'message' => 'not found'
  ], 404);
});