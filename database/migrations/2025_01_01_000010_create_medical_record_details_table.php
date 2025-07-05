<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabla de detalles del historial médico
     * Almacena los detalles específicos de cada consulta médica
     */
    public function up(): void
    {
        Schema::create('medical_record_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medical_record_id')->constrained('medical_records')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('appointment_id')->constrained('appointments')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('doctor_id')->constrained('doctors')->onDelete('restrict')->onUpdate('cascade');
            
            $table->text('symptoms')->nullable(); // Síntomas reportados
            $table->text('diagnosis')->nullable(); // Diagnóstico
            $table->text('treatment')->nullable(); // Tratamiento prescrito
            $table->text('prescription')->nullable(); // Receta médica
            $table->text('notes')->nullable(); // Notas adicionales del doctor
            $table->json('vital_signs')->nullable(); // Signos vitales (JSON)
            $table->decimal('weight', 5, 2)->nullable(); // Peso en kg
            $table->decimal('height', 5, 2)->nullable(); // Altura en cm
            $table->integer('blood_pressure_systolic')->nullable(); // Presión sistólica
            $table->integer('blood_pressure_diastolic')->nullable(); // Presión diastólica
            $table->integer('heart_rate')->nullable(); // Frecuencia cardíaca
            $table->decimal('temperature', 4, 1)->nullable(); // Temperatura
            $table->timestamps();
            $table->softDeletes();
            
            // Índices para consultas eficientes
            $table->index(['medical_record_id', 'created_at']);
            $table->index(['appointment_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medical_record_details');
    }
}; 