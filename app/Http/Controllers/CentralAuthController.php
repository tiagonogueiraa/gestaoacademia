<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CentralAuthController extends Controller
{
    public function showLogin()
    {
        return inertia('Central/Login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (! Auth::guard('central')->attempt($credentials)) {
            return back()->withErrors([
                'email' => 'Credenciais inválidas',
            ]);
        }

        return redirect('/dashboard');
    }

    public function dashboard()
    {
        return inertia('Central/Dashboard');
    }

    public function logout()
    {
        Auth::guard('central')->logout();

        return redirect('/login');
    }
}
?>