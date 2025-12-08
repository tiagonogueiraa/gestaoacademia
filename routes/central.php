<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CentralAuthController;
use App\Http\Controllers\Central\TenantController;

Route::get('/login', [CentralAuthController::class, 'showLogin'])->name('central.login');
Route::post('/login', [CentralAuthController::class, 'login']);

Route::get('/', [CentralAuthController::class, 'dashboard'])->name('central.home');

Route::middleware('auth:central')->group(function () {
    // ROTAS DE AUTENTICAÇÃO E HOME QUANDO ESTÁ LOGADO
    Route::get('/dashboard', [CentralAuthController::class, 'dashboard']);
    Route::post('/logout', [CentralAuthController::class, 'logout']);

    // ROTAS DO TENANT
    Route::get('/tenants', [TenantController::class, 'index'])->name('central.tenants.index');
    Route::get('/tenants/create', [TenantController::class, 'create'])->name('central.tenants.create');
    Route::post('/tenants', [TenantController::class, 'store'])->name('central.tenants.store');
});

?>