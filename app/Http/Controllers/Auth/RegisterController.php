<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Profile;
use App\Models\Patient;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    /**
     * Mostrar el formulario de registro
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Procesar el registro
     */
    public function store(Request $request)
    {
        $request->validate([
            'dni' => 'required|string|max:8|unique:users,document_id',
            'password' => 'required|string|min:8|confirmed',
            'terms' => 'required|accepted',
        ], [
            'dni.required' => 'El DNI es obligatorio.',
            'dni.string' => 'El DNI debe ser una cadena de texto.',
            'dni.max' => 'El DNI no puede tener más de 8 caracteres.',
            'dni.unique' => 'Este DNI ya está registrado en el sistema.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'terms.required' => 'Debe aceptar los términos y condiciones.',
            'terms.accepted' => 'Debe aceptar los términos y condiciones.',
        ]);

        try {
            DB::beginTransaction();

            // Obtener el rol de paciente
            $patientRole = Role::where('name', 'paciente')->first();
            if (!$patientRole) {
                throw new \Exception('El rol de paciente no existe en el sistema.');
            }

            // Crear el usuario con document_id (DNI)
            $user = User::create([
                'role_id' => $patientRole->id,
                'document_id' => $request->dni,
                'password' => Hash::make($request->password),
                'is_active' => true,
            ]);

            // Crear el perfil
            $profile = Profile::create([
                'user_id' => $user->id,
                'email' => $request->dni . '@saludintegra.com', // Email temporal basado en DNI
                'first_name' => 'Paciente',
                'last_name' => 'Nuevo',
                'phone' => null,
                'address' => null,
                'birthdate' => null,
                'gender' => null,
            ]);

            // Crear el paciente
            Patient::create([
                'user_id' => $user->id,
                'blood_type' => null,
                'allergies' => null,
                'emergency_contact_name' => null,
                'emergency_contact_phone' => null,
                'emergency_contact_relationship' => null,
            ]);

            DB::commit();

            // Iniciar sesión automáticamente
            Auth::login($user);

            return redirect()->route('dashboard')->with('success', '¡Registro exitoso! Bienvenido a SaludIntegra.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            throw ValidationException::withMessages([
                'dni' => ['Error al crear la cuenta. Por favor, intente nuevamente.'],
            ]);
        }
    }
} 