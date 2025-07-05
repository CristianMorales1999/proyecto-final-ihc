@extends('layouts.dashboard')

@section('title', 'HealthPlus - Dashboard Administrador')

@section('content')
<div class="flex-1 p-6 lg:p-10 space-y-8">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
        <div>
            <h1 class="text-slate-800 text-3xl md:text-4xl font-bold">Dashboard Administrador</h1>
            <p class="text-slate-600 text-base mt-1">Panel de control y gestión del sistema hospitalario.</p>
        </div>
    </div>

    <!-- Estadísticas Generales -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-xl shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-600 text-sm font-medium">Total Doctores</p>
                    <p class="text-slate-800 text-2xl font-bold">{{ $stats['total_doctors'] }}</p>
                </div>
                <div class="text-blue-600 bg-blue-50 p-3 rounded-full">
                    <span class="material-icons text-2xl">medical_services</span>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-600 text-sm font-medium">Total Pacientes</p>
                    <p class="text-slate-800 text-2xl font-bold">{{ $stats['total_patients'] }}</p>
                </div>
                <div class="text-green-600 bg-green-50 p-3 rounded-full">
                    <span class="material-icons text-2xl">people</span>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-600 text-sm font-medium">Total Citas</p>
                    <p class="text-slate-800 text-2xl font-bold">{{ $stats['total_appointments'] }}</p>
                </div>
                <div class="text-purple-600 bg-purple-50 p-3 rounded-full">
                    <span class="material-icons text-2xl">event</span>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-600 text-sm font-medium">Total Secretarias</p>
                    <p class="text-slate-800 text-2xl font-bold">{{ $stats['total_secretaries'] }}</p>
                </div>
                <div class="text-orange-600 bg-orange-50 p-3 rounded-full">
                    <span class="material-icons text-2xl">admin_panel_settings</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Acciones Rápidas -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h3 class="text-slate-800 text-lg font-semibold mb-4">Gestión de Personal</h3>
            <div class="space-y-3">
                <a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-slate-50 transition-colors">
                    <span class="material-icons text-blue-600">add_circle</span>
                    <span class="text-slate-700">Agregar Doctor</span>
                </a>
                <a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-slate-50 transition-colors">
                    <span class="material-icons text-green-600">person_add</span>
                    <span class="text-slate-700">Agregar Secretaria</span>
                </a>
                <a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-slate-50 transition-colors">
                    <span class="material-icons text-purple-600">category</span>
                    <span class="text-slate-700">Gestionar Especialidades</span>
                </a>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md">
            <h3 class="text-slate-800 text-lg font-semibold mb-4">Reportes y Análisis</h3>
            <div class="space-y-3">
                <a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-slate-50 transition-colors">
                    <span class="material-icons text-blue-600">analytics</span>
                    <span class="text-slate-700">Reporte de Citas</span>
                </a>
                <a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-slate-50 transition-colors">
                    <span class="material-icons text-green-600">assessment</span>
                    <span class="text-slate-700">Estadísticas Generales</span>
                </a>
                <a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-slate-50 transition-colors">
                    <span class="material-icons text-purple-600">history</span>
                    <span class="text-slate-700">Historial de Actividad</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Actividad Reciente -->
    <div class="bg-white p-6 rounded-xl shadow-md">
        <h3 class="text-slate-800 text-lg font-semibold mb-4">Actividad Reciente</h3>
        <div class="space-y-4">
            <div class="flex items-center gap-4 p-3 rounded-lg hover:bg-slate-50 transition-colors">
                <div class="text-blue-600 bg-blue-50 p-3 rounded-full">
                    <span class="material-icons">person_add</span>
                </div>
                <div>
                    <p class="text-slate-800 text-sm font-medium">Nuevo doctor registrado</p>
                    <p class="text-slate-600 text-xs">Dr. Juan Pérez - Cardiología</p>
                </div>
                <span class="text-xs text-slate-400 ml-auto">Hace 2h</span>
            </div>
            <div class="flex items-center gap-4 p-3 rounded-lg hover:bg-slate-50 transition-colors">
                <div class="text-green-600 bg-green-50 p-3 rounded-full">
                    <span class="material-icons">event</span>
                </div>
                <div>
                    <p class="text-slate-800 text-sm font-medium">Cita confirmada</p>
                    <p class="text-slate-600 text-xs">Paciente: María García - 15:30</p>
                </div>
                <span class="text-xs text-slate-400 ml-auto">Hace 1h</span>
            </div>
            <div class="flex items-center gap-4 p-3 rounded-lg hover:bg-slate-50 transition-colors">
                <div class="text-purple-600 bg-purple-50 p-3 rounded-full">
                    <span class="material-icons">category</span>
                </div>
                <div>
                    <p class="text-slate-800 text-sm font-medium">Nueva especialidad agregada</p>
                    <p class="text-slate-600 text-xs">Dermatología</p>
                </div>
                <span class="text-xs text-slate-400 ml-auto">Hace 3h</span>
            </div>
        </div>
    </div>
</div>
@endsection 