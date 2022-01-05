<?php

declare(strict_types = 1);

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\SettingController;
use App\Http\Controllers\Platform\LocaleController;
use App\Http\Controllers\Auth\AccessController;
use App\Http\Controllers\Auth\RegistrationController;
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

Route::view('/', 'home')->name('home');

Route::get('language', LocaleController::class)->name('language.switch');
Route::view('dashboard', 'platform.dashboard')->name('dashboard');

Route::name('auth.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [AccessController::class, 'login'])->name('login');
        Route::post('login', [AccessController::class, 'authenticate'])->name('authenticate');

        Route::get('registration', [RegistrationController::class, 'registration'])->name('registration');
        Route::post('registration', [RegistrationController::class, 'save'])->name('registration.save');
    });
    Route::get('logout', [AccessController::class, 'logout'])->name('logout');
    Route::get('settings', [SettingController::class, 'index'])->name('settings');
});

Route::name('verification.')->group(function () {
    Route::middleware(['auth', 'app.email-verification'])->group(function () {
        Route::get('verify-email', [EmailVerificationController::class, 'show'])->name('notice');
        Route::post('verify-email/request', [EmailVerificationController::class, 'request'])->name('request');

        Route::get('verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])
            ->middleware('signed')
            ->name('verify');
    });
});

Route::name('password.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('forgot-password', [PasswordResetController::class, 'forgotPassword'])->name('request');
        Route::post('forgot-password', [PasswordResetController::class, 'sendResetLink'])->name('email');

        Route::get('reset-password/{token}', [PasswordResetController::class, 'resetForm'])->name('reset');
        Route::put('reset-password', [PasswordResetController::class, 'update'])->name('update');
    });
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
