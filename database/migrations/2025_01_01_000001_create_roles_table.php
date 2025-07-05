<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabla de roles del sistema
     * Almacena los diferentes roles que pueden tener los usuarios (admin, doctor, secretaria, paciente)
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->index(); // Índice para búsquedas rápidas por nombre
            $table->string('description')->nullable(); // Descripción del rol
            $table->boolean('is_active')->default(true)->index(); // Para desactivar roles sin eliminarlos
            $table->timestamps();
            $table->softDeletes(); // Soft deletes para mantener integridad referencial
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
}; 