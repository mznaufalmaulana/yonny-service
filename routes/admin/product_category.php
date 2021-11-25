<?php

use App\Http\Controllers\Master\ProductCategoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('product-category')->middleware('api')->group(function (){
  Route::get('list', [ProductCategoryController::class, 'getListCategory']);
  Route::get('list-parent', [ProductCategoryController::class, 'getListCategoryParent']);
  Route::get('{id}', [ProductCategoryController::class, 'getCategoryById']);
  Route::post('store', [ProductCategoryController::class, 'storeCategory']);
  Route::put('{id}/update', [ProductCategoryController::class, 'updateCategory']);
  Route::delete('{id}/delete', [ProductCategoryController::class, 'deleteCategory']);
});

Route::fallback(function(){
  return response()->json([
    'message' => 'not found'
  ], 404);
});
