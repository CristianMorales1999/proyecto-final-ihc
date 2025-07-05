@extends('layouts.dashboard')

@section('title', 'HealthPlus - Dashboard Secretaria')

@section('content')
<div class="flex-1 p-6 lg:p-10 space-y-8">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
        <div>
            <h1 class="text-slate-800 text-3xl md:text-4xl font-bold">Dashboard Secretaria</h1>
            <p class="text-slate-600 text-base mt-1">Panel de control para gestión de citas y atención al paciente.</p>
        </div>
    </div>

    <!-- Estadísticas de la Secretaria -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
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
                    <p class="text-slate-600 text-sm font-medium">Pendientes</p>
                    <p class="text-slate-800 text-2xl font-bold">{{ $stats['pending_appointments'] }}</p>
                </div>
                <div class="text-orange-600 bg-orange-50 p-3 rounded-full">
                    <span class="material-icons text-2xl">schedule</span>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-600 text-sm font-medium">Confirmadas</p>
                    <p class="text-slate-800 text-2xl font-bold">{{ $stats['confirmed_appointments'] }}</p>
                </div>
                <div class="text-purple-600 bg-purple-50 p-3 rounded-full">
                    <span class="material-icons text-2xl">check_circle</span>
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
                    <span class="material-icons text-blue-600">add_circle</span>
                    <span class="text-slate-700">Nueva Cita</span>
                </a>
                <a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-slate-50 transition-colors">
                    <span class="material-icons text-green-600">event</span>
                    <span class="text-slate-700">Ver Todas las Citas</span>
                </a>
                <a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-slate-50 transition-colors">
                    <span class="material-icons text-purple-600">schedule</span>
                    <span class="text-slate-700">Citas Pendientes</span>
                </a>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md">
            <h3 class="text-slate-800 text-lg font-semibold mb-4">Pacientes</h3>
            <div class="space-y-3">
                <a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-slate-50 transition-colors">
                    <span class="material-icons text-blue-600">person_add</span>
                    <span class="text-slate-700">Registrar Paciente</span>
                </a>
                <a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-slate-50 transition-colors">
                    <span class="material-icons text-green-600">people</span>
                    <span class="text-slate-700">Lista de Pacientes</span>
                </a>
                <a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-slate-50 transition-colors">
                    <span class="material-icons text-purple-600">folder</span>
                    <span class="text-slate-700">Historiales Médicos</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Citas de Hoy -->
    <div class="bg-white p-6 rounded-xl shadow-md">
        <h3 class="text-slate-800 text-lg font-semibold mb-4">Citas de Hoy</h3>
        <div class="space-y-4">
            <div class="flex items-center gap-4 p-3 rounded-lg hover:bg-slate-50 transition-colors">
                <div class="text-blue-600 bg-blue-50 p-3 rounded-full">
                    <span class="material-icons">person</span>
                </div>
                <div class="flex-1">
                    <p class="text-slate-800 text-sm font-medium">María García</p>
                    <p class="text-slate-600 text-xs">Dr. Ramírez - Cardiología - 15:30</p>
                </div>
                <span class="text-xs text-green-600 bg-green-50 px-2 py-1 rounded">Confirmada</span>
            </div>
            <div class="flex items-center gap-4 p-3 rounded-lg hover:bg-slate-50 transition-colors">
                <div class="text-green-600 bg-green-50 p-3 rounded-full">
                    <span class="material-icons">person</span>
                </div>
                <div class="flex-1">
                    <p class="text-slate-800 text-sm font-medium">Juan Pérez</p>
                    <p class="text-slate-600 text-xs">Dra. López - Dermatología - 16:00</p>
                </div>
                <span class="text-xs text-orange-600 bg-orange-50 px-2 py-1 rounded">Pendiente</span>
            </div>
            <div class="flex items-center gap-4 p-3 rounded-lg hover:bg-slate-50 transition-colors">
                <div class="text-purple-600 bg-purple-50 p-3 rounded-full">
                    <span class="material-icons">person</span>
                </div>
                <div class="flex-1">
                    <p class="text-slate-800 text-sm font-medium">Ana López</p>
                    <p class="text-slate-600 text-xs">Dr. Martínez - Pediatría - 10:00</p>
                </div>
                <span class="text-xs text-green-600 bg-green-50 px-2 py-1 rounded">Confirmada</span>
            </div>
        </div>
    </div>

    <!-- Tareas Pendientes -->
    <div class="bg-white p-6 rounded-xl shadow-md">
        <h3 class="text-slate-800 text-lg font-semibold mb-4">Tareas Pendientes</h3>
        <div class="space-y-4">
            <div class="flex items-center gap-4 p-3 rounded-lg hover:bg-slate-50 transition-colors">
                <div class="text-blue-600 bg-blue-50 p-3 rounded-full">
                    <span class="material-icons">phone</span>
                </div>
                <div>
                    <p class="text-slate-800 text-sm font-medium">Llamar a paciente</p>
                    <p class="text-slate-600 text-xs">Confirmar cita de mañana - María García</p>
                </div>
                <span class="text-xs text-slate-400 ml-auto">Pendiente</span>
            </div>
            <div class="flex items-center gap-4 p-3 rounded-lg hover:bg-slate-50 transition-colors">
                <div class="text-green-600 bg-green-50 p-3 rounded-full">
                    <span class="material-icons">file_copy</span>
                </div>
                <div>
                    <p class="text-slate-800 text-sm font-medium">Preparar documentación</p>
                    <p class="text-slate-600 text-xs">Historial médico para Dr. Ramírez</p>
                </div>
                <span class="text-xs text-slate-400 ml-auto">En progreso</span>
            </div>
        </div>
    </div>
</div>
@endsection 