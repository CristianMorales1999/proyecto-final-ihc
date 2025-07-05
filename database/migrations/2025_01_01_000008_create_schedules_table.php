<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabla de horarios de doctores
     * Almacena los horarios de atención de cada doctor
     */
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade')->onUpdate('cascade');
            
            $table->enum('day_of_week', ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'])->index(); // Día de la semana
            $table->time('start_time')->index(); // Hora de inicio
            $table->time('end_time')->index(); // Hora de fin
            $table->integer('appointment_duration')->default(30); // Duración de cada cita en minutos
            $table->integer('max_appointments')->nullable(); // Máximo número de citas por día
            $table->boolean('is_active')->default(true)->index(); // Estado activo/inactivo
            $table->timestamps();
            $table->softDeletes();
            
            // Índice compuesto para evitar horarios duplicados
            $table->unique(['doctor_id', 'day_of_week'], 'doctor_schedule_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
}; 