<?php

use App\Http\Controllers\Contact\ContactController;
use Illuminate\Support\Facades\Route;

Route::prefix('contact')->group(function () {
  Route::get('list', [ContactController::class, 'getContactArea']);
});

Route::fallback(function () {
  return response()->json([
    'message' => 'not found'
  ], 404);
});