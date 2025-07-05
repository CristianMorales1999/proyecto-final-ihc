@extends('layouts.dashboard')

@section('title', 'Gestión de Especialidades')

@section('page-title', 'Gestión de Especialidades')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-2">Gestión de Especialidades Médicas</h2>
        <p class="text-gray-600">Administra las especialidades médicas disponibles en el sistema.</p>
    </div>

    <!-- Controles superiores -->
    <div class="mb-6 flex flex-wrap gap-4 items-center justify-between">
        <div class="flex flex-wrap gap-4 items-center">
            <div class="flex items-center space-x-2">
                <label class="text-sm font-medium text-gray-700">Estado:</label>
                <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    <option value="">Todas</option>
                    <option value="activa">Activa</option>
                    <option value="inactiva">Inactiva</option>
                </select>
            </div>
            <button class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                <span class="material-icons text-sm mr-2">search</span>
                Filtrar
            </button>
        </div>
        <button class="px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors">
            <span class="material-icons text-sm mr-2">add</span>
            Agregar Especialidad
        </button>
    </div>

    <!-- Lista de especialidades -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Cardiología -->
        <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                        <span class="material-icons text-red-600">favorite</span>
                    </div>
                    <div>
                        <h3 class="font-medium text-gray-800">Cardiología</h3>
                        <p class="text-gray-600 text-sm">Enfermedades del corazón</p>
                    </div>
                </div>
                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Activa</span>
            </div>
            <div class="space-y-2 mb-4">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Doctores:</span>
                    <span class="font-medium text-gray-800">3</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Citas este mes:</span>
                    <span class="font-medium text-gray-800">45</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Precio consulta:</span>
                    <span class="font-medium text-gray-800">S/ 150.00</span>
                </div>
            </div>
            <div class="flex space-x-2">
                <button class="flex-1 px-3 py-2 bg-blue-600 text-white text-xs font-medium rounded hover:bg-blue-700 transition-colors">
                    <span class="material-icons text-xs mr-1">edit</span>
                    Editar
                </button>
                <button class="flex-1 px-3 py-2 bg-yellow-600 text-white text-xs font-medium rounded hover:bg-yellow-700 transition-colors">
                    <span class="material-icons text-xs mr-1">block</span>
                    Desactivar
                </button>
            </div>
        </div>

        <!-- Medicina General -->
        <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <span class="material-icons text-blue-600">medical_services</span>
                    </div>
                    <div>
                        <h3 class="font-medium text-gray-800">Medicina General</h3>
                        <p class="text-gray-600 text-sm">Atención primaria</p>
                    </div>
                </div>
                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Activa</span>
            </div>
            <div class="space-y-2 mb-4">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Doctores:</span>
                    <span class="font-medium text-gray-800">5</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Citas este mes:</span>
                    <span class="font-medium text-gray-800">78</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Precio consulta:</span>
                    <span class="font-medium text-gray-800">S/ 80.00</span>
                </div>
            </div>
            <div class="flex space-x-2">
                <button class="flex-1 px-3 py-2 bg-blue-600 text-white text-xs font-medium rounded hover:bg-blue-700 transition-colors">
                    <span class="material-icons text-xs mr-1">edit</span>
                    Editar
                </button>
                <button class="flex-1 px-3 py-2 bg-yellow-600 text-white text-xs font-medium rounded hover:bg-yellow-700 transition-colors">
                    <span class="material-icons text-xs mr-1">block</span>
                    Desactivar
                </button>
            </div>
        </div>

        <!-- Pediatría -->
        <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <span class="material-icons text-green-600">child_care</span>
                    </div>
                    <div>
                        <h3 class="font-medium text-gray-800">Pediatría</h3>
                        <p class="text-gray-600 text-sm">Atención infantil</p>
                    </div>
                </div>
                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Activa</span>
            </div>
            <div class="space-y-2 mb-4">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Doctores:</span>
                    <span class="font-medium text-gray-800">2</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Citas este mes:</span>
                    <span class="font-medium text-gray-800">32</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Precio consulta:</span>
                    <span class="font-medium text-gray-800">S/ 120.00</span>
                </div>
            </div>
            <div class="flex space-x-2">
                <button class="flex-1 px-3 py-2 bg-blue-600 text-white text-xs font-medium rounded hover:bg-blue-700 transition-colors">
                    <span class="material-icons text-xs mr-1">edit</span>
                    Editar
                </button>
                <button class="flex-1 px-3 py-2 bg-yellow-600 text-white text-xs font-medium rounded hover:bg-yellow-700 transition-colors">
                    <span class="material-icons text-xs mr-1">block</span>
                    Desactivar
                </button>
            </div>
        </div>

        <!-- Neurología -->
        <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                        <span class="material-icons text-purple-600">psychology</span>
                    </div>
                    <div>
                        <h3 class="font-medium text-gray-800">Neurología</h3>
                        <p class="text-gray-600 text-sm">Sistema nervioso</p>
                    </div>
                </div>
                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Activa</span>
            </div>
            <div class="space-y-2 mb-4">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Doctores:</span>
                    <span class="font-medium text-gray-800">1</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Citas este mes:</span>
                    <span class="font-medium text-gray-800">18</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Precio consulta:</span>
                    <span class="font-medium text-gray-800">S/ 200.00</span>
                </div>
            </div>
            <div class="flex space-x-2">
                <button class="flex-1 px-3 py-2 bg-blue-600 text-white text-xs font-medium rounded hover:bg-blue-700 transition-colors">
                    <span class="material-icons text-xs mr-1">edit</span>
                    Editar
                </button>
                <button class="flex-1 px-3 py-2 bg-yellow-600 text-white text-xs font-medium rounded hover:bg-yellow-700 transition-colors">
                    <span class="material-icons text-xs mr-1">block</span>
                    Desactivar
                </button>
            </div>
        </div>

        <!-- Dermatología -->
        <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center">
                        <span class="material-icons text-orange-600">healing</span>
                    </div>
                    <div>
                        <h3 class="font-medium text-gray-800">Dermatología</h3>
                        <p class="text-gray-600 text-sm">Enfermedades de la piel</p>
                    </div>
                </div>
                <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Inactiva</span>
            </div>
            <div class="space-y-2 mb-4">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Doctores:</span>
                    <span class="font-medium text-gray-800">0</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Citas este mes:</span>
                    <span class="font-medium text-gray-800">0</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Precio consulta:</span>
                    <span class="font-medium text-gray-800">S/ 180.00</span>
                </div>
            </div>
            <div class="flex space-x-2">
                <button class="flex-1 px-3 py-2 bg-blue-600 text-white text-xs font-medium rounded hover:bg-blue-700 transition-colors">
                    <span class="material-icons text-xs mr-1">edit</span>
                    Editar
                </button>
                <button class="flex-1 px-3 py-2 bg-green-600 text-white text-xs font-medium rounded hover:bg-green-700 transition-colors">
                    <span class="material-icons text-xs mr-1">check_circle</span>
                    Activar
                </button>
            </div>
        </div>

        <!-- Agregar nueva especialidad -->
        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 hover:border-gray-400 transition-colors">
            <div class="text-center">
                <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="material-icons text-gray-400">add</span>
                </div>
                <h3 class="font-medium text-gray-600 mb-2">Agregar Especialidad</h3>
                <p class="text-gray-500 text-sm mb-4">Crea una nueva especialidad médica</p>
                <button class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                    <span class="material-icons text-sm mr-2">add</span>
                    Nueva Especialidad
                </button>
            </div>
        </div>
    </div>

    <!-- Estadísticas -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-blue-50 rounded-lg p-4">
            <div class="flex items-center">
                <span class="material-icons text-blue-600 mr-3">medical_services</span>
                <div>
                    <p class="text-sm text-blue-600">Total Especialidades</p>
                    <p class="text-2xl font-bold text-blue-800">6</p>
                </div>
            </div>
        </div>
        <div class="bg-green-50 rounded-lg p-4">
            <div class="flex items-center">
                <span class="material-icons text-green-600 mr-3">check_circle</span>
                <div>
                    <p class="text-sm text-green-600">Activas</p>
                    <p class="text-2xl font-bold text-green-800">5</p>
                </div>
            </div>
        </div>
        <div class="bg-red-50 rounded-lg p-4">
            <div class="flex items-center">
                <span class="material-icons text-red-600 mr-3">block</span>
                <div>
                    <p class="text-sm text-red-600">Inactivas</p>
                    <p class="text-2xl font-bold text-red-800">1</p>
                </div>
            </div>
        </div>
        <div class="bg-purple-50 rounded-lg p-4">
            <div class="flex items-center">
                <span class="material-icons text-purple-600 mr-3">people</span>
                <div>
                    <p class="text-sm text-purple-600">Total Doctores</p>
                    <p class="text-2xl font-bold text-purple-800">11</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 