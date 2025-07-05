<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabla de doctores
     * Almacena la información específica de los doctores del sistema
     */
    public function up(): void
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('specialty_id')->constrained('specialties')->onDelete('restrict')->onUpdate('cascade');
            
            $table->string('license_code', 10)->unique()->index(); // Código de licencia médica
            $table->integer('experience_years')->default(0)->index(); // Años de experiencia
            $table->text('biography')->nullable(); // Biografía del doctor
            $table->decimal('consultation_fee', 8, 2)->default(0.00); // Tarifa de consulta
            $table->boolean('is_available')->default(true)->index(); // Disponibilidad del doctor
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
}; 