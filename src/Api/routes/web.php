<?php

use App\View\Components\homePage;
use App\View\Components\register;
use App\View\Components\login;
use App\View\Components\reservation;
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

Route::get('/', function () {
	return Route('home');
});

Route::get('/home', [homePage::class, 'render'])->name('home');

Route::get('/reservation', [reservation::class, 'render'])->name('reservation');

Route::get('/login', [login::class, 'render'])->name('login');

Route::get('/register', [register::class, 'render'])->name('register');
