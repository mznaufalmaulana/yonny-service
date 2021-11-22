<?php

use Illuminate\Support\Facades\Route;

Route::post('register', [\App\Http\Controllers\Authentication\AuthenticationController::class, 'doRegister']);
Route::post('login', [\App\Http\Controllers\Authentication\AuthenticationController::class, 'doAuth']);
Route::post('logout', [\App\Http\Controllers\Authentication\AuthenticationController::class, 'doLogout'])
  ->middleware('auth:sanctum');

Route::fallback(function(){
  return response()->json([
    'message' => 'not found'
  ], 404);
});