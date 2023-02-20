<?php

use App\Modules\Reservation\Http\Controllers\ReservationController;
use App\Modules\AccountSystem\Http\Controllers\AccountSystemController;
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

Route::get('/user/all', [AccountSystemController::class, 'index']);
Route::post('/user/register', [AccountSystemController::class, 'register']);

//route::post('/update_live_data', [ResourceController::class, 'updateLiveData']);

