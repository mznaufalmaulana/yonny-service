<?php


use App\Http\Controllers\Project\ProjectController;
use Illuminate\Support\Facades\Route;

Route::prefix('project')->middleware('auth:sanctum')->group(function () {

  Route::get('list', [ProjectController::class, 'getListProject']);
  Route::get('{id}', [ProjectController::class, 'getProjectById']);
  Route::post('store', [ProjectController::class, 'storeProject']);
  Route::post('{id}/update', [ProjectController::class, 'updateProject']);
  Route::delete('{id}/delete', [ProjectController::class, 'deleteProject']);

  Route::get('{id}/project-photo-list', [ProjectController::class, 'getListProjectPhoto']);
  Route::post('{id}/store-project-photo', [ProjectController::class, 'storeProjectPhoto']);
  Route::post('{id}/update-project-photo', [ProjectController::class, 'updateProjectPhoto']);
  Route::delete('{id}/delete-project-photo', [ProjectController::class, 'deleteProjectPhoto']);

});

Route::fallback(function () {
  return response()->json([
    'message' => 'not found'
  ], 404);
});
