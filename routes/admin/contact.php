<?php

use App\Http\Controllers\Contact\ContactController;
use Illuminate\Support\Facades\Route;

Route::prefix('contact')->middleware('api')->group(function () {

  Route::get('list', [ContactController::class, 'getListContact']);
  Route::get('{id}', [ContactController::class, 'getContactById']);
  Route::post('store', [ContactController::class, 'storeContact']);
  Route::put('{id}/update', [ContactController::class, 'updateContact']);
  Route::delete('{id}/delete', [ContactController::class, 'deleteContact']);

});

Route::fallback(function () {
  return response()->json([
    'message' => 'not found'
  ], 404);
});