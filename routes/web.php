<?php

use App\Http\Controllers\Auth\AccessController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\DashboardController;
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

Route::get('/', fn() => view('home'))->name('home');

Route::name('auth.')->group(function () {
    Route::get('login', [AccessController::class, 'login'])->name('login');
    Route::post('login', [AccessController::class, 'authenticate'])->name('authenticate');

    Route::get('registration', [RegistrationController::class, 'registration'])->name('registration');
    Route::post('registration', [RegistrationController::class, 'save'])->name('registration.save');

    Route::get('logout', [AccessController::class, 'logout'])->name('logout');
});

Route::get('dashboard', [DashboardController::class, 'show'])->name('dashboard');
