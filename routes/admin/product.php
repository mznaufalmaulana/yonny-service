<?php

use Illuminate\Support\Facades\Route;

Route::prefix('product')->middleware('api')->group(function (){

  Route::get('list', 'Product\ProductController@getListProduct');
  Route::get('{id}', 'Product\ProductController@getProductById');
  Route::post('store', 'Product\ProductController@storeProduct');
  Route::put('{id}/update', 'Product\ProductController@updateProduct');
  Route::delete('{id}/delete', 'Product\ProductController@deleteProduct');

  Route::get('{id}/product-photo-list', 'Product\ProductController@getListProductPhoto');
  Route::post('{id}/store-product-photo', 'Product\ProductController@storeProductPhoto');
  Route::put('{id}/update-product-photo', 'Product\ProductController@updatePhotoProduct');
  Route::delete('{id}/delete-product-photo', 'Product\ProductController@deletePhotoProduct');

});

Route::fallback(function(){
  return response()->json([
    'message' => 'not found'
  ], 404);
});
