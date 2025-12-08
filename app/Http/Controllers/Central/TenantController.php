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

        try {

            // realiza o cadastro do tenant, dominio e roda o migrate
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

            // Criar usuário admin dentro do banco do tenant
            \App\Models\User::create([
                'name' => 'Administrador',
                'email' => 'admin@' . $data['id'] . '.com',
                'password' => bcrypt('123456'),
            ]);
         
            return redirect()->route('central.tenants.index')
            ->with('success', 'Tenant criada com sucesso!');

        } catch (\Throwable $th) {
            //throw $th;
             return back()
                ->with('error', 'Erro ao criar tenant');
        }

    }

    public function edit(Tenant $tenant)
    {
        // para pegar o tenant e exibir no formulario
        return inertia('Central/Tenants/Edit', [
            'tenant' => [
                'id' => $tenant->id,
                'domain' => optional($tenant->domains()->first())->domain ?? '',
                'created_at' => $tenant->created_at->format('d/m/Y H:i'),
            ]
        ]);
    }


    public function destroy(Tenant $tenant)
    {
        try {
            // Tenta excluir o tenant, banco de dados e domínio                        
            $tenant->delete();

            return redirect()->route('central.tenants.index')
                ->with('success', 'Tenant excluído com sucesso!');

        } catch (\Exception $e) {
            return back()
                ->with('error', 'Erro ao excluir tenant: ' . $e->getMessage());
        }
}
}
