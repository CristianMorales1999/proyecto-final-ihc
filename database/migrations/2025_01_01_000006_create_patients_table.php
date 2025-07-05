<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabla de pacientes
     * Almacena la información médica específica de los pacientes
     */
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            
            $table->enum('blood_type', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])->nullable()->index(); // Tipo de sangre
            $table->text('allergies')->nullable(); // Alergias del paciente
            $table->text('medical_conditions')->nullable(); // Condiciones médicas preexistentes
            $table->text('medications')->nullable(); // Medicamentos que toma regularmente
            $table->text('family_history')->nullable(); // Historial médico familiar
            $table->text('emergency_contact')->nullable(); // Contacto de emergencia
            $table->boolean('is_active')->default(true)->index(); // Estado activo/inactivo
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
}; 