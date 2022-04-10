<?php

declare(strict_types=1);

use App\Http\Controllers\API\Course\Lesson\FormTestController;
use App\Http\Controllers\API\Course\Lesson\ResponseController;
use Illuminate\Support\Facades\Route;

Route::get('courses/{course}/tests', [FormTestController::class, 'index'])->name('tests.index');
Route::post('courses/{course}/tests', [FormTestController::class, 'store'])->name('tests.store');

Route::get('tests/{test}', [FormTestController::class, 'show'])->name('tests.show');
Route::delete('tests/{test}', [FormTestController::class, 'destroy'])->name('tests.destroy');

Route::get('questions/{question}/responses', [ResponseController::class, 'index'])
    ->name('questions.responses.index');
Route::post('questions/{question}/responses', [ResponseController::class, 'store'])
    ->name('questions.responses.store');

Route::put('responses/{response}', [ResponseController::class, 'update'])->name('responses.update');
Route::delete('responses/{response}', [ResponseController::class, 'destroy'])->name('responses.destroy');
