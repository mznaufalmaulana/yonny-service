<?php

use App\Http\Controllers\Email\EmailController;
use Illuminate\Support\Facades\Route;

Route::prefix('email')->middleware('api')->group(function () {
  Route::get('list', [EmailController::class, 'getListEmail']);
  Route::get('message', [EmailController::class, 'getEmailMessage']);
  Route::get('{id}', [EmailController::class, 'getEmailById']);
  Route::post('store', [EmailController::class, 'storeEmail']);
  Route::put('{id}/update', [EmailController::class, 'updateEmail']);
  Route::delete('{id}/delete', [EmailController::class, 'deleteEmail']);
  Route::post('broadcast', [EmailController::class, 'broadcastEmail']);
  Route::post('send', [EmailController::class, 'sendEmailMessage']);
  Route::delete('message/{id}/delete', [EmailController::class, 'deleteEmailMessage']);
});

Route::get('broadcast-template', function (){
  $content = new \stdClass();
  $content->title = "Hello From Batu Yonny";
  $content->body = "You are will be receive news update from us";
  $content->link = "link";
  $content->footer = "Thanks";

  return new \App\Mail\BroadcastMailPromo($content);
});

Route::fallback(function () {
  return response()->json([
    'message' => 'not found'
  ], 404);
});