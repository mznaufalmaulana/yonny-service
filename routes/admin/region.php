<?php
use Illuminate\Support\Facades\Route;

Route::prefix('region')->middleware('auth:sanctum')->group(function () {

  Route::get('list', 'Region\RegionController@getListRegion');
  Route::get('{id}', 'Region\RegionController@getRegionById');
  Route::post('store', 'Region\RegionController@storeRegion');
  Route::put('{id}/update', 'Region\RegionController@updateRegion');
  Route::delete('{id}/delete', 'Region\RegionController@deleteRegion');

});

Route::fallback(function () {
  return response()->json([
    'message' => 'not found'
  ], 404);
});