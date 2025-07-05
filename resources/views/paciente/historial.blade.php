@extends('layouts.dashboard')

@section('title', 'Historial Médico')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-2">Historial Médico</h2>
        <p class="text-gray-600">Tu historial médico completo con todas las consultas, diagnósticos y tratamientos.</p>
    </div>

    <div class="space-y-6">
        <!-- Información General -->
        <div class="bg-gray-50 rounded-lg p-4">
            <h3 class="font-medium text-gray-800 mb-3">Información General</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div>
                    <span class="text-gray-600">Grupo Sanguíneo:</span>
                    <span class="font-medium text-gray-800 ml-2">O+</span>
                </div>
                <div>
                    <span class="text-gray-600">Alergias:</span>
                    <span class="font-medium text-gray-800 ml-2">Penicilina</span>
                </div>
                <div>
                    <span class="text-gray-600">Enfermedades Crónicas:</span>
                    <span class="font-medium text-gray-800 ml-2">Ninguna</span>
                </div>
                <div>
                    <span class="text-gray-600">Medicamentos Actuales:</span>
                    <span class="font-medium text-gray-800 ml-2">Vitamina D</span>
                </div>
            </div>
        </div>

        <!-- Consultas Recientes -->
        <div>
            <h3 class="font-medium text-gray-800 mb-4">Consultas Recientes</h3>
            <div class="space-y-4">
                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex items-start justify-between mb-3">
                        <div>
                            <h4 class="font-medium text-gray-800">Consulta General</h4>
                            <p class="text-gray-600 text-sm">Dr. Ana Martínez - Medicina General</p>
                            <p class="text-gray-500 text-sm">15 de Diciembre, 2024</p>
                        </div>
                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Completada</span>
                    </div>
                    <div class="text-sm">
                        <p class="text-gray-700 mb-2"><strong>Motivo:</strong> Revisión anual</p>
                        <p class="text-gray-700 mb-2"><strong>Diagnóstico:</strong> Estado de salud general bueno</p>
                        <p class="text-gray-700"><strong>Tratamiento:</strong> Continuar con vitaminas y ejercicio regular</p>
                    </div>
                </div>

                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex items-start justify-between mb-3">
                        <div>
                            <h4 class="font-medium text-gray-800">Consulta Cardiológica</h4>
                            <p class="text-gray-600 text-sm">Dr. Carlos Ramírez - Cardiología</p>
                            <p class="text-gray-500 text-sm">10 de Noviembre, 2024</p>
                        </div>
                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Completada</span>
                    </div>
                    <div class="text-sm">
                        <p class="text-gray-700 mb-2"><strong>Motivo:</strong> Dolor en el pecho</p>
                        <p class="text-gray-700 mb-2"><strong>Diagnóstico:</strong> Ansiedad, no problemas cardíacos</p>
                        <p class="text-gray-700"><strong>Tratamiento:</strong> Ejercicios de respiración y control del estrés</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Resultados de Laboratorio -->
        <div>
            <h3 class="font-medium text-gray-800 mb-4">Resultados de Laboratorio</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                    <div>
                        <h4 class="font-medium text-blue-900">Análisis de Sangre</h4>
                        <p class="text-blue-700 text-sm">15 de Diciembre, 2024</p>
                    </div>
                    <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Ver Resultados</a>
                </div>
                <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                    <div>
                        <h4 class="font-medium text-green-900">Radiografía de Tórax</h4>
                        <p class="text-green-700 text-sm">10 de Noviembre, 2024</p>
                    </div>
                    <a href="#" class="text-green-600 hover:text-green-800 text-sm font-medium">Ver Resultados</a>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6">
        <button class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
            <span class="material-icons text-sm mr-2">download</span>
            Descargar Historial Completo
        </button>
    </div>
</div>
@endsection 