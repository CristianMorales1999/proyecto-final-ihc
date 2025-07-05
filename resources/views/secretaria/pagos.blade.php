@extends('layouts.dashboard')

@section('title', 'Validar Pagos')

@section('page-title', 'Validar Pagos')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-2">Validación de Pagos</h2>
        <p class="text-gray-600">Gestiona y valida los pagos de las citas médicas.</p>
    </div>

    <!-- Filtros -->
    <div class="mb-6 flex flex-wrap gap-4 items-center">
        <div class="flex items-center space-x-2">
            <label class="text-sm font-medium text-gray-700">Estado:</label>
            <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
                <option value="">Todos</option>
                <option value="pendiente">Pendiente</option>
                <option value="confirmado">Confirmado</option>
                <option value="rechazado">Rechazado</option>
            </select>
        </div>
        <div class="flex items-center space-x-2">
            <label class="text-sm font-medium text-gray-700">Método:</label>
            <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
                <option value="">Todos</option>
                <option value="tarjeta">Tarjeta</option>
                <option value="efectivo">Efectivo</option>
                <option value="transferencia">Transferencia</option>
            </select>
        </div>
        <div class="flex items-center space-x-2">
            <label class="text-sm font-medium text-gray-700">Fecha:</label>
            <input type="date" class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
        </div>
        <button class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
            <span class="material-icons text-sm mr-2">search</span>
            Filtrar
        </button>
    </div>

    <!-- Lista de pagos -->
    <div class="space-y-4">
        <div class="border border-gray-200 rounded-lg p-4">
            <div class="flex items-center justify-between mb-3">
                <div>
                    <h4 class="font-medium text-gray-800">Pago #001</h4>
                    <p class="text-gray-600 text-sm">María González López - DNI: 12345678</p>
                    <p class="text-gray-500 text-sm">Cita: Dr. Carlos Ramírez - 15/01/2025 14:00</p>
                </div>
                <div class="text-right">
                    <p class="text-lg font-bold text-green-600">S/ 150.00</p>
                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Pendiente</span>
                </div>
            </div>
            <div class="flex items-center justify-between text-sm">
                <div>
                    <p class="text-gray-600">Método: <span class="font-medium">Tarjeta Visa</span></p>
                    <p class="text-gray-600">Referencia: <span class="font-medium">TXN-2025-001</span></p>
                </div>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 bg-green-600 text-white text-xs font-medium rounded hover:bg-green-700 transition-colors">
                        Confirmar
                    </button>
                    <button class="px-3 py-1 bg-red-600 text-white text-xs font-medium rounded hover:bg-red-700 transition-colors">
                        Rechazar
                    </button>
                </div>
            </div>
        </div>

        <div class="border border-gray-200 rounded-lg p-4">
            <div class="flex items-center justify-between mb-3">
                <div>
                    <h4 class="font-medium text-gray-800">Pago #002</h4>
                    <p class="text-gray-600 text-sm">Juan Pérez Rodríguez - DNI: 87654321</p>
                    <p class="text-gray-500 text-sm">Cita: Dr. Ana Martínez - 20/01/2025 10:30</p>
                </div>
                <div class="text-right">
                    <p class="text-lg font-bold text-green-600">S/ 200.00</p>
                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Confirmado</span>
                </div>
            </div>
            <div class="flex items-center justify-between text-sm">
                <div>
                    <p class="text-gray-600">Método: <span class="font-medium">Efectivo</span></p>
                    <p class="text-gray-600">Referencia: <span class="font-medium">EF-2025-002</span></p>
                </div>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 bg-gray-400 text-white text-xs font-medium rounded cursor-not-allowed" disabled>
                        Confirmado
                    </button>
                </div>
            </div>
        </div>

        <div class="border border-gray-200 rounded-lg p-4">
            <div class="flex items-center justify-between mb-3">
                <div>
                    <h4 class="font-medium text-gray-800">Pago #003</h4>
                    <p class="text-gray-600 text-sm">Ana Martínez Silva - DNI: 11223344</p>
                    <p class="text-gray-500 text-sm">Cita: Dr. Luis García - 25/01/2025 16:00</p>
                </div>
                <div class="text-right">
                    <p class="text-lg font-bold text-green-600">S/ 180.00</p>
                    <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Rechazado</span>
                </div>
            </div>
            <div class="flex items-center justify-between text-sm">
                <div>
                    <p class="text-gray-600">Método: <span class="font-medium">Transferencia</span></p>
                    <p class="text-gray-600">Referencia: <span class="font-medium">TRF-2025-003</span></p>
                    <p class="text-red-600 text-xs">Motivo: Fondos insuficientes</p>
                </div>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 bg-gray-400 text-white text-xs font-medium rounded cursor-not-allowed" disabled>
                        Rechazado
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Estadísticas -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-blue-50 rounded-lg p-4">
            <div class="flex items-center">
                <span class="material-icons text-blue-600 mr-3">payments</span>
                <div>
                    <p class="text-sm text-blue-600">Total Pagos</p>
                    <p class="text-2xl font-bold text-blue-800">3</p>
                </div>
            </div>
        </div>
        <div class="bg-green-50 rounded-lg p-4">
            <div class="flex items-center">
                <span class="material-icons text-green-600 mr-3">check_circle</span>
                <div>
                    <p class="text-sm text-green-600">Confirmados</p>
                    <p class="text-2xl font-bold text-green-800">1</p>
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
                    <p class="text-sm text-red-600">Rechazados</p>
                    <p class="text-2xl font-bold text-red-800">1</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 