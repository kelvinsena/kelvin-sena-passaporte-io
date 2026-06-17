<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Trata uma requisição de entrada.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Você precisa fazer login para acessar esta área.'); // RNF10
        }

        if (Auth::user()->role !== $role) {
            abort(403, 'Acesso negado. Seu perfil não tem permissão para esta funcionalidade.'); // Erro HTTP 403 [cite: 194]
        }

        return $next($request);
    }
}