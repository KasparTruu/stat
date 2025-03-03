<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/api-keys', [ApiKeyController::class, 'index'])->name('dashboard.api-keys');
    Route::post('/dashboard/api-keys', [ApiKeyController::class, 'store'])->name('dashboard.api-keys.store');
    Route::delete('/dashboard/api-keys/{apiKey}', [ApiKeyController::class, 'destroy'])->name('dashboard.api-keys.destroy');
});
