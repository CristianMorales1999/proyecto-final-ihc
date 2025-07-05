<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabla de perfiles de usuario
     * Almacena la información personal detallada de cada usuario
     */
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            
            $table->string('email')->unique()->nullable()->index(); // Correo electrónico único
            $table->string('first_name', 50)->nullable()->index(); // Nombre
            $table->string('last_name', 50)->nullable()->index(); // Apellido
            $table->string('address', 100)->nullable(); // Dirección
            $table->string('phone', 12)->nullable()->index(); // Teléfono
            $table->date('birthdate')->nullable()->index(); // Fecha de nacimiento
            $table->enum('gender', ['Masculino', 'Femenino', 'Otro'])->nullable()->index(); // Género
            $table->enum('civil_status', ['Soltero', 'Casado', 'Viudo', 'Divorciado'])->nullable()->index(); // Estado civil
            $table->string('region', 50)->nullable()->index(); // Región
            $table->string('province', 50)->nullable()->index(); // Provincia
            $table->string('district', 50)->nullable()->index(); // Distrito
            $table->string('photo_path')->nullable(); // Ruta de la foto de perfil
            
            $table->timestamps();
            $table->softDeletes();
            
            // Índices compuestos para búsquedas eficientes
            $table->index(['first_name', 'last_name']);
            $table->index(['region', 'province', 'district']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
}; 