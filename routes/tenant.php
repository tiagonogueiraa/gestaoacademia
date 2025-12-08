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
            return inertia('Tenant/Home');
        })->name('dashboard');
    });

    // CRUD de Members
    Route::prefix('members')->name('tenant.members.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Tenant\MemberController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\Tenant\MemberController::class, 'create'])->name('create');
        Route::post('/', [\App\Http\Controllers\Tenant\MemberController::class, 'store'])->name('store');
        Route::get('/{member}/edit', [\App\Http\Controllers\Tenant\MemberController::class, 'edit'])->name('edit');
        Route::put('/{member}', [\App\Http\Controllers\Tenant\MemberController::class, 'update'])->name('update');
        Route::delete('/{member}', [\App\Http\Controllers\Tenant\MemberController::class, 'destroy'])->name('destroy');
    });


    Route::get('/', function () {
        // return inertia('Tenant/Members/Index');
        return inertia('Tenant/Home');
    })->name('tenant.home');
});

?>