<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

/**
 * Modelo Appointment - Citas Médicas
 * 
 * Este modelo almacena todas las citas programadas en el sistema,
 * incluyendo información del paciente, doctor, horario y estado.
 * 
 * @property int $id
 * @property int $patient_id
 * @property int $doctor_id
 * @property int $schedule_id
 * @property \Carbon\Carbon $appointment_date Fecha de la cita
 * @property \Carbon\Carbon $appointment_time Hora de la cita
 * @property string $status Estado de la cita
 * @property string|null $reason Motivo de la consulta
 * @property string|null $notes Notas adicionales
 * @property float $fee Tarifa de la consulta
 * @property \Carbon\Carbon|null $confirmed_at Fecha de confirmación
 * @property \Carbon\Carbon|null $completed_at Fecha de completado
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * 
 * @property-read \App\Models\Patient $patient
 * @property-read \App\Models\Doctor $doctor
 * @property-read \App\Models\Schedule $schedule
 * @property-read \App\Models\Payment $payment
 * @property-read \App\Models\MedicalRecordDetail $medicalRecordDetail
 */
class Appointment extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array<string>
     */
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'schedule_id',
        'appointment_date',
        'appointment_time',
        'status',
        'reason',
        'notes',
        'fee',
        'confirmed_at',
        'completed_at'
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'appointment_date' => 'date',
        'appointment_time' => 'datetime',
        'fee' => 'decimal:2',
        'status' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Obtener el paciente de la cita.
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Obtener el doctor de la cita.
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    /**
     * Obtener el horario de la cita.
     */
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    /**
     * Obtener el pago de la cita.
     */
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    /**
     * Obtener el detalle médico de la cita.
     */
    public function medicalRecordDetail()
    {
        return $this->hasOne(MedicalRecordDetail::class);
    }

    /**
     * Scope para filtrar citas programadas.
     */
    public function scopeScheduled(Builder $query): Builder
    {
        return $query->where('status', 'programada');
    }

    /**
     * Scope para filtrar citas completadas.
     */
    public function scopeCompleted(Builder $query): Builder
    {
        return $query->where('status', 'completada');
    }

    /**
     * Scope para filtrar citas canceladas.
     */
    public function scopeCancelled(Builder $query): Builder
    {
        return $query->where('status', 'cancelada');
    }

    /**
     * Scope para filtrar citas por fecha.
     */
    public function scopeByDate(Builder $query, string $date): Builder
    {
        return $query->where('appointment_date', $date);
    }

    /**
     * Scope para filtrar citas por doctor.
     */
    public function scopeByDoctor(Builder $query, int $doctorId): Builder
    {
        return $query->where('doctor_id', $doctorId);
    }

    /**
     * Scope para filtrar citas por paciente.
     */
    public function scopeByPatient(Builder $query, int $patientId): Builder
    {
        return $query->where('patient_id', $patientId);
    }

    /**
     * Scope para filtrar citas futuras.
     */
    public function scopeFuture(Builder $query): Builder
    {
        return $query->where('appointment_date', '>=', now()->toDateString());
    }

    /**
     * Scope para filtrar citas pasadas.
     */
    public function scopePast(Builder $query): Builder
    {
        return $query->where('appointment_date', '<', now()->toDateString());
    }

    /**
     * Scope para filtrar citas de hoy.
     */
    public function scopeToday(Builder $query): Builder
    {
        return $query->where('appointment_date', now()->toDateString());
    }

    /**
     * Scope para filtrar citas de esta semana.
     */
    public function scopeThisWeek(Builder $query): Builder
    {
        return $query->whereBetween('appointment_date', [
            now()->startOfWeek()->toDateString(),
            now()->endOfWeek()->toDateString()
        ]);
    }

    /**
     * Scope para filtrar citas de este mes.
     */
    public function scopeThisMonth(Builder $query): Builder
    {
        return $query->whereMonth('appointment_date', now()->month)
                    ->whereYear('appointment_date', now()->year);
    }

    /**
     * Obtener el nombre del paciente.
     */
    public function getPatientNameAttribute(): string
    {
        return $this->patient->full_name;
    }

    /**
     * Obtener el nombre del doctor.
     */
    public function getDoctorNameAttribute(): string
    {
        return $this->doctor->full_name;
    }

    /**
     * Obtener la especialidad del doctor.
     */
    public function getSpecialtyNameAttribute(): string
    {
        return $this->doctor->specialty_name;
    }

    /**
     * Obtener la fecha y hora formateada.
     */
    public function getDateTimeAttribute(): string
    {
        return $this->appointment_date->format('d/m/Y') . ' ' . $this->appointment_time->format('H:i');
    }

    /**
     * Obtener la fecha formateada.
     */
    public function getDateDisplayAttribute(): string
    {
        return $this->appointment_date->format('d/m/Y');
    }

    /**
     * Obtener la hora formateada.
     */
    public function getTimeDisplayAttribute(): string
    {
        return $this->appointment_time->format('H:i');
    }

    /**
     * Obtener el estado en español.
     */
    public function getStatusDisplayAttribute(): string
    {
        $statuses = [
            'programada' => 'Programada',
            'confirmada' => 'Confirmada',
            'completada' => 'Completada',
            'cancelada' => 'Cancelada',
            'no_show' => 'No Asistió',
        ];
        
        return $statuses[$this->status] ?? ucfirst($this->status);
    }

    /**
     * Obtener la tarifa formateada.
     */
    public function getFeeDisplayAttribute(): string
    {
        return 'S/ ' . number_format($this->fee, 2);
    }

    /**
     * Verificar si la cita es futura.
     */
    public function isFuture(): bool
    {
        return $this->appointment_date->isFuture();
    }

    /**
     * Verificar si la cita es pasada.
     */
    public function isPast(): bool
    {
        return $this->appointment_date->isPast();
    }

    /**
     * Verificar si la cita es de hoy.
     */
    public function isToday(): bool
    {
        return $this->appointment_date->isToday();
    }

    /**
     * Verificar si la cita está programada.
     */
    public function isScheduled(): bool
    {
        return $this->status === 'programada';
    }

    /**
     * Verificar si la cita está confirmada.
     */
    public function isConfirmed(): bool
    {
        return $this->status === 'confirmada';
    }

    /**
     * Verificar si la cita está completada.
     */
    public function isCompleted(): bool
    {
        return $this->status === 'completada';
    }

    /**
     * Verificar si la cita está cancelada.
     */
    public function isCancelled(): bool
    {
        return $this->status === 'cancelada';
    }

    /**
     * Verificar si la cita tiene pago.
     */
    public function hasPayment(): bool
    {
        return $this->payment()->exists();
    }

    /**
     * Verificar si la cita tiene detalle médico.
     */
    public function hasMedicalRecordDetail(): bool
    {
        return $this->medicalRecordDetail()->exists();
    }

    /**
     * Obtener el estado del pago.
     */
    public function getPaymentStatusAttribute(): ?string
    {
        return $this->payment?->status;
    }

    /**
     * Obtener el método de pago.
     */
    public function getPaymentMethodAttribute(): ?string
    {
        return $this->payment?->payment_method;
    }

    /**
     * Verificar si el pago está validado.
     */
    public function isPaymentValidated(): bool
    {
        return $this->payment_status === 'validado';
    }

    /**
     * Verificar si el pago está pendiente.
     */
    public function isPaymentPending(): bool
    {
        return $this->payment_status === 'pendiente';
    }

    /**
     * Obtener el tiempo restante hasta la cita.
     */
    public function getTimeUntilAttribute(): string
    {
        $now = now();
        $appointmentDateTime = $this->appointment_date->setTimeFrom($this->appointment_time);
        
        if ($appointmentDateTime->isPast()) {
            return 'Pasada';
        }
        
        $diff = $now->diff($appointmentDateTime);
        
        if ($diff->days > 0) {
            return $diff->days . ' día(s)';
        } elseif ($diff->h > 0) {
            return $diff->h . ' hora(s)';
        } else {
            return $diff->i . ' minuto(s)';
        }
    }

    /**
     * Obtener el color del estado para la interfaz.
     */
    public function getStatusColorAttribute(): string
    {
        $colors = [
            'programada' => 'blue',
            'confirmada' => 'green',
            'completada' => 'gray',
            'cancelada' => 'red',
            'no_show' => 'orange',
        ];
        
        return $colors[$this->status] ?? 'gray';
    }

    /**
     * Boot del modelo.
     */
    protected static function boot()
    {
        parent::boot();

        // Evento antes de crear
        static::creating(function ($appointment) {
            if (!isset($appointment->fee)) {
                $appointment->fee = $appointment->doctor->consultation_fee ?? 0;
            }
        });
    }
} 