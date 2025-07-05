@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-8">
    <!-- Welcome Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
        <div>
            <h1 class="text-[#0d131c] text-3xl md:text-4xl font-bold">¡Bienvenido/a, {{ auth()->user()->full_name }}!</h1>
            <p class="text-[#49699c] text-base mt-1">Este es tu panel de control personalizado.</p>
        </div>
    </div>

    <!-- Dashboard Content based on Role -->
    @if(auth()->user()->role->name === 'admin')
        <!-- Admin Dashboard -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-xl shadow-md col-span-1 md:col-span-2 lg:col-span-1">
                <h3 class="text-[#0d131c] text-lg font-semibold mb-4">Resumen General</h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-[#49699c]">Total Pacientes</span>
                        <span class="text-[#0d131c] font-bold">1,234</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-[#49699c]">Total Médicos</span>
                        <span class="text-[#0d131c] font-bold">45</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-[#49699c]">Citas Hoy</span>
                        <span class="text-[#0d131c] font-bold">67</span>
                    </div>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h3 class="text-[#0d131c] text-lg font-semibold mb-4">Acciones Rápidas</h3>
                <div class="space-y-3">
                    <button class="w-full text-left p-3 rounded-lg bg-[#e6f0ff] text-[#0c64f2] hover:bg-[#dbe8ff] transition-colors">
                        <span class="material-icons text-lg mr-2">group</span>
                        Gestionar Personal
                    </button>
                    <button class="w-full text-left p-3 rounded-lg bg-[#e6f0ff] text-[#0c64f2] hover:bg-[#dbe8ff] transition-colors">
                        <span class="material-icons text-lg mr-2">schedule</span>
                        Configurar Horarios
                    </button>
                    <button class="w-full text-left p-3 rounded-lg bg-[#e6f0ff] text-[#0c64f2] hover:bg-[#dbe8ff] transition-colors">
                        <span class="material-icons text-lg mr-2">medical_services</span>
                        Gestionar Especialidades
                    </button>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h3 class="text-[#0d131c] text-lg font-semibold mb-4">Notificaciones Recientes</h3>
                <div class="space-y-3">
                    <div class="p-3 rounded-lg bg-[#f8f9fc]">
                        <p class="text-[#0d131c] text-sm font-medium">Nuevo médico registrado</p>
                        <p class="text-[#49699c] text-xs">Hace 2 horas</p>
                    </div>
                    <div class="p-3 rounded-lg bg-[#f8f9fc]">
                        <p class="text-[#0d131c] text-sm font-medium">Cita cancelada</p>
                        <p class="text-[#49699c] text-xs">Hace 1 día</p>
                    </div>
                </div>
            </div>
        </div>
    @elseif(auth()->user()->role->name === 'doctor')
        <!-- Doctor Dashboard -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-xl shadow-md col-span-1 md:col-span-2 lg:col-span-1">
                <h3 class="text-[#0d131c] text-lg font-semibold mb-4">Mi Agenda Hoy</h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-[#49699c]">Citas Programadas</span>
                        <span class="text-[#0d131c] font-bold">8</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-[#49699c]">Citas Completadas</span>
                        <span class="text-[#0d131c] font-bold">5</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-[#49699c]">Pendientes</span>
                        <span class="text-[#0d131c] font-bold">3</span>
                    </div>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h3 class="text-[#0d131c] text-lg font-semibold mb-4">Próxima Cita</h3>
                <div class="space-y-3">
                    <p class="text-[#0d131c] font-medium">Paciente: María González</p>
                    <p class="text-[#49699c] text-sm">Hora: 14:30</p>
                    <p class="text-[#49699c] text-sm">Especialidad: Cardiología</p>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h3 class="text-[#0d131c] text-lg font-semibold mb-4">Acciones Rápidas</h3>
                <div class="space-y-3">
                    <button class="w-full text-left p-3 rounded-lg bg-[#e6f0ff] text-[#0c64f2] hover:bg-[#dbe8ff] transition-colors">
                        <span class="material-icons text-lg mr-2">calendar_month</span>
                        Ver Mi Agenda
                    </button>
                    <button class="w-full text-left p-3 rounded-lg bg-[#e6f0ff] text-[#0c64f2] hover:bg-[#dbe8ff] transition-colors">
                        <span class="material-icons text-lg mr-2">person</span>
                        Actualizar Perfil
                    </button>
                </div>
            </div>
        </div>
    @elseif(auth()->user()->role->name === 'secretaria')
        <!-- Secretaria Dashboard -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-xl shadow-md col-span-1 md:col-span-2 lg:col-span-1">
                <h3 class="text-[#0d131c] text-lg font-semibold mb-4">Resumen del Día</h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-[#49699c]">Citas Confirmadas</span>
                        <span class="text-[#0d131c] font-bold">23</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-[#49699c]">Pagos Pendientes</span>
                        <span class="text-[#0d131c] font-bold">5</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-[#49699c]">Citas Canceladas</span>
                        <span class="text-[#0d131c] font-bold">2</span>
                    </div>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h3 class="text-[#0d131c] text-lg font-semibold mb-4">Acciones Rápidas</h3>
                <div class="space-y-3">
                    <button class="w-full text-left p-3 rounded-lg bg-[#e6f0ff] text-[#0c64f2] hover:bg-[#dbe8ff] transition-colors">
                        <span class="material-icons text-lg mr-2">payments</span>
                        Validar Pagos
                    </button>
                    <button class="w-full text-left p-3 rounded-lg bg-[#e6f0ff] text-[#0c64f2] hover:bg-[#dbe8ff] transition-colors">
                        <span class="material-icons text-lg mr-2">assessment</span>
                        Generar Reportes
                    </button>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h3 class="text-[#0d131c] text-lg font-semibold mb-4">Notificaciones</h3>
                <div class="space-y-3">
                    <div class="p-3 rounded-lg bg-[#f8f9fc]">
                        <p class="text-[#0d131c] text-sm font-medium">Nuevo pago recibido</p>
                        <p class="text-[#49699c] text-xs">Hace 1 hora</p>
                    </div>
                    <div class="p-3 rounded-lg bg-[#f8f9fc]">
                        <p class="text-[#0d131c] text-sm font-medium">Cita reprogramada</p>
                        <p class="text-[#49699c] text-xs">Hace 3 horas</p>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Paciente Dashboard -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-xl shadow-md col-span-1 md:col-span-2 lg:col-span-1 flex flex-col justify-between min-h-[200px]">
                <div>
                    <h3 class="text-[#0d131c] text-lg font-semibold mb-1">Próxima Cita</h3>
                    <p class="text-[#0d131c] text-xl font-bold">No hay citas próximas</p>
                    <p class="text-[#49699c] text-sm mt-2">Reserva tu próxima cita con un profesional de la salud.</p>
                </div>
                <div class="mt-auto pt-4">
                    <button class="w-full md:w-auto text-sm font-medium py-2.5 px-5 rounded-lg bg-[#0c64f2] text-white hover:opacity-90 transition-opacity">
                        <span class="material-icons text-lg mr-2">add</span>
                        Reservar Nueva Cita
                    </button>
                    <a class="block text-center md:text-left text-sm text-[#0c64f2] hover:underline mt-3" href="#">
                        Ver todas mis citas
                    </a>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-xl shadow-md col-span-1 md:col-span-2 lg:col-span-1">
                <h3 class="text-[#0d131c] text-lg font-semibold mb-4">Accesos Directos</h3>
                <div class="space-y-3">
                    <button class="w-full text-sm font-medium py-2.5 px-5 rounded-lg bg-[#0c64f2] text-white hover:opacity-90 transition-opacity">
                        <span class="material-icons text-lg mr-2">add</span>
                        Reservar Nueva Cita
                    </button>
                    <button class="w-full text-sm font-medium py-2.5 px-5 rounded-lg bg-[#e7ecf4] text-[#0d131c] hover:bg-gray-200 transition-colors">
                        <span class="material-icons text-lg mr-2">medical_information</span>
                        Ver Historial Médico
                    </button>
                    <button class="w-full text-sm font-medium py-2.5 px-5 rounded-lg bg-[#e7ecf4] text-[#0d131c] hover:bg-gray-200 transition-colors">
                        <span class="material-icons text-lg mr-2">person</span>
                        Actualizar Perfil
                    </button>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-xl shadow-md col-span-1 md:col-span-2 lg:col-span-1 flex flex-col">
                <h3 class="text-[#0d131c] text-lg font-semibold mb-3">Consejo de Salud del Día</h3>
                <div class="flex items-center gap-3 mb-3">
                    <div class="text-[#0c64f2] bg-[#e6f0ff] p-2 rounded-full">
                        <span class="material-icons text-2xl">info</span>
                    </div>
                    <p class="text-[#49699c] text-sm">¡Mantente hidratado/a! Beber suficiente agua durante el día es crucial para la salud y el bienestar general.</p>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
