<?php

use Illuminate\Support\Facades\Route;

Route::prefix('product')->middleware('api')->group(function (){

  Route::get('list', 'Product\ProductController@getListProduct');
  Route::get('{id}', 'Product\ProductController@getProductById');
  Route::post('store', 'Product\ProductController@storeProduct');
  Route::put('{id}/update', 'Product\ProductController@updateProduct');
  Route::delete('{id}/delete', 'Product\ProductController@deleteProduct');

});

Route::fallback(function(){
  return response()->json([
    'message' => 'not found'
  ], 404);
});
