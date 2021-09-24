<?php

declare(strict_types = 1);

use App\Http\Controllers\Auth\AccessController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Platform\CourseController;
use App\Http\Controllers\Platform\DashboardController;
use App\Http\Controllers\Platform\LessonController;
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

Route::get('home', fn() => view('home'))->name('home');
Route::get('courses', [CourseController::class, 'list'])->name('course-list');
Route::get('course/view/{course}', [CourseController::class, 'show'])->name('course.show');
Route::get('lesson/view/{lesson}', [LessonController::class, 'show'])->name('lesson.show');

Route::name('auth.')->group(function () {
    Route::get('login', [AccessController::class, 'login'])->name('login');
    Route::post('login', [AccessController::class, 'authenticate'])->name('authenticate');

    Route::get('registration', [RegistrationController::class, 'registration'])->name('registration');
    Route::post('registration', [RegistrationController::class, 'save'])->name('registration.save');

    Route::get('logout', [AccessController::class, 'logout'])->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'show'])->name('dashboard');

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
