<?php

declare(strict_types = 1);

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CourseController;
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

Route::get('courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('courses/{course}', [CourseController::class, 'show'])->name('courses.show');

Route::get('lessons/{lesson}', [LessonController::class, 'show'])->name('lessons.show');

Route::middleware('auth:api')->group(function () {
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

    Route::apiResource('tasks', TaskController::class);

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
