<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CentralAuthController;

Route::get('/login', [CentralAuthController::class, 'showLogin'])->name('central.login');
Route::post('/login', [CentralAuthController::class, 'login']);

Route::middleware('auth:central')->group(function () {
    Route::get('/dashboard', [CentralAuthController::class, 'dashboard']);
    Route::post('/logout', [CentralAuthController::class, 'logout']);
});

?>