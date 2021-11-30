<?php

use App\Http\Controllers\Product\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('product')->middleware('api')->group(function (){

  Route::get('list', [ProductController::class, 'getListProduct']);
  Route::get('{id}', [ProductController::class, 'getProductById']);
  Route::post('store', [ProductController::class, 'storeProduct']);
  Route::put('{id}/update', [ProductController::class, 'updateProduct']);
  Route::delete('{id}/delete', [ProductController::class, 'deleteProduct']);

  Route::get('{id}/product-photo-list', [ProductController::class, 'getListProductPhoto']);
  Route::post('{id}/store-product-photo', [ProductController::class, 'storeProductPhoto']);
  Route::put('{id}/update-product-photo', [ProductController::class, 'updatePhotoProduct']);
  Route::delete('{id}/delete-product-photo', [ProductController::class, 'deletePhotoProduct']);

});

Route::fallback(function(){
  return response()->json([
    'message' => 'not found'
  ], 404);
});
