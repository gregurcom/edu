<?php

declare(strict_types = 1);

use App\Http\Controllers\API\Admin\AdminController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\CourseController;
use App\Http\Controllers\API\DashboardController;
use App\Http\Controllers\API\LessonController;
use App\Http\Controllers\API\SubscriptionController;
use App\Http\Controllers\API\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('courses/{course}', [CourseController::class, 'show'])->name('courses.show');
Route::get('courses/search', [CourseController::class, 'search'])->name('courses.search');

Route::get('lessons/{lesson}', [LessonController::class, 'show'])->name('lessons.show');

Route::middleware('auth:api')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('admin-panel', [AdminController::class, 'index'])
        ->name('admin-panel.index')
        ->middleware('app.admin');

    Route::name('courses.')->group(function () {
        Route::post('courses', [CourseController::class, 'store'])->name('store');

        Route::put('courses/{course}', [CourseController::class, 'update'])
            ->name('update')
            ->can('update', 'course');

        Route::delete('courses/{course}', [CourseController::class, 'destroy'])
            ->name('destroy')
            ->can('destroy', 'course');
    });

    Route::name('lessons.')->group(function () {
        Route::get('lessons/create', [LessonController::class, 'create'])->name('create');
        Route::post('lessons', [LessonController::class, 'store'])->name('store');

        Route::put('lessons/{lesson}', [LessonController::class, 'update'])
            ->name('update')
            ->can('update', 'lesson');

        Route::delete('lessons/{lesson}', [LessonController::class, 'destroy'])
            ->name('destroy')
            ->can('destroy', 'lesson');
    });

    Route::name('subscriptions.')->group(function () {
        Route::get('subscriptions', [SubscriptionController::class, 'index'])->name('index');
        Route::post('subscriptions/{course}', [SubscriptionController::class, 'store'])->name('store');
        Route::delete('subscriptions/{course}', [SubscriptionController::class, 'destroy'])->name('destroy');
    });

    Route::name('tasks.')->group(function () {
        Route::get('tasks', [TaskController::class, 'index'])->name('index');
        Route::post('tasks', [TaskController::class, 'store'])->name('store');
        Route::put('tasks/{task}', [TaskController::class, 'update'])
            ->name('update')
            ->can('update', 'task');
        Route::delete('tasks/{task}', [TaskController::class, 'destroy'])
            ->name('destroy')
            ->can('destroy', 'task');
    });

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
