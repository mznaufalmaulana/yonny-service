<?php
use Illuminate\Support\Facades\Route;

Route::prefix('email')->middleware('api')->group(function () {
  Route::post('subscribe', 'Email\EmailController@subscribeEmail');
});

Route::fallback(function () {
  return response()->json([
    'message' => 'not found'
  ], 404);
});