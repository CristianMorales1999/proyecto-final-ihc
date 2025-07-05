@extends('layouts.dashboard')

@section('title', 'HealthPlus - Panel del Paciente')

@section('content')
<div class="flex-1 p-6 lg:p-10 space-y-8">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
        <div>
            <h1 class="text-slate-800 text-3xl md:text-4xl font-bold">¡Bienvenido/a, {{ auth()->user()->full_name }}!</h1>
            <p class="text-slate-600 text-base mt-1">Este es tu panel de salud personalizado.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Próxima Cita -->
        <div class="bg-white p-6 rounded-xl shadow-md col-span-1 md:col-span-2 lg:col-span-1 flex flex-col justify-between min-h-[200px]">
            <div>
                <h3 class="text-slate-800 text-lg font-semibold mb-1">Próxima Cita</h3>
                @if($stats['upcoming_appointments'] > 0)
                    <p class="text-slate-800 text-xl font-bold">Tienes {{ $stats['upcoming_appointments'] }} cita(s) próximas</p>
                @else
                    <p class="text-slate-800 text-xl font-bold">No hay citas próximas</p>
                @endif
                <p class="text-slate-600 text-sm mt-2">Reserva tu próxima cita con un profesional de la salud.</p>
            </div>
            <div class="mt-auto pt-4">
                <a href="#" class="inline-block bg-blue-600 text-white text-sm font-medium py-2.5 px-5 rounded-lg hover:bg-blue-700 transition-colors">
                    Reservar Nueva Cita
                </a>
                <a href="#" class="block text-center md:text-left text-sm text-blue-600 hover:underline mt-3">
                    Ver todas mis citas
                </a>
            </div>
        </div>

        <!-- Accesos Directos -->
        <div class="bg-white p-6 rounded-xl shadow-md col-span-1 md:col-span-2 lg:col-span-1">
            <h3 class="text-slate-800 text-lg font-semibold mb-4">Accesos Directos</h3>
            <div class="space-y-3">
                <a href="#" class="block w-full bg-blue-600 text-white text-sm font-medium py-2.5 px-5 rounded-lg hover:bg-blue-700 transition-colors text-center">
                    Reservar Nueva Cita
                </a>
                <a href="#" class="block w-full bg-slate-200 text-slate-800 text-sm font-medium py-2.5 px-5 rounded-lg hover:bg-slate-300 transition-colors text-center">
                    Ver Historial Médico
                </a>
                <a href="{{ route('settings.profile') }}" class="block w-full bg-slate-200 text-slate-800 text-sm font-medium py-2.5 px-5 rounded-lg hover:bg-slate-300 transition-colors text-center">
                    Actualizar Perfil
                </a>
            </div>
        </div>

        <!-- Consejo de Salud del Día -->
        <div class="bg-white p-6 rounded-xl shadow-md col-span-1 md:col-span-2 lg:col-span-1 flex flex-col">
            <h3 class="text-slate-800 text-lg font-semibold mb-3">Consejo de Salud del Día</h3>
            <div class="flex items-center gap-3 mb-3">
                <div class="text-blue-600 bg-blue-50 p-2 rounded-full">
                    <span class="material-icons text-2xl">info</span>
                </div>
                <p class="text-slate-600 text-sm">¡Mantente hidratado/a! Beber suficiente agua durante el día es crucial para la salud y el bienestar general.</p>
            </div>
            <img alt="Estilo de vida saludable"
                 class="rounded-lg object-cover h-32 w-full mt-auto"
                 src="https://lh3.googleusercontent.com/aida-public/AB6AXuD37UMQ-SpyP5aVujSsoXnaAOxZ0GpLHru_YoC5uaai9fYPMGgJoExSoJtRI9TV_avjAL_NzZvmdZj8klJoIEtdEPvT1e66waTgaV_0d81mZlsN9VFiBmjsl7Gux4lA5e7SHWLbWbLyPkac4Ak7gm6AYyDNKZj9a_1qoHTsxxVo4BYce1-bReB7ljDsFI_RA_a2DKlLCvebAEzApJ6dPpgTNfhVl59sx0FF2geG_Jz7fKmI-Xz_Z_el0O9ozBS1bHD_CvkEzfvrIwu9" />
        </div>

        <!-- Notificaciones Recientes -->
        <div class="bg-white p-6 rounded-xl shadow-md col-span-1 md:col-span-2 lg:col-span-3">
            <h3 class="text-slate-800 text-lg font-semibold mb-4">Notificaciones Recientes</h3>
            <div class="space-y-4">
                <div class="flex items-start gap-4 p-3 rounded-lg hover:bg-slate-50 transition-colors">
                    <div class="text-blue-600 bg-blue-50 p-3 rounded-full mt-0.5">
                        <span class="material-icons text-xl">event</span>
                    </div>
                    <div>
                        <p class="text-slate-800 text-base font-medium">Confirmación de Cita</p>
                        <p class="text-slate-600 text-sm">Tu cita con el Dr. Ramírez ha sido confirmada para mañana a las 2 PM.</p>
                    </div>
                    <span class="text-xs text-slate-400 ml-auto whitespace-nowrap">Hace 2h</span>
                </div>
                <div class="flex items-start gap-4 p-3 rounded-lg hover:bg-slate-50 transition-colors">
                    <div class="text-blue-600 bg-blue-50 p-3 rounded-full mt-0.5">
                        <span class="material-icons text-xl">science</span>
                    </div>
                    <div>
                        <p class="text-slate-800 text-base font-medium">Resultados de Laboratorio Listos</p>
                        <p class="text-slate-600 text-sm">Tus resultados de laboratorio ya están disponibles para revisar en tu historial médico.</p>
                    </div>
                    <span class="text-xs text-slate-400 ml-auto whitespace-nowrap">Hace 1 día</span>
                </div>
            </div>
            <a href="#" class="inline-block text-sm text-blue-600 hover:underline mt-4 font-medium">
                Ver todas las notificaciones
            </a>
        </div>
    </div>
</div>
@endsection 