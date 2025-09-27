<?php

declare(strict_types=1);

use App\Http\Controllers\Api\CourierController;
use Illuminate\Support\Facades\Route;

Route::prefix('couriers')->name('couriers.')->group(function () {
    Route::get('/', [CourierController::class, 'index'])->name('index');
    Route::post('/', [CourierController::class, 'store'])->name('store');
    Route::get('/{courier}', [CourierController::class, 'show'])->name('show');
    Route::put('/{courier}', [CourierController::class, 'update'])->name('update');
});
