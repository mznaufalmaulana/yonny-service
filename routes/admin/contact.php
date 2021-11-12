<?php

use Illuminate\Support\Facades\Route;

Route::prefix('contact')->middleware('api')->group(function () {

  Route::get('list', 'Contact\ContactController@getListContact');
  Route::get('{id}', 'Contact\ContactController@getContactById');
  Route::post('store', 'Contact\ContactController@storeContact');
  Route::put('{id}/update', 'Contact\ContactController@updateContact');
  Route::delete('{id}/delete', 'Contact\ContactController@deleteContact');

});

Route::fallback(function () {
  return response()->json([
    'message' => 'not found'
  ], 404);
});