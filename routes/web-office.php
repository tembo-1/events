<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Site\EventController;
use App\Http\Controllers\Site\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Auth::routes();

Route::group(['middleware' => 'auth:web'], function() {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::resource('/event',     EventController::class, ['names' => getResourceNames('event')]);
    Route::post('/event/accept',            [EventController::class, 'accept'])->name('event.accept');
    Route::post('/event/reject',            [EventController::class, 'reject'])->name('event.reject');
    Route::get('/user/info/{user}',         [UserController::class, 'info'])->name('user.info');
});
