<?php

use App\Http\Controllers\Product\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('product')->group(function () {
  Route::get('list', [ProductController::class, 'getListProductStore']);
  Route::get('latest', [ProductController::class, 'getListLatestProduct']);
  Route::get('detail/share-count/{id}', [ProductController::class, 'incrementShareProduct']);
  Route::get('detail/seen-count/{id}', [ProductController::class, 'incrementSeenProduct']);
  Route::get('detail/{id}', [ProductController::class, 'getProductById']);
  Route::get('related/{id}', [ProductController::class, 'getListProductByCategoryId']);
});

Route::fallback(function () {
  return response()->json([
    'message' => 'not found'
  ], 404);
});