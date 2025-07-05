@extends('layouts.dashboard')

@section('title', 'Mis Citas')

@section('page-title', 'Mis Citas')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-2">Mis Citas Médicas</h2>
        <p class="text-gray-600">Aquí puedes ver y gestionar todas tus citas médicas programadas.</p>
    </div>

    <div class="space-y-4">
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="font-medium text-blue-900">Consulta General</h3>
                    <p class="text-blue-700 text-sm">Dr. Carlos Ramírez - Cardiología</p>
                    <p class="text-blue-600 text-sm">15 de Enero, 2025 - 14:00</p>
                </div>
                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Confirmada</span>
            </div>
        </div>

        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="font-medium text-yellow-900">Revisión de Laboratorio</h3>
                    <p class="text-yellow-700 text-sm">Dr. María González - Laboratorio</p>
                    <p class="text-yellow-600 text-sm">20 de Enero, 2025 - 10:30</p>
                </div>
                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Pendiente</span>
            </div>
        </div>

        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="font-medium text-green-900">Consulta de Seguimiento</h3>
                    <p class="text-green-700 text-sm">Dr. Ana Martínez - Medicina General</p>
                    <p class="text-green-600 text-sm">25 de Enero, 2025 - 16:00</p>
                </div>
                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Completada</span>
            </div>
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('paciente.agendarCita.create') }}" 
           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
            <span class="material-icons text-sm mr-2">add</span>
            Agendar Nueva Cita
        </a>
    </div>
</div>
@endsection 