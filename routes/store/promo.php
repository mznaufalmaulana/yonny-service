<?php

use App\Http\Controllers\Promo\PromoController;
use Illuminate\Support\Facades\Route;

Route::prefix('promo')->group(function () {
  Route::get('headline/list', [PromoController::class, 'getListPromoHeadline']);
  Route::get('list', [PromoController::class, 'getListPromo']);
});

Route::fallback(function () {
  return response()->json([
    'message' => 'not found'
  ], 404);
});