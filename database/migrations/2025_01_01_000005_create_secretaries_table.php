<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabla de secretarias
     * Almacena la información específica de las secretarias del sistema
     */
    public function up(): void
    {
        Schema::create('secretaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            
            $table->string('employee_code', 10)->unique()->index(); // Código de empleado
            $table->date('hire_date')->nullable(); // Fecha de contratación
            $table->boolean('is_active')->default(true)->index(); // Estado activo/inactivo
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('secretaries');
    }
}; 