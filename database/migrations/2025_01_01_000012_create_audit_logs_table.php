<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabla de logs de auditoría
     * Almacena todas las acciones realizadas en el sistema para auditoría
     */
    public function up(): void
    {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('restrict')->onUpdate('cascade'); // Usuario que realizó la acción
            
            $table->string('action')->index(); // Acción realizada (create, update, delete, login, etc.)
            $table->string('model')->index(); // Modelo afectado (Appointment, Payment, etc.)
            $table->unsignedBigInteger('model_id')->index(); // ID del modelo afectado
            $table->json('old_values')->nullable(); // Valores anteriores (JSON)
            $table->json('new_values')->nullable(); // Valores nuevos (JSON)
            $table->text('description')->nullable(); // Descripción de la acción
            $table->string('ip_address', 45)->nullable()->index(); // Dirección IP
            $table->text('user_agent')->nullable(); // User agent del navegador
            $table->string('session_id')->nullable()->index(); // ID de sesión
            $table->timestamps();
            
            // Índices compuestos para consultas eficientes
            $table->index(['model', 'model_id']);
            $table->index(['user_id', 'created_at']);
            $table->index(['action', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
}; 