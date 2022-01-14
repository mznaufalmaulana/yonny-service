<?php

use App\Http\Controllers\Master\ProductCategoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('menu')->group(function () {
  Route::get('product-category', [ProductCategoryController::class, 'getMenuProductCategory']);
});

Route::prefix('product-category')->group(function () {
  Route::get('list-parent', [ProductCategoryController::class, 'getListCategoryParent']);
  Route::get('{id}', [ProductCategoryController::class, 'getCategoryById']);
});

Route::fallback(function () {
  return response()->json([
    'message' => 'not found'
  ], 404);
});