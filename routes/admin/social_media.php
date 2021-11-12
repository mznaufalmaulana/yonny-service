<?php

use Illuminate\Support\Facades\Route;

Route::prefix('social-media')->middleware('api')->group(function () {

  Route::get('list', 'SocialMedia\SocialMediaController@getListSocialMedia');
  Route::get('{id}', 'SocialMedia\SocialMediaController@getSocialMediaById');
  Route::post('store', 'SocialMedia\SocialMediaController@storeSocialMedia');
  Route::put('{id}/update', 'SocialMedia\SocialMediaController@updateSocialMedia');
  Route::delete('{id}/delete', 'SocialMedia\SocialMediaController@deleteSocialMedia');

});

Route::fallback(function () {
  return response()->json([
    'message' => 'not found'
  ], 404);
});