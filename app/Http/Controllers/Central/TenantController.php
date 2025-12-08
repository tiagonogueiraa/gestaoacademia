<?php

namespace App\Http\Controllers\Central;

use App\Http\Controllers\Controller;
// use Stancl\Tenancy\Database\Models\Tenant;
use App\Models\Tenant;
use Stancl\Tenancy\Facades\Tenancy;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    public function index()
    {
        // RETORNA A VIEW COM TODOS OS TENANTS

        $tenants = Tenant::with('domains')->get()->map(function($tenant) {
        $firstDomain = $tenant->domains->first();
        
        return [
                'id' => $tenant->id,
                'domain' => $firstDomain ? $firstDomain->domain : 'Sem domínio',
                'created_at' => $tenant->created_at->format('d/m/Y H:i'),
            ];
        });

        return inertia('Central/Tenants/Index', [
            'tenants' => $tenants,
        ]);
    }

    public function create()
    {
        // RETORNA O FORMULÁRIO DE CRIAÇÃO DO TENANT
        return inertia('Central/Tenants/Create');
    }

    public function store(Request $request)
    {

        // Ver todos os dados que chegaram
        // dump($request->all());

        $data = $request->validate([
            'id' => 'required|string|max:255|unique:tenants,id',
            'domain' => 'required|string|max:255|unique:domains,domain',
        ]);

        // Criar tenant
        $tenant = Tenant::create([
            'id' => $data['id'],
        ]);

        // Domínio
        $tenant->domains()->create([
            'domain' => $data['domain'],
        ]);

        // Criar banco e rodar migrations
        tenancy()->initialize($tenant);
        \Artisan::call('tenants:migrate', [
            '--tenants' => [$tenant->id],
        ]);
     
        return redirect()->route('central.tenants.index')
        ->with('success', 'Tenant criada com sucesso!');
    }
}
