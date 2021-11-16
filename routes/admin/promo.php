<?php
use Illuminate\Support\Facades\Route;

Route::prefix('promo')->middleware('api')->group(function () {
  Route::get('list', 'Promo\PromoController@getListPromo');
  Route::get('list/headline', 'Promo\PromoController@getListPromoHeadline');
  Route::get('{id}', 'Promo\PromoController@getPromoById');
  Route::post('store', 'Promo\PromoController@storePromo');
  Route::put('{id}/update', 'Promo\PromoController@updatePromo');
  Route::delete('{id}/delete', 'Promo\PromoController@deletePromo');
});

Route::fallback(function () {
  return response()->json([
    'message' => 'not found'
  ], 404);
});