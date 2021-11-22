<?php

use App\Http\Controllers\Master\ProductCategoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('menu')->group(function () {
  Route::get('product-category', [ProductCategoryController::class, 'getMenuProductCategory']);
});

Route::fallback(function () {
  return response()->json([
    'message' => 'not found'
  ], 404);
});