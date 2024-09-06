<?php

use App\Http\Controllers\CarerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\DaytimeController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('uvod');
})->middleware(['auth', 'verified'])->name('uvod');



Route::get('/uvod', function () {
    return view('uvod');
})->middleware(['auth', 'verified'])->name('uvod');

Route::resource('carers', CarerController::class)
    ->only(['index', 'store', 'create', 'edit', 'update'])
    ->middleware(['auth', 'verified']);

Route::resource('clients', ClientController::class)
    ->only(['index', 'store', 'create', 'edit', 'update'])
    ->middleware(['auth', 'verified']);

Route::resource('addresses', AddressController::class)
    ->only(['store'])
    ->middleware(['auth', 'verified']);

Route::resource('daytimes', DaytimeController::class)
    ->only(['index', 'store', 'update'])
    ->middleware(['auth', 'verified']);

Route::resource('doctors', DoctorController::class)
    ->only(['index', 'store', 'destroy'])
    ->middleware(['auth', 'verified']);



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
