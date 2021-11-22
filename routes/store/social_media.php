<?php

use App\Http\Controllers\SocialMedia\SocialMediaController;
use Illuminate\Support\Facades\Route;

Route::prefix('social-media')->group(function () {
  Route::get('list', [SocialMediaController::class, 'getListSocialMedia']);
});

Route::fallback(function () {
  return response()->json([
    'message' => 'not found'
  ], 404);
});