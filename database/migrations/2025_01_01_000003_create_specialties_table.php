<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabla de especialidades médicas
     * Almacena las diferentes especialidades que pueden tener los doctores
     */
    public function up(): void
    {
        Schema::create('specialties', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique()->index(); // Nombre de la especialidad
            $table->text('description')->nullable(); // Descripción de la especialidad
            $table->boolean('is_active')->default(true)->index(); // Para desactivar especialidades sin eliminarlas
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('specialties');
    }
}; 