<?php


use Illuminate\Support\Facades\Route;

Route::prefix('project')->middleware('api')->group(function () {

  Route::get('list', 'Project\ProjectController@getListProject');
  Route::get('{id}', 'Project\ProjectController@getProjectById');
  Route::post('store', 'Project\ProjectController@storeProject');
  Route::put('{id}/update', 'Project\ProjectController@updateProject');
  Route::delete('{id}/delete', 'Project\ProjectController@deleteProject');

  Route::get('{id}/project-photo-list', 'Project\ProjectController@getListProjectPhoto');
  Route::post('{id}/store-project-photo', 'Project\ProjectController@storeProjectPhoto');
  Route::put('{id}/update-project-photo', 'Project\ProjectController@updateProjectPhoto');
  Route::delete('{id}/delete-project-photo', 'Project\ProjectController@deleteProjectPhoto');

});

Route::fallback(function () {
  return response()->json([
    'message' => 'not found'
  ], 404);
});
