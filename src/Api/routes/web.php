<?php

use App\Modules\AccountSystem\Http\Controllers\AccountSystemController;
use App\Modules\AccountSystem\middleware\AdminAuth;
use App\Modules\AccountSystem\middleware\UserAuth;
use App\View\Components\homePage;
use App\View\Components\register;
use App\View\Components\login;
use App\View\Components\reservation;
use App\View\Components\aboutUs;
use App\View\Components\adminDashboard;
use App\View\Components\adminReservations;
use App\View\Components\userDashboard;
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

	Route::middleware(UserAuth::class)->group(function () {
		Route::get('/user', [userDashboard::class, 'render'])->name('user-dashboard');
		Route::get('/user/reservations', [homePage::class, 'render'])->name('user-reservations');
		Route::get('/user/settings', [homePage::class, 'render'])->name('user-settings');
	});
	Route::get('/reservation', [reservation::class, 'render'])->name('reservation');

	Route::middleware(AdminAuth::class)->group(function () {
		Route::get('/admin', [adminDashboard::class, 'render'])->name('admin-dashboard');
		Route::get('/admin/reservations', [adminReservations::class, 'render'])->name('admin-reservations');
		Route::get('/admin/accounts', [homePage::class, 'render'])->name('admin-accounts');
		Route::get('/admin/settings', [homePage::class, 'render'])->name('admin-settings');
	});


	Route::get('/home', [homePage::class, 'render'])->name('home');

	Route::get('/login', [login::class, 'render'])->name('login');

	Route::get('/user/logout', [AccountSystemController::class, 'logout'])->name('logout');

	Route::get('/register', [register::class, 'render'])->name('register');

	Route::get('/about-us', [aboutUs::class, 'render'])->name('about-us');
});
