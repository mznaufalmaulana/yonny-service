<?php

use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;

Route::prefix('dashboard')->middleware('auth:sanctum')->group(function (){
  Route::get('total-seen-share', [DashboardController::class, 'getSeenShareTotalCategory']);
  Route::get('top/seen', [DashboardController::class, 'getTopProductSeen']);
  Route::get('top/share', [DashboardController::class, 'getTopProductShare']);
});
