<?php

use App\Modules\Reservation\Http\Controllers\ReservationController;
use App\Modules\AccountSystem\Http\Controllers\AccountSystemController;
use App\Modules\AccountSystem\middleware\UserAuth;
use App\Modules\Material\Http\Controllers\MaterialController;
use App\Modules\Room\Http\Controllers\RoomController;
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
Route::post('/user/changePassword', [AccountSystemController::class, 'changePassword']);

Route::post('/admin/addRoom', [RoomController::class, 'addRoom']);
Route::post('/admin/removeRoom', [RoomController::class, 'removeRoom']);
Route::post('/admin/addMaterial', [MaterialController::class, 'addMaterial']);
Route::post('/admin/removeMaterial', [MaterialController::class, 'removeMaterial']);

Route::post('/room/getRooms', [RoomController::class, 'getRooms']);
Route::post('/material/getMaterials', [MaterialController::class, 'getMaterials']);

Route::post('/reservations/create', [ReservationController::class, 'create']);
Route::post('/reservations/changeState', [ReservationController::class, 'changeState']);
Route::post('/reservations/getbydate', [ReservationController::class, 'getByDate']);
Route::post('/reservations/getByDateAdmin', [ReservationController::class, 'getByDateAdmin']);
Route::post('/reservations/getUserNextReservation', [ReservationController::class, 'getUserNextReservation']);
Route::post('/reservations/getAdminNextReservation', [ReservationController::class, 'getAdminNextReservation']);
Route::post('/reservations/getTotalReservationsToday', [ReservationController::class, 'getTotalReservationsToday']);
Route::post('/reservations/getUserReservations', [ReservationController::class, 'getUserReservations']);
Route::post('/reservations/removeUserReservation', [ReservationController::class, 'removeUserReservation']);
Route::post('/reservations/getMaterials', [ReservationController::class, 'getMaterials']);
Route::post('/reservations/getReservedMaterials', [ReservationController::class, 'getReservedMaterials']);

Route::middleware(UserAuth::class)->group(function () {
	Route::post('/auth', [AccountSystemController::class, 'auth']);
});

//route::post('/update_live_data', [ResourceController::class, 'updateLiveData']);