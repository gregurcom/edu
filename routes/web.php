<?php

declare(strict_types = 1);

use App\Http\Controllers\Auth\AccessController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Platform\CourseController;
use App\Http\Controllers\Platform\DashboardController;
use App\Http\Controllers\Platform\LessonController;
use App\Http\Controllers\Platform\RateController;
use App\Http\Controllers\System\CategoryController;
use App\Http\Controllers\System\UserController;
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

Route::get('dashboard', [DashboardController::class, 'show'])->name('dashboard')->middleware('auth');

Route::name('auth.')->group(function () {
    Route::get('login', [AccessController::class, 'login'])->name('login');
    Route::post('login', [AccessController::class, 'authenticate'])->name('authenticate');

    Route::middleware('app.verify-user-token')->group(function () {
        Route::get('registration', [RegistrationController::class, 'registration'])->name('registration');
        Route::post('registration', [RegistrationController::class, 'save'])->name('registration.save');
    });

    Route::get('logout', [AccessController::class, 'logout'])->name('logout');
});

Route::name('platform.')->group(function () {
    Route::get('/', fn() => view('platform.home'))->name('home');

    Route::get('courses', [CourseController::class, 'list'])->name('course-list');
    Route::get('courses/{course}', [CourseController::class, 'show'])->name('course.show');

    Route::get('courses/followed', [CourseController::class, 'followed'])->name('course-followed');

    Route::get('courses/search', [CourseController::class, 'search'])->name('course.search');

    Route::get('courses/follow/{course}', [CourseController::class, 'follow'])->name('course.follow');
    Route::get('courses/unfollow/{course}', [CourseController::class, 'unfollow'])->name('course.unfollow');

    Route::get('lessons/{lesson}', [LessonController::class, 'show'])->name('lesson.show');

    Route::middleware('auth')->group(function () {
        Route::get('courses/create', [CourseController::class, 'createForm'])->name('course.creation');
        Route::post('courses/create', [CourseController::class, 'create'])->name('course.create');

        Route::get('courses/rate/{course}', [RateController::class, 'rate'])->name('course.rate');

        Route::get('courses/edit/{course}', [CourseController::class, 'editForm'])->name('course.edit-form');
        Route::post('courses/edit/{course}', [CourseController::class, 'edit'])->name('course.edit');

        Route::delete('courses/delete/{course}', [CourseController::class, 'delete'])->name('course.delete');


        Route::get('lessons/create/{course}', [LessonController::class, 'createForm'])->name('lesson.creation');
        Route::post('lessons/create/{course}', [LessonController::class, 'create'])->name('lesson.create');

        Route::get('lessons/edit/{lesson}', [LessonController::class, 'editForm'])->name('lesson.edit-form');
        Route::post('lessons/edit/{lesson}', [LessonController::class, 'edit'])->name('lesson.edit');

        Route::delete('lessons/delete/{lesson}', [LessonController::class, 'delete'])->name('lesson.delete');
    });
});

Route::name('system.')->group(function () {
    Route::middleware(['auth', 'app.system-admin'])->group(function () {
        Route::get('categories/create', [CategoryController::class, 'createForm'])->name('category.creation');
        Route::post('categories/create', [CategoryController::class, 'create'])->name('category.create');

        Route::get('categories/edit/{category}', [CategoryController::class, 'editForm'])->name('category.edit-form');
        Route::post('categories/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');

        Route::delete('categories/delete/{category}', [CategoryController::class, 'delete'])->name('category.delete');

        Route::get('users/create', [UserController::class, 'createForm'])->name('user.creation');
        Route::post('users/create', [UserController::class, 'create'])->name('user.create');
    });
});
