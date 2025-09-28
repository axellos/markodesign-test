<?php

declare(strict_types=1);

use App\Http\Controllers\CourierController;
use App\Http\Controllers\CourierLocationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CourierController::class, 'index'])->name('couriers.index');
Route::get('/couriers/create', [CourierController::class, 'create'])->name('couriers.create');
Route::get('/couriers/{courier}/edit', [CourierController::class, 'edit'])->name('couriers.edit');

Route::get('map', [CourierLocationController::class, 'map'])->name('map');
Route::get('debug', [CourierLocationController::class, 'debug'])->name('debug');
