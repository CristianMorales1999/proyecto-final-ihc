<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Mostrar el formulario de login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Procesar el login
     */
    public function login(Request $request)
    {
        $request->validate([
            'dni' => 'required|string|max:8',
            'password' => 'required|string',
        ], [
            'dni.required' => 'El DNI es obligatorio.',
            'dni.string' => 'El DNI debe ser una cadena de texto.',
            'dni.max' => 'El DNI no puede tener más de 8 caracteres.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        // Buscar usuario por document_id (DNI)
        $user = User::where('document_id', $request->dni)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'dni' => ['Las credenciales proporcionadas no coinciden con nuestros registros.'],
            ]);
        }

        // Verificar que el usuario esté activo
        if (!$user->is_active) {
            throw ValidationException::withMessages([
                'dni' => ['Su cuenta ha sido desactivada. Contacte al administrador.'],
            ]);
        }

        Auth::login($user, $request->boolean('remember'));

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }

    /**
     * Cerrar sesión
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
} 