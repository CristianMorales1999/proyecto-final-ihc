@extends('layouts.dashboard')

@section('title', 'Reservar Cita')

@section('page-title', 'Reservar Cita')

@section('content')
<div class="space-y-6">
    <div class="bg-white p-6 rounded-xl shadow-md">
        <h2 class="text-[#0d131c] text-xl font-semibold mb-4">Agendar Nueva Cita</h2>
        <p class="text-[#49699c] mb-6">Selecciona la especialidad y el médico para tu cita médica.</p>
        
        <!-- Contenido temporal -->
        <div class="text-center py-12">
            <div class="text-[#0c64f2] mb-4">
                <svg fill="currentColor" height="64" viewBox="0 0 256 256" width="64" xmlns="http://www.w3.org/2000/svg">
                    <path d="M224,128a8,8,0,0,1-8,8H136v80a8,8,0,0,1-16,0V136H40a8,8,0,0,1,0-16h80V40a8,8,0,0,1,16,0v80h80A8,8,0,0,1,224,128Z"></path>
                </svg>
            </div>
            <h3 class="text-[#0d131c] text-lg font-semibold mb-2">Funcionalidad en Desarrollo</h3>
            <p class="text-[#49699c]">El sistema de agendamiento de citas estará disponible próximamente.</p>
        </div>
    </div>
</div>
@endsection 