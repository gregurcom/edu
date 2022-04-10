<?php

declare(strict_types=1);

use App\Http\Controllers\API\AuthController;

Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::post('logout', [AuthController::class, 'logout'])
    ->middleware('auth:api')
    ->name('logout');
