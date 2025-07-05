<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

/**
 * Modelo Payment - Pagos de Citas
 * 
 * Este modelo almacena los pagos realizados por las consultas,
 * incluyendo múltiples métodos de pago y estados de validación.
 * 
 * @property int $id
 * @property int $appointment_id
 * @property int $uploaded_by Usuario que subió el comprobante
 * @property int|null $validated_by Usuario que validó el pago
 * @property string $payment_number Número de pago único
 * @property string|null $image_path Ruta del comprobante
 * @property string $payment_method Método de pago
 * @property float $amount Monto del pago
 * @property string $status Estado del pago
 * @property \Carbon\Carbon|null $payment_deadline Fecha límite para pago en clínica
 * @property string|null $card_number Número de tarjeta (últimos 4 dígitos)
 * @property string|null $card_expiry Fecha de expiración (MM/AA)
 * @property string|null $card_cvv CVV de la tarjeta
 * @property string|null $rejection_reason Motivo de rechazo
 * @property \Carbon\Carbon|null $uploaded_at Fecha de subida
 * @property \Carbon\Carbon|null $validated_at Fecha de validación
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * 
 * @property-read \App\Models\Appointment $appointment
 * @property-read \App\Models\User $uploader
 * @property-read \App\Models\User|null $validator
 */
class Payment extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array<string>
     */
    protected $fillable = [
        'appointment_id',
        'uploaded_by',
        'validated_by',
        'payment_number',
        'image_path',
        'payment_method',
        'amount',
        'status',
        'payment_deadline',
        'card_number',
        'card_expiry',
        'card_cvv',
        'rejection_reason',
        'uploaded_at',
        'validated_at'
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'payment_deadline' => 'datetime',
        'validated_at' => 'datetime',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Obtener la cita asociada al pago.
     */
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    /**
     * Obtener el usuario que subió el comprobante.
     */
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    /**
     * Obtener el usuario que validó el pago.
     */
    public function validator()
    {
        return $this->belongsTo(User::class, 'validated_by');
    }

    /**
     * Scope para filtrar pagos pendientes.
     */
    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', 'pendiente');
    }

    /**
     * Scope para filtrar pagos validados.
     */
    public function scopeValidated(Builder $query): Builder
    {
        return $query->where('status', 'validado');
    }

    /**
     * Scope para filtrar pagos rechazados.
     */
    public function scopeRejected(Builder $query): Builder
    {
        return $query->where('status', 'rechazado');
    }

    /**
     * Scope para filtrar pagos en pre-reserva.
     */
    public function scopePreReservation(Builder $query): Builder
    {
        return $query->where('status', 'pre_reserva');
    }

    /**
     * Scope para filtrar por método de pago.
     */
    public function scopeByMethod(Builder $query, string $method): Builder
    {
        return $query->where('payment_method', $method);
    }

    /**
     * Scope para filtrar pagos con comprobante.
     */
    public function scopeWithReceipt(Builder $query): Builder
    {
        return $query->whereNotNull('image_path');
    }

    /**
     * Scope para filtrar pagos sin comprobante.
     */
    public function scopeWithoutReceipt(Builder $query): Builder
    {
        return $query->whereNull('image_path');
    }

    /**
     * Scope para filtrar pagos de esta semana.
     */
    public function scopeThisWeek(Builder $query): Builder
    {
        return $query->whereBetween('created_at', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ]);
    }

    /**
     * Scope para filtrar pagos de este mes.
     */
    public function scopeThisMonth(Builder $query): Builder
    {
        return $query->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year);
    }

    /**
     * Obtener el nombre del paciente.
     */
    public function getPatientNameAttribute(): string
    {
        return $this->appointment->patient_name;
    }

    /**
     * Obtener el nombre del doctor.
     */
    public function getDoctorNameAttribute(): string
    {
        return $this->appointment->doctor_name;
    }

    /**
     * Obtener la especialidad del doctor.
     */
    public function getSpecialtyNameAttribute(): string
    {
        return $this->appointment->specialty_name;
    }

    /**
     * Obtener la fecha de la cita.
     */
    public function getAppointmentDateAttribute(): string
    {
        return $this->appointment->date_display;
    }

    /**
     * Obtener el método de pago en español.
     */
    public function getPaymentMethodDisplayAttribute(): string
    {
        $methods = [
            'transferencia' => 'Transferencia Bancaria',
            'yape' => 'Yape',
            'plin' => 'Plin',
            'clinica' => 'Pago en Clínica',
            'tarjeta' => 'Pago en Línea',
        ];
        
        return $methods[$this->payment_method] ?? ucfirst($this->payment_method);
    }

    /**
     * Obtener el estado del pago en español.
     */
    public function getStatusDisplayAttribute(): string
    {
        $statuses = [
            'pendiente' => 'Pendiente',
            'validado' => 'Validado',
            'rechazado' => 'Rechazado',
            'reembolsado' => 'Reembolsado',
            'pre_reserva' => 'Pre-reserva',
        ];
        
        return $statuses[$this->status] ?? ucfirst($this->status);
    }

    /**
     * Obtener el monto formateado.
     */
    public function getAmountDisplayAttribute(): string
    {
        return 'S/ ' . number_format($this->amount, 2);
    }

    /**
     * Obtener el color del estado para la interfaz.
     */
    public function getStatusColorAttribute(): string
    {
        $colors = [
            'pendiente' => 'yellow',
            'validado' => 'green',
            'rechazado' => 'red',
            'reembolsado' => 'gray',
            'pre_reserva' => 'blue',
        ];
        
        return $colors[$this->status] ?? 'gray';
    }

    /**
     * Verificar si el pago está pendiente.
     */
    public function isPending(): bool
    {
        return $this->status === 'pendiente';
    }

    /**
     * Verificar si el pago está validado.
     */
    public function isValidated(): bool
    {
        return $this->status === 'validado';
    }

    /**
     * Verificar si el pago está rechazado.
     */
    public function isRejected(): bool
    {
        return $this->status === 'rechazado';
    }

    /**
     * Verificar si el pago está en pre-reserva.
     */
    public function isPreReservation(): bool
    {
        return $this->status === 'pre_reserva';
    }

    /**
     * Verificar si el pago tiene comprobante.
     */
    public function hasReceipt(): bool
    {
        return !empty($this->image_path);
    }

    /**
     * Verificar si el pago requiere comprobante.
     */
    public function requiresReceipt(): bool
    {
        return in_array($this->payment_method, ['transferencia', 'yape', 'plin']);
    }

    /**
     * Verificar si el pago es en clínica.
     */
    public function isClinicPayment(): bool
    {
        return $this->payment_method === 'clinica';
    }

    /**
     * Verificar si el pago es con tarjeta.
     */
    public function isCardPayment(): bool
    {
        return $this->payment_method === 'tarjeta';
    }

    /**
     * Verificar si el pago tiene fecha límite vencida.
     */
    public function isDeadlineExpired(): bool
    {
        if (!$this->payment_deadline) {
            return false;
        }
        return $this->payment_deadline->isPast();
    }

    /**
     * Obtener el tiempo restante hasta la fecha límite.
     */
    public function getTimeUntilDeadlineAttribute(): ?string
    {
        if (!$this->payment_deadline) {
            return null;
        }

        if ($this->payment_deadline->isPast()) {
            return 'Vencido';
        }

        $diff = now()->diff($this->payment_deadline);
        
        if ($diff->days > 0) {
            return $diff->days . ' día(s)';
        } elseif ($diff->h > 0) {
            return $diff->h . ' hora(s)';
        } else {
            return $diff->i . ' minuto(s)';
        }
    }

    /**
     * Obtener el nombre del validador.
     */
    public function getValidatorNameAttribute(): ?string
    {
        return $this->validator?->full_name;
    }

    /**
     * Obtener el nombre del subidor.
     */
    public function getUploaderNameAttribute(): string
    {
        return $this->uploader->full_name;
    }

    /**
     * Verificar si el pago puede ser validado.
     */
    public function canBeValidated(): bool
    {
        return $this->is_pending && $this->has_receipt;
    }

    /**
     * Verificar si el pago puede ser rechazado.
     */
    public function canBeRejected(): bool
    {
        return $this->is_pending && $this->has_receipt;
    }

    /**
     * Obtener el mensaje de estado del pago.
     */
    public function getStatusMessageAttribute(): string
    {
        $messages = [
            'pendiente' => 'Esperando validación del comprobante',
            'validado' => 'Pago confirmado exitosamente',
            'rechazado' => 'Comprobante rechazado: ' . ($this->rejection_reason ?? 'Sin especificar'),
            'reembolsado' => 'Pago devuelto al paciente',
            'pre_reserva' => 'Pre-reserva con pago pendiente en clínica',
        ];
        
        return $messages[$this->status] ?? 'Estado no definido';
    }

    /**
     * Boot del modelo.
     */
    protected static function boot()
    {
        parent::boot();

        // Evento antes de crear
        static::creating(function ($payment) {
            if (!isset($payment->payment_number)) {
                $payment->payment_number = 'PAY-' . str_pad($payment->appointment_id, 8, '0', STR_PAD_LEFT);
            }
            if (!isset($payment->uploaded_at)) {
                $payment->uploaded_at = now();
            }
        });
    }
} 