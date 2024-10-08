<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;


Route::post('/login', LoginController::class)->name('login');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('messages')->group(function () {
        Route::post('/', [MessageController::class, 'store'])->name('messages.store');
        Route::get('/', [MessageController::class, 'index'])->name('messages.index');
    });
});
