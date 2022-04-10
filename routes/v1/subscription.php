<?php

declare(strict_types=1);

use App\Http\Controllers\API\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::name('subscriptions.')->group(function () {
    Route::get('subscriptions', [SubscriptionController::class, 'index'])->name('index');
    Route::post('subscriptions/{course}', [SubscriptionController::class, 'store'])->name('store');
    Route::delete('subscriptions/{course}', [SubscriptionController::class, 'destroy'])->name('destroy');
});
