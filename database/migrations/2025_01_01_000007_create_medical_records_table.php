<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabla de historiales médicos
     * Almacena el historial médico principal de cada paciente
     */
    public function up(): void
    {
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade')->onUpdate('cascade');
            
            $table->string('record_number')->unique()->index(); // Número de historial médico
            $table->text('general_notes')->nullable(); // Notas generales del historial
            $table->boolean('is_active')->default(true)->index(); // Estado activo/inactivo
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
}; 