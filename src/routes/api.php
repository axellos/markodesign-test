<?php

declare(strict_types=1);

use App\Http\Controllers\Api\CourierController;
use Illuminate\Support\Facades\Route;

Route::prefix('couriers')->name('couriers.')->group(function () {
    Route::get('/', [CourierController::class, 'index'])->name('index');
});
