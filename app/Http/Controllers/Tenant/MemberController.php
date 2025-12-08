<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        return inertia('Tenant/Members/Index', [
            'members' => Member::orderBy('name')->get(),
        ]);
    }

    public function create()
    {
        return inertia('Tenant/Members/Create');
    }

    public function store(Request $request)
    {
        try {
            // Converte vírgula para ponto no plan_value
            if ($request->has('plan_value')) {
                $request->merge([
                    'plan_value' => str_replace(',', '.', $request->plan_value)
                ]);
            }
    
            $data = $request->validate([
                'name'  => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:members,email', // aqui defini que o email é unico para não dá erro para o usuário
                'phone' => 'required|string|max:50',
                'birth_date' => 'nullable|date',
                'status' => 'required|in:active,inactive',
                'street' => 'nullable|string|max:255',
                'number' => 'nullable|string|max:50',
                'district' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:255',
                'state' => 'nullable|string|max:2',
                'zip_code' => 'nullable|string|max:20',
                'plan_value' => 'required|numeric|min:0',
            ]);
    
            Member::create($data);
    
            return redirect()->route('tenant.members.index')
                ->with('success', 'Aluno cadastrado com sucesso!');

        } catch (\Throwable $th) {
            return redirect()->route('tenant.members.index')
                ->with('error', 'Erro ao cadastrar aluno!');
        }
    }

    public function edit(Member $member)
    {
        return inertia('Tenant/Members/Edit', [
            'member' => $member,
        ]);
    }

    public function update(Request $request, Member $member)
    {

        try {
            $data = $request->validate([
                'name'  => 'required|string|max:255',
                'email' => "required|email|max:255",
                'phone' => 'required|string|max:50',
                'birth_date' => 'nullable|date',
                'status' => 'required|in:active,inactive',
                'street' => 'nullable|string|max:255',
                'number' => 'nullable|string|max:50',
                'district' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:255',
                'state' => 'nullable|string|max:2',
                'zip_code' => 'nullable|string|max:20',
                'plan_value' => 'required|numeric|min:0',
            ]);
    
            $member->update($data);
    
            return redirect()->route('tenant.members.index');

        } catch (\Throwable $th) {
            return redirect()->route('tenant.members.index')
                ->with('error', 'Erro ao atualizar aluno!');
        }
    }

    public function destroy(Member $member)
    {

        try {
            
            $member->delete();
    
            return redirect()->route('tenant.members.index')
            ->with('success', 'Aluno deletado com sucesso!');

        } catch (\Throwable $th) {
            return redirect()->route('tenant.members.index')
                ->with('error', 'Erro ao deletar aluno!');
        }
    }
}
