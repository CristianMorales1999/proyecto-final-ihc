@extends('layouts.dashboard')

@section('title', 'Gestión de Horarios')

@section('page-title', 'Gestión de Horarios')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-2">Gestión de Horarios de Atención</h2>
        <p class="text-gray-600">Configura y administra los horarios de atención de los médicos.</p>
    </div>

    <!-- Controles superiores -->
    <div class="mb-6 flex flex-wrap gap-4 items-center justify-between">
        <div class="flex flex-wrap gap-4 items-center">
            <div class="flex items-center space-x-2">
                <label class="text-sm font-medium text-gray-700">Doctor:</label>
                <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    <option value="">Todos los doctores</option>
                    <option value="1">Dr. Carlos Ramírez</option>
                    <option value="2">Dra. Ana Martínez</option>
                    <option value="3">Dr. Luis García</option>
                </select>
            </div>
            <div class="flex items-center space-x-2">
                <label class="text-sm font-medium text-gray-700">Especialidad:</label>
                <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    <option value="">Todas</option>
                    <option value="cardiologia">Cardiología</option>
                    <option value="medicina_general">Medicina General</option>
                    <option value="pediatria">Pediatría</option>
                </select>
            </div>
            <button class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                <span class="material-icons text-sm mr-2">search</span>
                Filtrar
            </button>
        </div>
        <button class="px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors">
            <span class="material-icons text-sm mr-2">add</span>
            Agregar Horario
        </button>
    </div>

    <!-- Horarios -->
    <div class="space-y-6">
        <!-- Doctor 1 -->
        <div class="border border-gray-200 rounded-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                        <span class="material-icons text-blue-600 text-sm">medical_services</span>
                    </div>
                    <div>
                        <h3 class="font-medium text-gray-800">Dr. Carlos Ramírez</h3>
                        <p class="text-gray-600 text-sm">Cardiología</p>
                    </div>
                </div>
                <div class="flex space-x-2">
                    <button class="text-blue-600 hover:text-blue-800" title="Editar">
                        <span class="material-icons text-sm">edit</span>
                    </button>
                    <button class="text-red-600 hover:text-red-800" title="Eliminar">
                        <span class="material-icons text-sm">delete</span>
                    </button>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                    <h4 class="font-medium text-green-800 text-sm mb-2">Lunes</h4>
                    <p class="text-green-700 text-xs">08:00 - 12:00</p>
                    <p class="text-green-700 text-xs">14:00 - 18:00</p>
                </div>
                <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                    <h4 class="font-medium text-green-800 text-sm mb-2">Martes</h4>
                    <p class="text-green-700 text-xs">08:00 - 12:00</p>
                    <p class="text-green-700 text-xs">14:00 - 18:00</p>
                </div>
                <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                    <h4 class="font-medium text-green-800 text-sm mb-2">Miércoles</h4>
                    <p class="text-green-700 text-xs">08:00 - 12:00</p>
                    <p class="text-green-700 text-xs">14:00 - 18:00</p>
                </div>
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-3">
                    <h4 class="font-medium text-gray-600 text-sm mb-2">Jueves</h4>
                    <p class="text-gray-500 text-xs">No disponible</p>
                </div>
            </div>
        </div>

        <!-- Doctor 2 -->
        <div class="border border-gray-200 rounded-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                        <span class="material-icons text-blue-600 text-sm">medical_services</span>
                    </div>
                    <div>
                        <h3 class="font-medium text-gray-800">Dra. Ana Martínez</h3>
                        <p class="text-gray-600 text-sm">Medicina General</p>
                    </div>
                </div>
                <div class="flex space-x-2">
                    <button class="text-blue-600 hover:text-blue-800" title="Editar">
                        <span class="material-icons text-sm">edit</span>
                    </button>
                    <button class="text-red-600 hover:text-red-800" title="Eliminar">
                        <span class="material-icons text-sm">delete</span>
                    </button>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                    <h4 class="font-medium text-green-800 text-sm mb-2">Lunes</h4>
                    <p class="text-green-700 text-xs">09:00 - 13:00</p>
                    <p class="text-green-700 text-xs">15:00 - 19:00</p>
                </div>
                <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                    <h4 class="font-medium text-green-800 text-sm mb-2">Martes</h4>
                    <p class="text-green-700 text-xs">09:00 - 13:00</p>
                    <p class="text-green-700 text-xs">15:00 - 19:00</p>
                </div>
                <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                    <h4 class="font-medium text-green-800 text-sm mb-2">Miércoles</h4>
                    <p class="text-green-700 text-xs">09:00 - 13:00</p>
                    <p class="text-green-700 text-xs">15:00 - 19:00</p>
                </div>
                <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                    <h4 class="font-medium text-green-800 text-sm mb-2">Jueves</h4>
                    <p class="text-green-700 text-xs">09:00 - 13:00</p>
                    <p class="text-green-700 text-xs">15:00 - 19:00</p>
                </div>
            </div>
        </div>

        <!-- Doctor 3 -->
        <div class="border border-gray-200 rounded-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                        <span class="material-icons text-blue-600 text-sm">medical_services</span>
                    </div>
                    <div>
                        <h3 class="font-medium text-gray-800">Dr. Luis García</h3>
                        <p class="text-gray-600 text-sm">Pediatría</p>
                    </div>
                </div>
                <div class="flex space-x-2">
                    <button class="text-blue-600 hover:text-blue-800" title="Editar">
                        <span class="material-icons text-sm">edit</span>
                    </button>
                    <button class="text-red-600 hover:text-red-800" title="Eliminar">
                        <span class="material-icons text-sm">delete</span>
                    </button>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                    <h4 class="font-medium text-green-800 text-sm mb-2">Lunes</h4>
                    <p class="text-green-700 text-xs">10:00 - 14:00</p>
                    <p class="text-green-700 text-xs">16:00 - 20:00</p>
                </div>
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-3">
                    <h4 class="font-medium text-gray-600 text-sm mb-2">Martes</h4>
                    <p class="text-gray-500 text-xs">No disponible</p>
                </div>
                <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                    <h4 class="font-medium text-green-800 text-sm mb-2">Miércoles</h4>
                    <p class="text-green-700 text-xs">10:00 - 14:00</p>
                    <p class="text-green-700 text-xs">16:00 - 20:00</p>
                </div>
                <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                    <h4 class="font-medium text-green-800 text-sm mb-2">Jueves</h4>
                    <p class="text-green-700 text-xs">10:00 - 14:00</p>
                    <p class="text-green-700 text-xs">16:00 - 20:00</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Configuración general -->
    <div class="mt-8 border-t border-gray-200 pt-6">
        <h3 class="text-lg font-medium text-gray-800 mb-4">Configuración General de Horarios</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Duración de Cita (minutos)</label>
                    <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm w-full">
                        <option>15</option>
                        <option selected>30</option>
                        <option>45</option>
                        <option>60</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Intervalo entre Citas (minutos)</label>
                    <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm w-full">
                        <option>0</option>
                        <option selected>5</option>
                        <option>10</option>
                        <option>15</option>
                    </select>
                </div>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Horario de Atención General</label>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="text-xs text-gray-600">Inicio</label>
                            <input type="time" value="08:00" class="border border-gray-300 rounded-lg px-3 py-2 text-sm w-full">
                        </div>
                        <div>
                            <label class="text-xs text-gray-600">Fin</label>
                            <input type="time" value="18:00" class="border border-gray-300 rounded-lg px-3 py-2 text-sm w-full">
                        </div>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Días de Atención</label>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" checked class="rounded border-gray-300 text-blue-600">
                            <span class="ml-2 text-sm text-gray-700">Lunes a Viernes</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-gray-300 text-blue-600">
                            <span class="ml-2 text-sm text-gray-700">Sábados</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-gray-300 text-blue-600">
                            <span class="ml-2 text-sm text-gray-700">Domingos</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-6">
            <button class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                <span class="material-icons text-sm mr-2">save</span>
                Guardar Configuración
            </button>
        </div>
    </div>
</div>
@endsection 