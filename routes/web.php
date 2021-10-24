<?php

declare(strict_types = 1);

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
use App\Http\Controllers\Platform\TechSupportController;
use App\Http\Controllers\System\CategoryController as SystemCategoryController;
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
Route::get('language', [LocaleController::class, 'switch'])->name('language.switch');
Route::get('dashboard', [DashboardController::class, 'show'])->name('dashboard')->middleware('auth');

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
    Route::get('categories', [CategoryController::class, 'list'])->name('categories.list');
    Route::get('categories/{category:slug}/courses', [CourseController::class, 'list'])->name('courses.list');

    Route::resource('courses', CourseController::class)->except('index')->scoped([
        'course' => 'slug',
    ]);
    Route::resource('lessons', LessonController::class)->except('index')->scoped([
        'lesson' => 'slug',
    ]);

    Route::get('search', [CourseController::class, 'search'])->name('course.search');

    Route::middleware('auth')->group(function () {
        Route::get('file/{file}/download', [FileController::class, 'download'])->name('file.download');

        Route::resource('subscriptions', SubscriptionController::class)->only(['index', 'store', 'destroy']);

        Route::get('courses/rate/{course}', [RateController::class, 'rate'])->name('course.rate');

        Route::get('tech-support', [TechSupportController::class, 'show'])->name('tech-support');
        Route::post('tech-support', [TechSupportController::class, 'send'])->name('tech-support.send');
    });
});

Route::name('system.')->group(function () {
    Route::middleware(['auth', 'app.admin'])->group(function () {
        Route::resource('categories', SystemCategoryController::class)->except(['index', 'show']);
    });
});
