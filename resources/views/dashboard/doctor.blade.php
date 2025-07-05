@extends('layouts.dashboard')

@section('title', 'HealthPlus - Dashboard Doctor')

@section('content')
<div class="flex-1 p-6 lg:p-10 space-y-8">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
        <div>
            <h1 class="text-slate-800 text-3xl md:text-4xl font-bold">Dashboard Doctor</h1>
            <p class="text-slate-600 text-base mt-1">Panel de control para gestión de citas y pacientes.</p>
        </div>
    </div>

    <!-- Estadísticas del Doctor -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-xl shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-600 text-sm font-medium">Total Citas</p>
                    <p class="text-slate-800 text-2xl font-bold">{{ $stats['total_appointments'] }}</p>
                </div>
                <div class="text-blue-600 bg-blue-50 p-3 rounded-full">
                    <span class="material-icons text-2xl">event</span>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-600 text-sm font-medium">Citas Hoy</p>
                    <p class="text-slate-800 text-2xl font-bold">{{ $stats['today_appointments'] }}</p>
                </div>
                <div class="text-green-600 bg-green-50 p-3 rounded-full">
                    <span class="material-icons text-2xl">today</span>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-600 text-sm font-medium">Citas Pendientes</p>
                    <p class="text-slate-800 text-2xl font-bold">{{ $stats['pending_appointments'] }}</p>
                </div>
                <div class="text-orange-600 bg-orange-50 p-3 rounded-full">
                    <span class="material-icons text-2xl">schedule</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Acciones Rápidas -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h3 class="text-slate-800 text-lg font-semibold mb-4">Gestión de Citas</h3>
            <div class="space-y-3">
                <a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-slate-50 transition-colors">
                    <span class="material-icons text-blue-600">event</span>
                    <span class="text-slate-700">Ver Citas de Hoy</span>
                </a>
                <a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-slate-50 transition-colors">
                    <span class="material-icons text-green-600">schedule</span>
                    <span class="text-slate-700">Citas Pendientes</span>
                </a>
                <a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-slate-50 transition-colors">
                    <span class="material-icons text-purple-600">history</span>
                    <span class="text-slate-700">Historial de Citas</span>
                </a>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md">
            <h3 class="text-slate-800 text-lg font-semibold mb-4">Pacientes</h3>
            <div class="space-y-3">
                <a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-slate-50 transition-colors">
                    <span class="material-icons text-blue-600">people</span>
                    <span class="text-slate-700">Lista de Pacientes</span>
                </a>
                <a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-slate-50 transition-colors">
                    <span class="material-icons text-green-600">folder</span>
                    <span class="text-slate-700">Historiales Médicos</span>
                </a>
                <a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-slate-50 transition-colors">
                    <span class="material-icons text-purple-600">assessment</span>
                    <span class="text-slate-700">Reportes</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Próximas Citas -->
    <div class="bg-white p-6 rounded-xl shadow-md">
        <h3 class="text-slate-800 text-lg font-semibold mb-4">Próximas Citas</h3>
        <div class="space-y-4">
            <div class="flex items-center gap-4 p-3 rounded-lg hover:bg-slate-50 transition-colors">
                <div class="text-blue-600 bg-blue-50 p-3 rounded-full">
                    <span class="material-icons">person</span>
                </div>
                <div class="flex-1">
                    <p class="text-slate-800 text-sm font-medium">María García</p>
                    <p class="text-slate-600 text-xs">Consulta General - 15:30</p>
                </div>
                <span class="text-xs text-slate-400">Hoy</span>
            </div>
            <div class="flex items-center gap-4 p-3 rounded-lg hover:bg-slate-50 transition-colors">
                <div class="text-green-600 bg-green-50 p-3 rounded-full">
                    <span class="material-icons">person</span>
                </div>
                <div class="flex-1">
                    <p class="text-slate-800 text-sm font-medium">Juan Pérez</p>
                    <p class="text-slate-600 text-xs">Seguimiento - 16:00</p>
                </div>
                <span class="text-xs text-slate-400">Hoy</span>
            </div>
            <div class="flex items-center gap-4 p-3 rounded-lg hover:bg-slate-50 transition-colors">
                <div class="text-purple-600 bg-purple-50 p-3 rounded-full">
                    <span class="material-icons">person</span>
                </div>
                <div class="flex-1">
                    <p class="text-slate-800 text-sm font-medium">Ana López</p>
                    <p class="text-slate-600 text-xs">Primera Consulta - 10:00</p>
                </div>
                <span class="text-xs text-slate-400">Mañana</span>
            </div>
        </div>
    </div>
</div>
@endsection 