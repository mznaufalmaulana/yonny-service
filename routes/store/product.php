<?php

use App\Http\Controllers\Product\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('product')->group(function () {
  Route::post('list', [ProductController::class, 'getListProductStore']);
  Route::get('latest', [ProductController::class, 'getListLatestProduct']);
  Route::get('detail/share-count/{id}', [ProductController::class, 'incrementShareProduct']);
  Route::get('detail/{id}', [ProductController::class, 'getProductById']);
});

Route::fallback(function () {
  return response()->json([
    'message' => 'not found'
  ], 404);
});