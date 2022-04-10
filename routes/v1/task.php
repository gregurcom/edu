<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TaskController;

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
