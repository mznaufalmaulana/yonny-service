<?php
use Illuminate\Support\Facades\Route;

Route::prefix('email')->middleware('api')->group(function () {
  Route::get('list', 'Email\EmailController@getListEmail');
  Route::get('message', 'Email\EmailController@getEmailMessage');
  Route::get('{id}', 'Email\EmailController@getEmailById');
  Route::post('store', 'Email\EmailController@storeEmail');
  Route::put('{id}/update', 'Email\EmailController@updateEmail');
  Route::delete('{id}/delete', 'Email\EmailController@deleteEmail');
  Route::post('broadcast', 'Email\EmailController@broadcastEmail');
  Route::post('send', 'Email\EmailController@sendEmailMessage');
  Route::delete('message/{id}/delete', 'Email\EmailController@deleteEmailMessage');
});

Route::fallback(function () {
  return response()->json([
    'message' => 'not found'
  ], 404);
});