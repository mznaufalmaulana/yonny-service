<?php

use App\Http\Controllers\Project\ProjectController;
use Illuminate\Support\Facades\Route;

Route::prefix('project')->group(function () {
  Route::post('list', [ProjectController::class, 'getListProjectStore']);
  Route::get('detail/share-count/{id}', [ProjectController::class, 'incrementShareProject']);
  Route::get('detail/{id}', [ProjectController::class, 'getProjectById']);
});

Route::fallback(function () {
  return response()->json([
    'message' => 'not found'
  ], 404);
});