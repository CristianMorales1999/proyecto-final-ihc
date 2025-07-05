<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabla de pagos
     * Almacena los pagos realizados por las consultas médicas
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->constrained('appointments')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('uploaded_by')->constrained('users')->onDelete('restrict')->onUpdate('cascade'); // Usuario que subió el comprobante
            $table->foreignId('validated_by')->nullable()->constrained('users')->onDelete('restrict')->onUpdate('cascade'); // Usuario que validó el pago
            
            $table->string('payment_number')->unique()->index(); // Número de pago único
            $table->string('image_path')->nullable(); // Ruta de la imagen del comprobante
            $table->enum('payment_method', ['transferencia', 'yape', 'plin', 'clinica', 'tarjeta'])->index(); // Método de pago
            $table->decimal('amount', 10, 2); // Monto del pago
            $table->enum('status', ['pendiente', 'validado', 'rechazado', 'reembolsado', 'pre_reserva'])->default('pendiente')->index(); // Estado del pago
            $table->date('payment_deadline')->nullable(); // Fecha límite para pago en clínica
            $table->string('card_number', 20)->nullable(); // Número de tarjeta (últimos 4 dígitos)
            $table->string('card_expiry', 5)->nullable(); // Fecha de expiración (MM/AA)
            $table->string('card_cvv', 4)->nullable(); // CVV de la tarjeta
            $table->text('rejection_reason')->nullable(); // Motivo de rechazo si aplica
            $table->timestamp('uploaded_at')->nullable(); // Fecha de subida del comprobante
            $table->timestamp('validated_at')->nullable(); // Fecha de validación
            $table->timestamps();
            $table->softDeletes();
            
            // Índices para consultas eficientes
            $table->index(['appointment_id', 'status']);
            $table->index(['uploaded_by', 'created_at']);
            $table->index(['validated_by', 'validated_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
}; 