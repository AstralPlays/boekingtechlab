<?php

use App\Modules\AccountSystem\middleware\UserAuth;
use App\View\Components\homePage;
use App\View\Components\register;
use App\View\Components\login;
use App\View\Components\reservation;
use App\View\Components\aboutUs;
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

	Route::middleware(UserAuth::class)->group(function () {
		Route::get('/reservation', [reservation::class, 'render'])->name('reservation');
	});
	
	Route::get('/login', [login::class, 'render'])->name('login');
	
	Route::get('/register', [register::class, 'render'])->name('register');
	
	Route::get('/about-us', [aboutUs::class, 'render'])->name('about-us');
});