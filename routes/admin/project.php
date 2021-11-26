<?php


use App\Http\Controllers\Project\ProjectController;
use Illuminate\Support\Facades\Route;

Route::prefix('project')->middleware('api')->group(function () {

  Route::get('list', [ProjectController::class, 'getListProject']);
  Route::get('{id}', [ProjectController::class, 'getProjectById']);
  Route::post('store', [ProjectController::class, 'storeProject']);
  Route::put('{id}/update', [ProjectController::class, 'updateProject']);
  Route::delete('{id}/delete', [ProjectController::class, 'deleteProject']);

  Route::get('{id}/project-photo-list', [ProjectController::class, 'getListProjectPhoto']);
  Route::post('{id}/store-project-photo', [ProjectController::class, 'storeProjectPhoto']);
  Route::put('{id}/update-project-photo', 'Project\ProjectController@updateProjectPhoto');
  Route::delete('{id}/delete-project-photo', 'Project\ProjectController@deleteProjectPhoto');

});

Route::fallback(function () {
  return response()->json([
    'message' => 'not found'
  ], 404);
});
