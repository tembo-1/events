<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\EventController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
use App\Http\Controllers\Api\V1\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'throttle:300,60'], function() {
    Route::post('/login',           [LoginController::class, 'login']);
    Route::post('/register',        [RegisterController::class, 'register']);
});

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::resource('/events',     EventController::class);
    Route::post('/event/accept',        [EventController::class, 'accept']);
    Route::post('/event/reject',        [EventController::class, 'reject']);
});



