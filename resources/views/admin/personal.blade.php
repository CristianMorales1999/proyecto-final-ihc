@extends('layouts.dashboard')

@section('title', 'Gestión de Cuentas')

@section('page-title', 'Gestión de Cuentas')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-2">Gestión de Cuentas del Personal</h2>
        <p class="text-gray-600">Administra las cuentas de doctores, secretarias y personal del sistema.</p>
    </div>

    <!-- Controles superiores -->
    <div class="mb-6 flex flex-wrap gap-4 items-center justify-between">
        <div class="flex flex-wrap gap-4 items-center">
            <div class="flex items-center space-x-2">
                <label class="text-sm font-medium text-gray-700">Rol:</label>
                <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    <option value="">Todos</option>
                    <option value="doctor">Doctores</option>
                    <option value="secretaria">Secretarias</option>
                    <option value="admin">Administradores</option>
                </select>
            </div>
            <div class="flex items-center space-x-2">
                <label class="text-sm font-medium text-gray-700">Estado:</label>
                <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    <option value="">Todos</option>
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                </select>
            </div>
            <button class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                <span class="material-icons text-sm mr-2">search</span>
                Filtrar
            </button>
        </div>
        <button class="px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors">
            <span class="material-icons text-sm mr-2">add</span>
            Agregar Personal
        </button>
    </div>

    <!-- Lista de personal -->
    <div class="space-y-4">
        <!-- Doctor -->
        <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <span class="material-icons text-blue-600">medical_services</span>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-800">Dr. Carlos Ramírez</h4>
                        <p class="text-gray-600 text-sm">DNI: 12345678 - Cardiología</p>
                        <p class="text-gray-500 text-sm">carlos.ramirez@healthplus.com</p>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Activo</span>
                    <div class="flex space-x-2">
                        <button class="text-blue-600 hover:text-blue-800" title="Editar">
                            <span class="material-icons text-sm">edit</span>
                        </button>
                        <button class="text-yellow-600 hover:text-yellow-800" title="Suspender">
                            <span class="material-icons text-sm">block</span>
                        </button>
                        <button class="text-red-600 hover:text-red-800" title="Eliminar">
                            <span class="material-icons text-sm">delete</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Secretaria -->
        <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                        <span class="material-icons text-purple-600">admin_panel_settings</span>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-800">María González</h4>
                        <p class="text-gray-600 text-sm">DNI: 87654321 - Secretaria</p>
                        <p class="text-gray-500 text-sm">maria.gonzalez@healthplus.com</p>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Activo</span>
                    <div class="flex space-x-2">
                        <button class="text-blue-600 hover:text-blue-800" title="Editar">
                            <span class="material-icons text-sm">edit</span>
                        </button>
                        <button class="text-yellow-600 hover:text-yellow-800" title="Suspender">
                            <span class="material-icons text-sm">block</span>
                        </button>
                        <button class="text-red-600 hover:text-red-800" title="Eliminar">
                            <span class="material-icons text-sm">delete</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Doctor -->
        <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <span class="material-icons text-blue-600">medical_services</span>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-800">Dra. Ana Martínez</h4>
                        <p class="text-gray-600 text-sm">DNI: 11223344 - Medicina General</p>
                        <p class="text-gray-500 text-sm">ana.martinez@healthplus.com</p>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Activo</span>
                    <div class="flex space-x-2">
                        <button class="text-blue-600 hover:text-blue-800" title="Editar">
                            <span class="material-icons text-sm">edit</span>
                        </button>
                        <button class="text-yellow-600 hover:text-yellow-800" title="Suspender">
                            <span class="material-icons text-sm">block</span>
                        </button>
                        <button class="text-red-600 hover:text-red-800" title="Eliminar">
                            <span class="material-icons text-sm">delete</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Secretaria suspendida -->
        <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                        <span class="material-icons text-purple-600">admin_panel_settings</span>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-800">Laura Torres</h4>
                        <p class="text-gray-600 text-sm">DNI: 55667788 - Secretaria</p>
                        <p class="text-gray-500 text-sm">laura.torres@healthplus.com</p>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Suspendida</span>
                    <div class="flex space-x-2">
                        <button class="text-blue-600 hover:text-blue-800" title="Editar">
                            <span class="material-icons text-sm">edit</span>
                        </button>
                        <button class="text-green-600 hover:text-green-800" title="Activar">
                            <span class="material-icons text-sm">check_circle</span>
                        </button>
                        <button class="text-red-600 hover:text-red-800" title="Eliminar">
                            <span class="material-icons text-sm">delete</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Estadísticas -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-blue-50 rounded-lg p-4">
            <div class="flex items-center">
                <span class="material-icons text-blue-600 mr-3">medical_services</span>
                <div>
                    <p class="text-sm text-blue-600">Total Doctores</p>
                    <p class="text-2xl font-bold text-blue-800">12</p>
                </div>
            </div>
        </div>
        <div class="bg-purple-50 rounded-lg p-4">
            <div class="flex items-center">
                <span class="material-icons text-purple-600 mr-3">admin_panel_settings</span>
                <div>
                    <p class="text-sm text-purple-600">Total Secretarias</p>
                    <p class="text-2xl font-bold text-purple-800">8</p>
                </div>
            </div>
        </div>
        <div class="bg-green-50 rounded-lg p-4">
            <div class="flex items-center">
                <span class="material-icons text-green-600 mr-3">check_circle</span>
                <div>
                    <p class="text-sm text-green-600">Activos</p>
                    <p class="text-2xl font-bold text-green-800">19</p>
                </div>
            </div>
        </div>
        <div class="bg-red-50 rounded-lg p-4">
            <div class="flex items-center">
                <span class="material-icons text-red-600 mr-3">block</span>
                <div>
                    <p class="text-sm text-red-600">Suspendidos</p>
                    <p class="text-2xl font-bold text-red-800">1</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 