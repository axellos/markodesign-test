<?php

declare(strict_types=1);

use App\Http\Controllers\Api\CourierController;
use App\Http\Controllers\Api\CourierLocationController;
use Illuminate\Support\Facades\Route;

Route::prefix('couriers')->name('api.couriers.')->group(function () {
    Route::get('/', [CourierController::class, 'index'])->name('index');
    Route::post('/', [CourierController::class, 'store'])->name('store');
    Route::get('/{courier}', [CourierController::class, 'show'])->name('show');
    Route::put('/{courier}', [CourierController::class, 'update'])->name('update');
    Route::delete('/{courier}', [CourierController::class, 'destroy'])->name('destroy');

    Route::put('{courier}/location', [CourierLocationController::class, 'update']);
});

Route::get('courier-locations', [CourierLocationController::class, 'index'])->name('courier-locations.index');
