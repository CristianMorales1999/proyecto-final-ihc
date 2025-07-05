@extends('layouts.dashboard')

@section('title', 'Mi Agenda')

@section('page-title', 'Mi Agenda')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-2">Mi Agenda Médica</h2>
        <p class="text-gray-600">Gestiona tu agenda de citas y horarios de atención.</p>
    </div>

    <!-- Filtros y controles -->
    <div class="mb-6 flex flex-wrap gap-4 items-center">
        <div class="flex items-center space-x-2">
            <label class="text-sm font-medium text-gray-700">Fecha:</label>
            <input type="date" value="{{ date('Y-m-d') }}" class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
        </div>
        <div class="flex items-center space-x-2">
            <label class="text-sm font-medium text-gray-700">Estado:</label>
            <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
                <option value="">Todos</option>
                <option value="confirmada">Confirmada</option>
                <option value="pendiente">Pendiente</option>
                <option value="completada">Completada</option>
                <option value="cancelada">Cancelada</option>
            </select>
        </div>
        <button class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
            <span class="material-icons text-sm mr-2">refresh</span>
            Actualizar
        </button>
    </div>

    <!-- Agenda del día -->
    <div class="space-y-4">
        <h3 class="text-lg font-medium text-gray-800">Citas de Hoy - {{ date('d/m/Y') }}</h3>
        
        <div class="space-y-3">
            <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="text-center">
                            <div class="text-lg font-bold text-blue-600">09:00</div>
                            <div class="text-xs text-gray-500">1 hora</div>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-medium text-gray-800">María González López</h4>
                            <p class="text-gray-600 text-sm">Consulta General - DNI: 12345678</p>
                            <p class="text-gray-500 text-sm">Motivo: Revisión anual</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Confirmada</span>
                        <button class="text-blue-600 hover:text-blue-800">
                            <span class="material-icons text-sm">visibility</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="text-center">
                            <div class="text-lg font-bold text-blue-600">11:00</div>
                            <div class="text-xs text-gray-500">30 min</div>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-medium text-gray-800">Juan Pérez Rodríguez</h4>
                            <p class="text-gray-600 text-sm">Consulta de Seguimiento - DNI: 87654321</p>
                            <p class="text-gray-500 text-sm">Motivo: Control de presión arterial</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Pendiente</span>
                        <button class="text-blue-600 hover:text-blue-800">
                            <span class="material-icons text-sm">visibility</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="text-center">
                            <div class="text-lg font-bold text-blue-600">14:30</div>
                            <div class="text-xs text-gray-500">45 min</div>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-medium text-gray-800">Ana Martínez Silva</h4>
                            <p class="text-gray-600 text-sm">Consulta Especializada - DNI: 11223344</p>
                            <p class="text-gray-500 text-sm">Motivo: Dolor de cabeza persistente</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Confirmada</span>
                        <button class="text-blue-600 hover:text-blue-800">
                            <span class="material-icons text-sm">visibility</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="text-center">
                            <div class="text-lg font-bold text-blue-600">16:00</div>
                            <div class="text-xs text-gray-500">1 hora</div>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-medium text-gray-800">Carlos López Vega</h4>
                            <p class="text-gray-600 text-sm">Consulta General - DNI: 55667788</p>
                            <p class="text-gray-500 text-sm">Motivo: Revisión de medicamentos</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Cancelada</span>
                        <button class="text-blue-600 hover:text-blue-800">
                            <span class="material-icons text-sm">visibility</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Estadísticas rápidas -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-blue-50 rounded-lg p-4">
            <div class="flex items-center">
                <span class="material-icons text-blue-600 mr-3">schedule</span>
                <div>
                    <p class="text-sm text-blue-600">Citas Hoy</p>
                    <p class="text-2xl font-bold text-blue-800">4</p>
                </div>
            </div>
        </div>
        <div class="bg-green-50 rounded-lg p-4">
            <div class="flex items-center">
                <span class="material-icons text-green-600 mr-3">check_circle</span>
                <div>
                    <p class="text-sm text-green-600">Confirmadas</p>
                    <p class="text-2xl font-bold text-green-800">2</p>
                </div>
            </div>
        </div>
        <div class="bg-yellow-50 rounded-lg p-4">
            <div class="flex items-center">
                <span class="material-icons text-yellow-600 mr-3">pending</span>
                <div>
                    <p class="text-sm text-yellow-600">Pendientes</p>
                    <p class="text-2xl font-bold text-yellow-800">1</p>
                </div>
            </div>
        </div>
        <div class="bg-red-50 rounded-lg p-4">
            <div class="flex items-center">
                <span class="material-icons text-red-600 mr-3">cancel</span>
                <div>
                    <p class="text-sm text-red-600">Canceladas</p>
                    <p class="text-2xl font-bold text-red-800">1</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 