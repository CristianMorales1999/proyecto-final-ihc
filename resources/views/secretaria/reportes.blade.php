@extends('layouts.dashboard')

@section('title', 'Generar Reportes')

@section('page-title', 'Generar Reportes')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-2">Generación de Reportes</h2>
        <p class="text-gray-600">Genera reportes detallados del sistema para análisis y gestión.</p>
    </div>

    <!-- Tipos de reportes -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <!-- Reporte de Citas -->
        <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center mb-4">
                <span class="material-icons text-blue-600 mr-3 text-2xl">calendar_month</span>
                <h3 class="font-medium text-gray-800">Reporte de Citas</h3>
            </div>
            <p class="text-gray-600 text-sm mb-4">Genera reportes detallados de citas por período, especialidad y estado.</p>
            <div class="space-y-3">
                <div class="flex items-center space-x-2">
                    <label class="text-sm text-gray-700">Período:</label>
                    <select class="border border-gray-300 rounded px-2 py-1 text-sm flex-1">
                        <option>Último mes</option>
                        <option>Último trimestre</option>
                        <option>Último año</option>
                        <option>Personalizado</option>
                    </select>
                </div>
                <div class="flex items-center space-x-2">
                    <label class="text-sm text-gray-700">Especialidad:</label>
                    <select class="border border-gray-300 rounded px-2 py-1 text-sm flex-1">
                        <option>Todas</option>
                        <option>Cardiología</option>
                        <option>Neurología</option>
                        <option>Pediatría</option>
                    </select>
                </div>
                <button class="w-full px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                    <span class="material-icons text-sm mr-2">download</span>
                    Generar Reporte
                </button>
            </div>
        </div>

        <!-- Reporte de Pagos -->
        <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center mb-4">
                <span class="material-icons text-green-600 mr-3 text-2xl">payments</span>
                <h3 class="font-medium text-gray-800">Reporte de Pagos</h3>
            </div>
            <p class="text-gray-600 text-sm mb-4">Análisis financiero de pagos, métodos de pago y estados de transacciones.</p>
            <div class="space-y-3">
                <div class="flex items-center space-x-2">
                    <label class="text-sm text-gray-700">Fecha Inicio:</label>
                    <input type="date" class="border border-gray-300 rounded px-2 py-1 text-sm flex-1">
                </div>
                <div class="flex items-center space-x-2">
                    <label class="text-sm text-gray-700">Fecha Fin:</label>
                    <input type="date" class="border border-gray-300 rounded px-2 py-1 text-sm flex-1">
                </div>
                <button class="w-full px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors">
                    <span class="material-icons text-sm mr-2">download</span>
                    Generar Reporte
                </button>
            </div>
        </div>

        <!-- Reporte de Pacientes -->
        <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center mb-4">
                <span class="material-icons text-purple-600 mr-3 text-2xl">people</span>
                <h3 class="font-medium text-gray-800">Reporte de Pacientes</h3>
            </div>
            <p class="text-gray-600 text-sm mb-4">Estadísticas de pacientes, demografía y patrones de consulta.</p>
            <div class="space-y-3">
                <div class="flex items-center space-x-2">
                    <label class="text-sm text-gray-700">Tipo:</label>
                    <select class="border border-gray-300 rounded px-2 py-1 text-sm flex-1">
                        <option>General</option>
                        <option>Por Edad</option>
                        <option>Por Género</option>
                        <option>Por Región</option>
                    </select>
                </div>
                <div class="flex items-center space-x-2">
                    <label class="text-sm text-gray-700">Formato:</label>
                    <select class="border border-gray-300 rounded px-2 py-1 text-sm flex-1">
                        <option>PDF</option>
                        <option>Excel</option>
                        <option>CSV</option>
                    </select>
                </div>
                <button class="w-full px-4 py-2 bg-purple-600 text-white text-sm font-medium rounded-lg hover:bg-purple-700 transition-colors">
                    <span class="material-icons text-sm mr-2">download</span>
                    Generar Reporte
                </button>
            </div>
        </div>

        <!-- Reporte de Doctores -->
        <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center mb-4">
                <span class="material-icons text-orange-600 mr-3 text-2xl">medical_services</span>
                <h3 class="font-medium text-gray-800">Reporte de Doctores</h3>
            </div>
            <p class="text-gray-600 text-sm mb-4">Rendimiento y estadísticas de los médicos del sistema.</p>
            <div class="space-y-3">
                <div class="flex items-center space-x-2">
                    <label class="text-sm text-gray-700">Métrica:</label>
                    <select class="border border-gray-300 rounded px-2 py-1 text-sm flex-1">
                        <option>Citas por Doctor</option>
                        <option>Horarios de Atención</option>
                        <option>Especialidades</option>
                    </select>
                </div>
                <div class="flex items-center space-x-2">
                    <label class="text-sm text-gray-700">Período:</label>
                    <select class="border border-gray-300 rounded px-2 py-1 text-sm flex-1">
                        <option>Este mes</option>
                        <option>Este trimestre</option>
                        <option>Este año</option>
                    </select>
                </div>
                <button class="w-full px-4 py-2 bg-orange-600 text-white text-sm font-medium rounded-lg hover:bg-orange-700 transition-colors">
                    <span class="material-icons text-sm mr-2">download</span>
                    Generar Reporte
                </button>
            </div>
        </div>

        <!-- Reporte de Ingresos -->
        <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center mb-4">
                <span class="material-icons text-emerald-600 mr-3 text-2xl">trending_up</span>
                <h3 class="font-medium text-gray-800">Reporte de Ingresos</h3>
            </div>
            <p class="text-gray-600 text-sm mb-4">Análisis de ingresos, tendencias y proyecciones financieras.</p>
            <div class="space-y-3">
                <div class="flex items-center space-x-2">
                    <label class="text-sm text-gray-700">Tipo:</label>
                    <select class="border border-gray-300 rounded px-2 py-1 text-sm flex-1">
                        <option>Mensual</option>
                        <option>Trimestral</option>
                        <option>Anual</option>
                    </select>
                </div>
                <div class="flex items-center space-x-2">
                    <label class="text-sm text-gray-700">Año:</label>
                    <select class="border border-gray-300 rounded px-2 py-1 text-sm flex-1">
                        <option>2025</option>
                        <option>2024</option>
                        <option>2023</option>
                    </select>
                </div>
                <button class="w-full px-4 py-2 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-700 transition-colors">
                    <span class="material-icons text-sm mr-2">download</span>
                    Generar Reporte
                </button>
            </div>
        </div>

        <!-- Reporte Personalizado -->
        <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center mb-4">
                <span class="material-icons text-gray-600 mr-3 text-2xl">tune</span>
                <h3 class="font-medium text-gray-800">Reporte Personalizado</h3>
            </div>
            <p class="text-gray-600 text-sm mb-4">Crea reportes personalizados con criterios específicos.</p>
            <div class="space-y-3">
                <div class="flex items-center space-x-2">
                    <label class="text-sm text-gray-700">Campos:</label>
                    <select class="border border-gray-300 rounded px-2 py-1 text-sm flex-1">
                        <option>Seleccionar campos...</option>
                    </select>
                </div>
                <div class="flex items-center space-x-2">
                    <label class="text-sm text-gray-700">Filtros:</label>
                    <select class="border border-gray-300 rounded px-2 py-1 text-sm flex-1">
                        <option>Agregar filtros...</option>
                    </select>
                </div>
                <button class="w-full px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-700 transition-colors">
                    <span class="material-icons text-sm mr-2">build</span>
                    Configurar
                </button>
            </div>
        </div>
    </div>

    <!-- Reportes recientes -->
    <div class="border-t border-gray-200 pt-6">
        <h3 class="text-lg font-medium text-gray-800 mb-4">Reportes Recientes</h3>
        <div class="space-y-3">
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                <div>
                    <h4 class="font-medium text-gray-800">Reporte de Citas - Enero 2025</h4>
                    <p class="text-gray-600 text-sm">Generado el 15/01/2025 a las 10:30</p>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Completado</span>
                    <button class="text-blue-600 hover:text-blue-800">
                        <span class="material-icons text-sm">download</span>
                    </button>
                </div>
            </div>
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                <div>
                    <h4 class="font-medium text-gray-800">Reporte de Pagos - Diciembre 2024</h4>
                    <p class="text-gray-600 text-sm">Generado el 31/12/2024 a las 23:45</p>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Completado</span>
                    <button class="text-blue-600 hover:text-blue-800">
                        <span class="material-icons text-sm">download</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 