<?php

declare(strict_types=1);

use App\Http\Controllers\API\Course\CourseController;
use App\Http\Controllers\API\Course\Lesson\LessonController;
use Illuminate\Support\Facades\Route;

Route::name('courses.')->group(function () {
    Route::get('courses', [CourseController::class, 'index'])->name('index');
    Route::get('courses/{course}', [CourseController::class, 'show'])->name('show');
    Route::get('courses/search', [CourseController::class, 'search'])->name('search');

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
