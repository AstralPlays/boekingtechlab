<?php

use App\Modules\AccountSystem\Http\Controllers\AccountSystemController;
use App\View\Components\homePage;
use App\View\Components\register;
use App\View\Components\login;
use App\View\Components\reservation;
use App\View\Components\aboutUs;
use App\View\Components\adminDashboard;
use App\View\Components\adminManageMaterials;
use App\View\Components\adminManageRooms;
use App\View\Components\adminReservations;
use App\View\Components\userDashboard;
use App\View\Components\userReservations;
use App\View\Components\userSettings;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['web']], function () {
	Route::get('/', function () {
		return Redirect('home');
	});

	Route::get('/home', [homePage::class, 'render'])->name('home');
	Route::get('/about-us', [aboutUs::class, 'render'])->name('about-us');

	Route::middleware(['auth'])->group(function () {
		Route::get('/reservation', [reservation::class, 'render'])->name('reservation');
		Route::get('/user/logout', [AccountSystemController::class, 'logout'])->name('logout');

		Route::middleware(['role:User'])->group(function () {
			Route::get('/user', [userDashboard::class, 'render'])->name('user-dashboard');
			Route::get('/user/reservations', [userReservations::class, 'render'])->name('user-reservations');
			Route::get('/user/settings', [userSettings::class, 'render'])->name('user-settings');
		});

		Route::middleware(['role:Admin'])->group(function () {
			Route::get('/admin', [adminDashboard::class, 'render'])->name('admin-dashboard');
			Route::get('/admin/reservations', [adminReservations::class, 'render'])->name('admin-reservations');
			Route::get('/admin/accounts', [homePage::class, 'render'])->name('admin-accounts');
			Route::get('/admin/manage-rooms', [adminManageRooms::class, 'render'])->name('admin-manage-rooms');
			Route::get('/admin/manage-materials', [adminManageMaterials::class, 'render'])->name('admin-manage-materials');
			Route::get('/admin/settings', [userSettings::class, 'render'])->name('admin-settings');
		});
	});

	Route::middleware(['guest'])->group(function () {
		Route::get('/login', [login::class, 'render'])->name('login');
		Route::get('/register', [register::class, 'render'])->name('register');
	});
});
