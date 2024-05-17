<?php

declare(strict_types=1);

use App\Http\Controllers\API\Admin\AdminController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\DashboardController;
use App\Http\Controllers\API\Course\Lesson\LessonController;
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
Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('lessons/{lesson}', [LessonController::class, 'show'])->name('lessons.show');

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('admin-panel', [AdminController::class, 'index'])->name('admin-panel.index')
        ->middleware('app.admin');
    Route::get('admin-panel/search', [AdminController::class, 'search'])->name('admin-panel.search')
        ->middleware('app.admin');
