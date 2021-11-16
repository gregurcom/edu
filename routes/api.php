<?php

declare(strict_types = 1);

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CourseController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::post('courses', [CourseController::class, 'store'])->name('courses.store');
    Route::put('courses/{course}', [CourseController::class, 'update'])
        ->name('courses.update')
        ->middleware('can:update,course');

    Route::delete('courses/{course}', [CourseController::class, 'destroy'])
        ->name('courses.destroy')
        ->middleware('can:destroy,course');

    Route::apiResource('tasks', TaskController::class);

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
