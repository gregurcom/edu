<?php

declare(strict_types = 1);

use App\Http\Controllers\Auth\AccessController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Platform\CourseController;
use App\Http\Controllers\Platform\DashboardController;
use App\Http\Controllers\Platform\LessonController;
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

Route::get('dashboard', [DashboardController::class, 'show'])->name('dashboard')->middleware('auth');

Route::name('auth.')->group(function () {
    Route::get('login', [AccessController::class, 'login'])->name('login');
    Route::post('login', [AccessController::class, 'authenticate'])->name('authenticate');

    Route::get('registration', [RegistrationController::class, 'registration'])->name('registration');
    Route::post('registration', [RegistrationController::class, 'save'])->name('registration.save');

    Route::get('logout', [AccessController::class, 'logout'])->name('logout');
});

Route::name('platform.')->group(function () {
    Route::get('home', fn() => view('platform.home'))->name('home');

    Route::get('courses', [CourseController::class, 'list'])->name('course-list');
    Route::get('courses/followed', [CourseController::class, 'followed'])->name('course-followed');
    Route::get('course/view/{course}', [CourseController::class, 'show'])->name('course.show');
    Route::get('course/search', [CourseController::class, 'search'])->name('course.search');
    Route::get('course/follow/{course}', [CourseController::class, 'follow'])->name('course.follow');
    Route::get('course/unfollow/{course}', [CourseController::class, 'unfollow'])->name('course.unfollow');

    Route::get('lesson/view/{lesson}', [LessonController::class, 'show'])->name('lesson.show');

    Route::middleware('auth')->group(function () {
        Route::get('course/create', [CourseController::class, 'createForm'])->name('course.creation');
        Route::post('course/create', [CourseController::class, 'create'])->name('course.create');

        Route::get('course/edit/{course}', [CourseController::class, 'editForm'])->name('course.edit-form');
        Route::post('course/edit/{course}', [CourseController::class, 'edit'])->name('course.edit');

        Route::delete('course/delete/{course}', [CourseController::class, 'delete'])->name('course.delete');

        Route::get('{course}/lesson/create', [LessonController::class, 'createForm'])->name('lesson.creation');
        Route::post('{course}/lesson/create', [LessonController::class, 'create'])->name('lesson.create');

        Route::get('lesson/edit/{lesson}', [LessonController::class, 'editForm'])->name('lesson.edit-form');
        Route::post('lesson/edit/{lesson}', [LessonController::class, 'edit'])->name('lesson.edit');

        Route::delete('lesson/delete/{lesson}', [LessonController::class, 'delete'])->name('lesson.delete');
    });
});

Route::name('system.')->group(function () {
    Route::middleware(['auth', 'app.system-admin'])->group(function () {
        Route::get('category/create', [CategoryController::class, 'createForm'])->name('category.creation');
        Route::post('category/create', [CategoryController::class, 'create'])->name('category.create');
    });
});
