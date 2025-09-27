<?php

declare(strict_types=1);

use App\Http\Controllers\CourierController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CourierController::class, 'index'])->name('couriers.index');
