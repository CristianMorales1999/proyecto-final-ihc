<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Muestra el dashboard según el rol del usuario
     */
    public function index()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        // Determinar el dashboard según el rol
        switch ($user->role->name) {
            case 'admin':
                return $this->adminDashboard();
            case 'doctor':
                return $this->doctorDashboard();
            case 'secretaria':
                return $this->secretariaDashboard();
            case 'paciente':
                return $this->pacienteDashboard();
            default:
                abort(403, 'Rol no reconocido');
        }
    }

    /**
     * Dashboard del administrador
     */
    private function adminDashboard()
    {
        $stats = [
            'total_doctors' => \App\Models\Doctor::count(),
            'total_patients' => \App\Models\Patient::count(),
            'total_appointments' => \App\Models\Appointment::count(),
            'total_secretaries' => \App\Models\Secretary::count(),
        ];

        return view('dashboard.admin', compact('stats'));
    }

    /**
     * Dashboard del doctor
     */
    private function doctorDashboard()
    {
        $doctor = Auth::user()->doctor;
        
        if (!$doctor) {
            abort(403, 'No tienes acceso al dashboard de doctor');
        }

        $stats = [
            'total_appointments' => \App\Models\Appointment::where('doctor_id', $doctor->id)->count(),
            'today_appointments' => \App\Models\Appointment::where('doctor_id', $doctor->id)
                ->whereDate('appointment_date', today())->count(),
            'pending_appointments' => \App\Models\Appointment::where('doctor_id', $doctor->id)
                ->where('status', 'pendiente')->count(),
        ];

        return view('dashboard.doctor', compact('stats', 'doctor'));
    }

    /**
     * Dashboard de la secretaria
     */
    private function secretariaDashboard()
    {
        $secretary = Auth::user()->secretary;
        
        if (!$secretary) {
            abort(403, 'No tienes acceso al dashboard de secretaria');
        }

        $stats = [
            'total_appointments' => \App\Models\Appointment::count(),
            'today_appointments' => \App\Models\Appointment::whereDate('appointment_date', today())->count(),
            'pending_appointments' => \App\Models\Appointment::where('status', 'pendiente')->count(),
            'confirmed_appointments' => \App\Models\Appointment::where('status', 'confirmada')->count(),
        ];

        return view('dashboard.secretaria', compact('stats', 'secretary'));
    }

    /**
     * Dashboard del paciente
     */
    private function pacienteDashboard()
    {
        $patient = Auth::user()->patient;
        
        if (!$patient) {
            abort(403, 'No tienes acceso al dashboard de paciente');
        }

        $stats = [
            'total_appointments' => \App\Models\Appointment::where('patient_id', $patient->id)->count(),
            'upcoming_appointments' => \App\Models\Appointment::where('patient_id', $patient->id)
                ->where('appointment_date', '>=', now())->count(),
            'completed_appointments' => \App\Models\Appointment::where('patient_id', $patient->id)
                ->where('status', 'completada')->count(),
        ];

        return view('dashboard.paciente', compact('stats', 'patient'));
    }
} 