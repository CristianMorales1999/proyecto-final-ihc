<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabla de citas médicas
     * Almacena todas las citas programadas entre pacientes y doctores
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('schedule_id')->constrained('schedules')->onDelete('restrict')->onUpdate('cascade');
            
            $table->date('appointment_date')->index(); // Fecha de la cita
            $table->time('appointment_time')->index(); // Hora de la cita
            $table->enum('status', ['programada', 'confirmada', 'en_progreso', 'completada', 'cancelada', 'no_se_presento'])->default('programada')->index(); // Estado de la cita
            $table->text('reason')->nullable(); // Motivo de la consulta
            $table->text('notes')->nullable(); // Notas adicionales
            $table->decimal('fee', 8, 2)->nullable(); // Tarifa de la consulta
            $table->timestamp('confirmed_at')->nullable(); // Fecha de confirmación
            $table->timestamp('completed_at')->nullable(); // Fecha de finalización
            $table->timestamps();
            $table->softDeletes();
            
            // Índices compuestos para consultas eficientes
            $table->index(['doctor_id', 'appointment_date', 'status']);
            $table->index(['patient_id', 'appointment_date']);
            
            // Índice único para evitar citas duplicadas
            $table->unique(['doctor_id', 'appointment_date', 'appointment_time'], 'appointment_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
}; 