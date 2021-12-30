<?php

use App\Http\Controllers\Contact\ContactController;
use Illuminate\Support\Facades\Route;

Route::prefix('contact')->middleware('auth:sanctum')->group(function () {

  Route::get('list', [ContactController::class, 'getListContact']);
  Route::get('{id}', [ContactController::class, 'getContactById']);
  Route::post('store', [ContactController::class, 'storeContact']);
  Route::post('{id}/update', [ContactController::class, 'updateContact']);
  Route::post('{id}/update-on-footer', [ContactController::class, 'updateContactIsOnFooter']);
  Route::delete('{id}/delete', [ContactController::class, 'deleteContact']);

});

Route::fallback(function () {
  return response()->json([
    'message' => 'not found'
  ], 404);
});