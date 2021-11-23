<?php

use App\Http\Controllers\Master\ProductTypeController;
use Illuminate\Support\Facades\Route;

Route::prefix('product-type')->group(function () {
  Route::get('list', [ProductTypeController::class, 'getListProductType']);
});

Route::fallback(function () {
  return response()->json([
    'message' => 'not found'
  ], 404);
});