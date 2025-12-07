<?php

// declare(strict_types=1);

// use Illuminate\Support\Facades\Route;
// use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
// use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

// /*
// |--------------------------------------------------------------------------
// | Tenant Routes
// |--------------------------------------------------------------------------
// |
// | Here you can register the tenant routes for your application.
// | These routes are loaded by the TenantRouteServiceProvider.
// |
// | Feel free to customize them however you want. Good luck!
// |
// */

// Route::middleware([
//     'web',
//     InitializeTenancyByDomain::class,
//     PreventAccessFromCentralDomains::class,
// ])->group(function () {
//     Route::get('/home', function () {
//         return 'Vocé está na rota do tenancy ' . tenant('id');
//     });
// });

// adicionar para o tenant carregar as todas do breeze isolando as rotas da gestaoacademia

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

// Middleware Tenancy ativo para todas as rotas do tenant
Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

    // 🔥 Rotas de autenticação do Breeze (login, register, reset, etc)
    require __DIR__.'/auth.php';

    // 🔥 Dashboard tenant
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', function () {
            return inertia('Dashboard');
        })->name('dashboard');
    });

});

?>