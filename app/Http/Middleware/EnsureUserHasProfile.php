<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            // Verificar que el usuario tenga un document_id (DNI)
            if (!$user->document_id) {
                Auth::logout();
                return redirect()->route('login')
                    ->withErrors(['dni' => 'Su cuenta no tiene un DNI configurado. Por favor, contacte al administrador.']);
            }
            
            // Verificar que el usuario tenga un perfil
            if (!$user->profile) {
                Auth::logout();
                return redirect()->route('login')
                    ->withErrors(['dni' => 'Su cuenta no tiene un perfil configurado. Por favor, contacte al administrador.']);
            }
            
            // Verificar que el usuario esté activo
            if (!$user->is_active) {
                Auth::logout();
                return redirect()->route('login')
                    ->withErrors(['dni' => 'Su cuenta ha sido desactivada. Por favor, contacte al administrador.']);
            }
        }

        return $next($request);
    }
} 