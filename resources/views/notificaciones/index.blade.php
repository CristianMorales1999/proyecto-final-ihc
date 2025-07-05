@extends('layouts.dashboard')

@section('title', 'Notificaciones')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-2">Notificaciones</h2>
        <p class="text-gray-600">Gestiona todas tus notificaciones del sistema.</p>
    </div>

    <!-- Filtros -->
    <div class="mb-6 flex flex-wrap gap-4 items-center">
        <div class="flex items-center space-x-2">
            <label class="text-sm font-medium text-gray-700">Tipo:</label>
            <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
                <option value="">Todas</option>
                <option value="cita">Citas</option>
                <option value="pago">Pagos</option>
                <option value="sistema">Sistema</option>
                <option value="recordatorio">Recordatorios</option>
            </select>
        </div>
        <div class="flex items-center space-x-2">
            <label class="text-sm font-medium text-gray-700">Estado:</label>
            <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
                <option value="">Todas</option>
                <option value="no_leida">No leídas</option>
                <option value="leida">Leídas</option>
            </select>
        </div>
        <button class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
            <span class="material-icons text-sm mr-2">filter_list</span>
            Filtrar
        </button>
        <button class="px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-700 transition-colors">
            <span class="material-icons text-sm mr-2">mark_email_read</span>
            Marcar todas como leídas
        </button>
    </div>

    <!-- Lista de notificaciones -->
    <div class="space-y-4">
        <!-- Notificación no leída -->
        <div class="border border-blue-200 bg-blue-50 rounded-lg p-4">
            <div class="flex items-start justify-between">
                <div class="flex items-start space-x-3">
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <span class="material-icons text-blue-600 text-sm">event</span>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center space-x-2 mb-1">
                            <h4 class="font-medium text-blue-900">Confirmación de Cita</h4>
                            <span class="bg-blue-200 text-blue-800 text-xs font-medium px-2 py-0.5 rounded-full">Cita</span>
                            <span class="bg-red-100 text-red-800 text-xs font-medium px-2 py-0.5 rounded-full">No leída</span>
                        </div>
                        <p class="text-blue-800 text-sm mb-2">Tu cita con el Dr. Carlos Ramírez ha sido confirmada para mañana a las 14:00.</p>
                        <div class="flex items-center space-x-4 text-xs text-blue-600">
                            <span>Hace 2 horas</span>
                            <button class="hover:text-blue-800">Marcar como leída</button>
                            <button class="hover:text-blue-800">Ver detalles</button>
                        </div>
                    </div>
                </div>
                <button class="text-blue-600 hover:text-blue-800">
                    <span class="material-icons text-sm">more_vert</span>
                </button>
            </div>
        </div>

        <!-- Notificación de pago -->
        <div class="border border-green-200 bg-green-50 rounded-lg p-4">
            <div class="flex items-start justify-between">
                <div class="flex items-start space-x-3">
                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <span class="material-icons text-green-600 text-sm">payments</span>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center space-x-2 mb-1">
                            <h4 class="font-medium text-green-900">Pago Confirmado</h4>
                            <span class="bg-green-200 text-green-800 text-xs font-medium px-2 py-0.5 rounded-full">Pago</span>
                            <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2 py-0.5 rounded-full">Leída</span>
                        </div>
                        <p class="text-green-800 text-sm mb-2">Tu pago de S/ 150.00 por la consulta de cardiología ha sido confirmado exitosamente.</p>
                        <div class="flex items-center space-x-4 text-xs text-green-600">
                            <span>Hace 1 día</span>
                            <button class="hover:text-green-800">Ver recibo</button>
                        </div>
                    </div>
                </div>
                <button class="text-green-600 hover:text-green-800">
                    <span class="material-icons text-sm">more_vert</span>
                </button>
            </div>
        </div>

        <!-- Notificación de recordatorio -->
        <div class="border border-yellow-200 bg-yellow-50 rounded-lg p-4">
            <div class="flex items-start justify-between">
                <div class="flex items-start space-x-3">
                    <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <span class="material-icons text-yellow-600 text-sm">schedule</span>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center space-x-2 mb-1">
                            <h4 class="font-medium text-yellow-900">Recordatorio de Cita</h4>
                            <span class="bg-yellow-200 text-yellow-800 text-xs font-medium px-2 py-0.5 rounded-full">Recordatorio</span>
                            <span class="bg-red-100 text-red-800 text-xs font-medium px-2 py-0.5 rounded-full">No leída</span>
                        </div>
                        <p class="text-yellow-800 text-sm mb-2">Recuerda que tienes una cita mañana a las 10:30 con la Dra. Ana Martínez.</p>
                        <div class="flex items-center space-x-4 text-xs text-yellow-600">
                            <span>Hace 3 horas</span>
                            <button class="hover:text-yellow-800">Marcar como leída</button>
                            <button class="hover:text-yellow-800">Ver cita</button>
                        </div>
                    </div>
                </div>
                <button class="text-yellow-600 hover:text-yellow-800">
                    <span class="material-icons text-sm">more_vert</span>
                </button>
            </div>
        </div>

        <!-- Notificación del sistema -->
        <div class="border border-gray-200 bg-gray-50 rounded-lg p-4">
            <div class="flex items-start justify-between">
                <div class="flex items-start space-x-3">
                    <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <span class="material-icons text-gray-600 text-sm">info</span>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center space-x-2 mb-1">
                            <h4 class="font-medium text-gray-900">Mantenimiento Programado</h4>
                            <span class="bg-gray-200 text-gray-800 text-xs font-medium px-2 py-0.5 rounded-full">Sistema</span>
                            <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2 py-0.5 rounded-full">Leída</span>
                        </div>
                        <p class="text-gray-800 text-sm mb-2">El sistema estará en mantenimiento el próximo domingo de 02:00 a 06:00.</p>
                        <div class="flex items-center space-x-4 text-xs text-gray-600">
                            <span>Hace 2 días</span>
                            <button class="hover:text-gray-800">Ver detalles</button>
                        </div>
                    </div>
                </div>
                <button class="text-gray-600 hover:text-gray-800">
                    <span class="material-icons text-sm">more_vert</span>
                </button>
            </div>
        </div>

        <!-- Notificación de resultados -->
        <div class="border border-purple-200 bg-purple-50 rounded-lg p-4">
            <div class="flex items-start justify-between">
                <div class="flex items-start space-x-3">
                    <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <span class="material-icons text-purple-600 text-sm">science</span>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center space-x-2 mb-1">
                            <h4 class="font-medium text-purple-900">Resultados de Laboratorio</h4>
                            <span class="bg-purple-200 text-purple-800 text-xs font-medium px-2 py-0.5 rounded-full">Resultados</span>
                            <span class="bg-red-100 text-red-800 text-xs font-medium px-2 py-0.5 rounded-full">No leída</span>
                        </div>
                        <p class="text-purple-800 text-sm mb-2">Tus resultados de laboratorio ya están disponibles para revisar en tu historial médico.</p>
                        <div class="flex items-center space-x-4 text-xs text-purple-600">
                            <span>Hace 1 día</span>
                            <button class="hover:text-purple-800">Marcar como leída</button>
                            <button class="hover:text-purple-800">Ver resultados</button>
                        </div>
                    </div>
                </div>
                <button class="text-purple-600 hover:text-purple-800">
                    <span class="material-icons text-sm">more_vert</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Paginación -->
    <div class="mt-8 flex items-center justify-between">
        <div class="text-sm text-gray-600">
            Mostrando 1-5 de 12 notificaciones
        </div>
        <div class="flex items-center space-x-2">
            <button class="px-3 py-1 border border-gray-300 rounded text-sm text-gray-600 hover:bg-gray-50">
                Anterior
            </button>
            <button class="px-3 py-1 bg-blue-600 text-white rounded text-sm">1</button>
            <button class="px-3 py-1 border border-gray-300 rounded text-sm text-gray-600 hover:bg-gray-50">2</button>
            <button class="px-3 py-1 border border-gray-300 rounded text-sm text-gray-600 hover:bg-gray-50">3</button>
            <button class="px-3 py-1 border border-gray-300 rounded text-sm text-gray-600 hover:bg-gray-50">
                Siguiente
            </button>
        </div>
    </div>

    <!-- Configuración de notificaciones -->
    <div class="mt-8 border-t border-gray-200 pt-6">
        <h3 class="text-lg font-medium text-gray-800 mb-4">Configuración de Notificaciones</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <h4 class="font-medium text-gray-700">Tipos de Notificación</h4>
                <div class="space-y-3">
                    <label class="flex items-center">
                        <input type="checkbox" checked class="rounded border-gray-300 text-blue-600">
                        <span class="ml-2 text-sm text-gray-700">Citas y recordatorios</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" checked class="rounded border-gray-300 text-blue-600">
                        <span class="ml-2 text-sm text-gray-700">Confirmaciones de pago</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" checked class="rounded border-gray-300 text-blue-600">
                        <span class="ml-2 text-sm text-gray-700">Resultados de laboratorio</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded border-gray-300 text-blue-600">
                        <span class="ml-2 text-sm text-gray-700">Notificaciones del sistema</span>
                    </label>
                </div>
            </div>
            <div class="space-y-4">
                <h4 class="font-medium text-gray-700">Métodos de Notificación</h4>
                <div class="space-y-3">
                    <label class="flex items-center">
                        <input type="checkbox" checked class="rounded border-gray-300 text-blue-600">
                        <span class="ml-2 text-sm text-gray-700">Notificaciones en la aplicación</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded border-gray-300 text-blue-600">
                        <span class="ml-2 text-sm text-gray-700">Correo electrónico</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded border-gray-300 text-blue-600">
                        <span class="ml-2 text-sm text-gray-700">SMS</span>
                    </label>
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