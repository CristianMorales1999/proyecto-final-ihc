<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    /**
     * Tabla de usuarios del sistema
     * Almacena la información básica de autenticación de todos los usuarios
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained('roles')->onDelete('restrict')->onUpdate('cascade');
            $table->string('document_id', 8)->unique()->index(); // DNI como identificador único
            $table->string('password');
            $table->boolean('is_active')->default(true)->index(); // Para desactivar usuarios sin eliminarlos
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes(); // Soft deletes para mantener integridad referencial
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('document_id', 8)->primary(); // DNI como identificador único
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
