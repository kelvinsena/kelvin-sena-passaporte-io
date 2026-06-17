<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //tela de login
    public function showLogin()
    {
        return view('auth.login');
    }

    
    public function login(Request $request)
    {
        // validacao
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // autenticacao
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // eedback visual baseado no perfil
            if (Auth::user()->role === 'organizador') {
                return redirect()->route('admin.events.index')->with('success', 'Bem-vindo ao Painel de Controle!');
            }
            
            return redirect()->route('home')->with('success', 'Login realizado com sucesso!');
        }

    
        return back()->withErrors([
            'email' => 'As credenciais fornecidas não coincidem com nossos registros.',
        ])->withInput();
    }

    //tela de registro
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'], // RN08: E-mail único
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'role' => ['required', 'in:participante,organizador'], // Escolha do Perfil
        ]);

        // cria o usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // loga automaticamente
        Auth::login($user);

        return redirect()->route('home')->with('success', 'Conta criada com sucesso!');
    }

    // Encerramento de Sessão - Logout (RF03)
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Sessão encerrada com segurança.');
    }
}