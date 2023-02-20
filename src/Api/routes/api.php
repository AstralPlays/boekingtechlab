<?php

use App\Modules\Reservation\Http\Controllers\ReservationController;
use App\Modules\UserLogin\Http\Controllers\UserLoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/reservation/all', [ReservationController::class, 'index']);

Route::get('/users/all', [UserLoginController::class, 'index']);

//route::post('/update_live_data', [ResourceController::class, 'updateLiveData']);

