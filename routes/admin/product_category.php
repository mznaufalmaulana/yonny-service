<?php

use Illuminate\Support\Facades\Route;

Route::prefix('product-category')->middleware('api')->group(function (){

  Route::get('list', 'Master\ProductCategoryController@getListCategory');
  Route::get('list-parent', 'Master\ProductCategoryController@getListCategoryParent');
  Route::get('{id}', 'Master\ProductCategoryController@getCategoryById');
  Route::post('store', 'Master\ProductCategoryController@storeCategory');
  Route::put('{id}/update', 'Master\ProductCategoryController@updateCategory');
  Route::delete('{id}/delete', 'Master\ProductCategoryController@deleteCategory');

});

Route::fallback(function(){
  return response()->json([
    'message' => 'not found'
  ], 404);
});
