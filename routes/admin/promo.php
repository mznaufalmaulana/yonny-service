<?php

use App\Http\Controllers\Promo\PromoController;
use Illuminate\Support\Facades\Route;

Route::prefix('promo')->middleware('auth:sanctum')->group(function () {
  Route::get('list', [PromoController::class, 'getListPromo']);
  Route::get('list/headline', [PromoController::class, 'getListPromoHeadline']);
  Route::get('list/all', [PromoController::class, 'getListPromoAll']);
  Route::get('{id}', [PromoController::class, 'getPromoById']);
  Route::post('store', [PromoController::class, 'storePromo']);
  Route::post('{id}/update', [PromoController::class, 'updatePromo']);
  Route::delete('{id}/delete', [PromoController::class, 'deletePromo']);
});

Route::fallback(function () {
  return response()->json([
    'message' => 'not found'
  ], 404);
});