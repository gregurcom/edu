<?php

declare(strict_types = 1);

use App\Http\Controllers\Auth\AccessController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Platform\CourseController;
use App\Http\Controllers\Platform\DashboardController;
use App\Http\Controllers\Platform\FileController;
use App\Http\Controllers\Platform\LessonController;
use App\Http\Controllers\Platform\RateController;
use App\Http\Controllers\Platform\SubscriptionController;
use App\Http\Controllers\System\CategoryController;
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
Route::get('dashboard', [DashboardController::class, 'show'])->name('dashboard')->middleware('auth');

Route::name('auth.')->group(function () {
    Route::get('login', [AccessController::class, 'login'])->name('login');
    Route::post('login', [AccessController::class, 'authenticate'])->name('authenticate');

    Route::get('registration', [RegistrationController::class, 'registration'])->name('registration');
    Route::post('registration', [RegistrationController::class, 'save'])->name('registration.save');

    Route::get('logout', [AccessController::class, 'logout'])->name('logout');
});

Route::name('platform.')->group(function () {
    Route::resource('courses', CourseController::class);
    Route::resource('lessons', LessonController::class)->except('index');

    Route::get('file/{file}/download', [FileController::class, 'download'])->name('file.download');

    Route::get('search', [CourseController::class, 'search'])->name('course.search');

    Route::middleware(['auth', 'verified'])->group(function () {
        Route::resource('subscriptions', SubscriptionController::class)->only(['index', 'store', 'destroy']);

        Route::get('courses/rate/{course}', [RateController::class, 'rate'])->name('course.rate');
    });
});

Route::name('system.')->group(function () {
    Route::middleware(['auth', 'app.system-admin'])->group(function () {
        Route::resource('categories', CategoryController::class)->except(['index', 'show']);
    });
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [EmailVerificationController::class, 'show'])->name('verification.notice');
    Route::get('verify-email/request', [EmailVerificationController::class, 'request'])->name('verification.request');
    Route::get('verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])->middleware('signed')->name('verification.verify');
});
