<?php

use Illuminate\Support\Facades\Route;


Route::prefix('product-type')->middleware('api')->group(function (){

  Route::get('list', 'Master\ProductTypeController@getListProductType');
  Route::get('{id}', 'Master\ProductTypeController@getProductTypeById');
  Route::post('store', 'Master\ProductTypeController@storeProductType');
  Route::put('{id}/update', 'Master\ProductTypeController@updateProductType');
  Route::delete('{id}/delete', 'Master\ProductTypeController@deleteProductType');

});

Route::fallback(function(){
  return abort(401);
});


