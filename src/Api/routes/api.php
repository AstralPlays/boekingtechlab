<?php

use App\Modules\Reservation\Http\Controllers\ReservationController;
use App\Modules\AccountSystem\Http\Controllers\AccountSystemController;
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


Route::middleware(['auth'])->group(function () {
	Route::post('/room/getRooms', [RoomController::class, 'getRooms']);
	Route::post('/material/getMaterials', [MaterialController::class, 'getMaterials']);
	Route::post('/reservations/create', [ReservationController::class, 'create']);
	Route::post('/reservations/getbydate', [ReservationController::class, 'getByDate']);
	Route::post('/reservations/getReservedMaterials', [ReservationController::class, 'getReservedMaterials']);
	Route::post('/changePassword', [AccountSystemController::class, 'changePassword']);

	Route::middleware(['role:User'])->group(function () {
		Route::post('/reservations/getUserNextReservation', [ReservationController::class, 'getUserNextReservation']);
		Route::post('/reservations/getUserReservations', [ReservationController::class, 'getUserReservations']);
	});

	Route::middleware(['role:Admin'])->group(function () {
		Route::post('/admin/addRoom', [RoomController::class, 'addRoom']);
		Route::post('/admin/removeRoom', [RoomController::class, 'removeRoom']);
		Route::post('/admin/addMaterial', [MaterialController::class, 'addMaterial']);
		Route::post('/admin/removeMaterial', [MaterialController::class, 'removeMaterial']);
		Route::post('/reservations/changeState', [ReservationController::class, 'changeState']);
		Route::post('/reservations/getByDateAdmin', [ReservationController::class, 'getByDateAdmin']);
		Route::post('/reservations/getAdminNextReservation', [ReservationController::class, 'getAdminNextReservation']);
		Route::post('/reservations/getTotalReservationsToday', [ReservationController::class, 'getTotalReservationsToday']);
		Route::post('/reservations/removeUserReservation', [ReservationController::class, 'removeUserReservation']);
	});
});

Route::middleware(['guest'])->group(function () {
	Route::post('/register', [AccountSystemController::class, 'register']);
	Route::post('/login', [AccountSystemController::class, 'login']);
});
