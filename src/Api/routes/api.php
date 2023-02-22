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

Route::post('/user/register', [AccountSystemController::class, 'register']);
Route::post('/user/login', [AccountSystemController::class, 'login']);

Route::post('/auth', function(){
    return Response(json_encode('Authorized'), 200);
})->middleware(UserAuth::class);

Route::middleware(UserAuth::class)->group(function () {
    Route::post('/reservations/create', [ReservationController::class, 'create']);
});

//route::post('/update_live_data', [ResourceController::class, 'updateLiveData']);

