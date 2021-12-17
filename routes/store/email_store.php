<?php

use App\Http\Controllers\Email\EmailController;
use Illuminate\Support\Facades\Route;

Route::prefix('email')->middleware('api')->group(function () {
  Route::post('subscribe', [EmailController::class, 'subscribeEmail']);
  Route::post('receive', [EmailController::class, 'receiveEmailMessage']);
});

Route::fallback(function () {
  return response()->json([
    'message' => 'not found'
  ], 404);
});