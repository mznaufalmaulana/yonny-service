<?php

use App\Http\Controllers\Email\EmailController;
use Illuminate\Support\Facades\Route;

Route::prefix('email')->middleware('auth:sanctum')->group(function () {
  Route::get('list', [EmailController::class, 'getListEmail']);
  Route::get('message', [EmailController::class, 'getEmailMessage']);
  Route::get('message/{id}', [EmailController::class, 'getEmailMessageById']);
  Route::get('{id}', [EmailController::class, 'getEmailById']);
  Route::get('list/subscriber', [EmailController::class, 'getSubscriber']);
  Route::post('store', [EmailController::class, 'storeEmail']);
  Route::put('{id}/update', [EmailController::class, 'updateEmail']);
  Route::delete('{id}/delete', [EmailController::class, 'deleteEmail']);
  Route::post('broadcast', [EmailController::class, 'broadcastEmail']);
  Route::post('send', [EmailController::class, 'sendEmailMessage']);
  Route::delete('message/{id}/delete', [EmailController::class, 'deleteEmailMessage']);
});

//Route::get('broadcast-template', function (){
//  $content = new \stdClass();
//  $content->body = "Now that the lakes are a lot of things, it becomes easy to make the housing easy. The fear of the memories is the love The disease was on the grid, the mass at the health, the sad players. Maecenas id eros scelerisque, vulputate tortor quis, ends. Aeneas my lake Even a lot of pain, laughter or mourning, it's just an asset.
//
//The pain itself is important, but the pain is enhanced by the adipiscing process, but I give it time to cut it down so that I do some great work and pain. In order that for the most part, any one of us will come to the exercise of any kind of employment except to take advantage of the objectives from it. But the pain in the film is irure to condemn, in pleasure it wants to escape from the pain of being cillum in pain, no result. They are the exceptions the blinds yearn for, they do not see, they are the ones who abandon their responsibilities to the fault that is soothing the soul's hardships.
//
//Now that the lakes are a lot of things, it becomes easy to make the housing easy. The fear of the memories is the love The disease was on the grid, the mass at the health, the sad players. Maecenas id eros scelerisque, vulputate tortor quis, ends. Aeneas my lake Even a lot of pain, laughter or mourning, it's just an asset.";
//  return new \App\Mail\BroadcastMail($content);
//});

Route::fallback(function () {
  return response()->json([
    'message' => 'not found'
  ], 404);
});