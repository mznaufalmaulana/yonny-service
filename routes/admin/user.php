<?php

use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->middleware('auth:sanctum')->group(function (){
  Route::get('list', [UserController::class, 'getListUser']);
  Route::get('{id}', [UserController::class, 'getUserById']);
  Route::post('store', [UserController::class, 'storeUser']);
  Route::put('{id}/update', [UserController::class, 'updateUser']);
  Route::delete('{id}/delete', [UserController::class, 'deleteUser']);
});

Route::fallback(function () {
  return response()->json([
    'message' => 'not found'
  ], 404);
});