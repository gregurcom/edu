<?php

declare(strict_types=1);

use App\Http\Controllers\Platform\CourseController;
use App\Http\Controllers\Platform\FileController;
use App\Http\Controllers\Platform\LessonController;
use App\Http\Controllers\Platform\RateController;
use App\Http\Controllers\Platform\SubscriptionController;
use App\Http\Controllers\Platform\TaskController;
use App\Http\Controllers\Platform\TechSupportController;
use Illuminate\Support\Facades\Route;

Route::get('categories/{category}/courses', [CourseController::class, 'list'])->name('courses.list');

Route::view('feed', 'platform.feed')->name('feed.index');

Route::name('subscriptions.')->group(function () {
    Route::post('subscriptions/{course}', [SubscriptionController::class, 'store'])->name('store');
    Route::delete('subscriptions/{course}', [SubscriptionController::class, 'destroy'])->name('destroy');
});

Route::view('categories', 'platform.categories')->name('categories.list');
Route::view('subscriptions', 'platform.subscriptions')->name('subscriptions.index');

Route::get('courses/{course}', [CourseController::class, 'show'])->name('courses.show');

Route::resource('lessons', LessonController::class)->except(['index', 'create']);
Route::get('lessons/create/{course}', [LessonController::class, 'create'])->name('lessons.create');

Route::get('search', [CourseController::class, 'search'])->name('course.search');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('file/{file}/download', FileController::class)->name('file.download');;

    Route::get('courses/rate/{course}', RateController::class)->name('course.rate');

    Route::get('tech-support', [TechSupportController::class, 'show'])->name('tech-support');
    Route::post('tech-support', [TechSupportController::class, 'send'])
        ->name('tech-support.send')
        ->middleware('throttle:tech-support');

    Route::view('tasks', 'platform.task.index')->name('tasks');
    Route::get('tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit')
        ->can('edit', 'task');
    Route::put('tasks/{task}/update', [TaskController::class, 'update'])->name('tasks.update')
        ->can('update', 'task');

    Route::get('courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('courses', [CourseController::class, 'store'])->name('courses.store');
    Route::get('courses/{course}/edit', [CourseController::class, 'edit'])
        ->name('courses.edit')
        ->can('edit', 'course');
    Route::put('courses/{course}', [CourseController::class, 'update'])
        ->name('courses.update')
        ->can('update', 'course');
    Route::delete('courses/{course}', [CourseController::class, 'destroy'])
        ->name('courses.destroy')
        ->can('destroy', 'course');
});
