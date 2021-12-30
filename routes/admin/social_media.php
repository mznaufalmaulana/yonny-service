<?php

use App\Http\Controllers\SocialMedia\SocialMediaController;
use Illuminate\Support\Facades\Route;

Route::prefix('social-media')->middleware('auth:sanctum')->group(function () {
  Route::get('list', [SocialMediaController::class, 'getListSocialMedia']);
  Route::get('{id}', [SocialMediaController::class, 'getSocialMediaById']);
  Route::post('store', [SocialMediaController::class, 'storeSocialMedia']);
  Route::put('{id}/update', [SocialMediaController::class, 'updateSocialMedia']);
  Route::delete('{id}/delete', [SocialMediaController::class, 'deleteSocialMedia']);
});

Route::fallback(function () {
  return response()->json([
    'message' => 'not found'
  ], 404);
});