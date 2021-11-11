<?php

declare(strict_types = 1);

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Platform\LocaleController;
use App\Http\Controllers\Auth\AccessController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Platform\CourseController;
use App\Http\Controllers\Platform\DashboardController;
use App\Http\Controllers\Platform\FileController;
use App\Http\Controllers\Platform\LessonController;
use App\Http\Controllers\Platform\RateController;
use App\Http\Controllers\Platform\SubscriptionController;
use App\Http\Controllers\Platform\CategoryController;
use App\Http\Controllers\Platform\TaskController;
use App\Http\Controllers\Platform\TechSupportController;
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
Route::get('dashboard', DashboardController::class)->name('dashboard')->middleware('auth');

Route::name('auth.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [AccessController::class, 'login'])->name('login');
        Route::post('login', [AccessController::class, 'authenticate'])->name('authenticate');

        Route::get('registration', [RegistrationController::class, 'registration'])->name('registration');
        Route::post('registration', [RegistrationController::class, 'save'])->name('registration.save');
    });
    Route::get('logout', [AccessController::class, 'logout'])->name('logout');
});

Route::name('platform.')->group(function () {
    Route::get('categories', CategoryController::class)->name('categories.list');
    Route::get('categories/{category}/courses', [CourseController::class, 'list'])->name('courses.list');

    Route::resource('courses', CourseController::class)->except('index');
    Route::resource('lessons', LessonController::class)->except('index');

    Route::get('search', [CourseController::class, 'search'])->name('course.search');

    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('file/{file}/download', FileController::class)->name('file.download');

        Route::resource('subscriptions', SubscriptionController::class)->only(['index', 'store', 'destroy']);

        Route::get('courses/rate/{course}', RateController::class)->name('course.rate');

        Route::get('tech-support', [TechSupportController::class, 'show'])->name('tech-support');
        Route::post('tech-support', [TechSupportController::class, 'send'])
            ->name('tech-support.send')
            ->middleware('throttle:tech-support');

        Route::name('tasks.')->group(function () {
            Route::get('tasks', [TaskController::class, 'index'])->name('index');
            Route::post('tasks', [TaskController::class, 'store'])
                ->name('store');

            Route::get('tasks/{task}/edit', [TaskController::class, 'edit'])
                ->name('edit')
                ->can('update', 'task');

            Route::put('tasks/{task}', [TaskController::class, 'update'])
                ->name('update')
                ->can('update', 'task');

            Route::delete('tasks/{task}', [TaskController::class, 'destroy'])
                ->name('destroy')
                ->can('destroy', 'task');
        });
    });
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
