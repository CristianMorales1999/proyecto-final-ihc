<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

/**
 * Modelo Patient - Pacientes del Sistema
 * 
 * Este modelo almacena la información médica específica de los pacientes,
 * incluyendo tipo de sangre, alergias, condiciones médicas, etc.
 * 
 * @property int $id
 * @property int $user_id
 * @property string $blood_type Tipo de sangre
 * @property string|null $allergies Alergias del paciente
 * @property string|null $medical_conditions Condiciones médicas preexistentes
 * @property string|null $medications Medicamentos regulares
 * @property string|null $family_history Historial médico familiar
 * @property string|null $emergency_contact Contacto de emergencia
 * @property bool $is_active Estado activo/inactivo
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * 
 * @property-read \App\Models\User $user
 * @property-read \App\Models\MedicalRecord $medicalRecord
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Appointment[] $appointments
 */
class Patient extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'blood_type',
        'allergies',
        'medical_conditions',
        'medications',
        'family_history',
        'emergency_contact',
        'is_active'
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'allergies' => 'array',
        'medical_conditions' => 'array',
        'medications' => 'array',
        'family_history' => 'array',
        'emergency_contact' => 'array',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Obtener el usuario al que pertenece este paciente.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtener el historial médico del paciente.
     */
    public function medicalRecord()
    {
        return $this->hasOne(MedicalRecord::class);
    }

    /**
     * Obtener las citas del paciente.
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Scope para filtrar pacientes activos.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope para filtrar pacientes inactivos.
     */
    public function scopeInactive(Builder $query): Builder
    {
        return $query->where('is_active', false);
    }

    /**
     * Scope para filtrar por tipo de sangre.
     */
    public function scopeByBloodType(Builder $query, string $bloodType): Builder
    {
        return $query->where('blood_type', $bloodType);
    }

    /**
     * Scope para buscar por nombre.
     */
    public function scopeSearchByName(Builder $query, string $search): Builder
    {
        return $query->whereHas('user.profile', function ($q) use ($search) {
            $q->where('first_name', 'like', "%{$search}%")
              ->orWhere('last_name', 'like', "%{$search}%");
        });
    }

    /**
     * Scope para filtrar pacientes con alergias.
     */
    public function scopeWithAllergies(Builder $query): Builder
    {
        return $query->whereNotNull('allergies')->where('allergies', '!=', '');
    }

    /**
     * Scope para filtrar pacientes con condiciones médicas.
     */
    public function scopeWithMedicalConditions(Builder $query): Builder
    {
        return $query->whereNotNull('medical_conditions')->where('medical_conditions', '!=', '');
    }

    /**
     * Obtener el nombre completo del paciente.
     */
    public function getFullNameAttribute(): string
    {
        return $this->user->full_name;
    }

    /**
     * Obtener el email del paciente.
     */
    public function getEmailAttribute(): ?string
    {
        return $this->user->email;
    }

    /**
     * Obtener el teléfono del paciente.
     */
    public function getPhoneAttribute(): ?string
    {
        return $this->user->phone;
    }

    /**
     * Obtener la edad del paciente.
     */
    public function getAgeAttribute(): ?int
    {
        return $this->user->profile?->age;
    }

    /**
     * Obtener el tipo de sangre formateado.
     */
    public function getBloodTypeDisplayAttribute(): string
    {
        $bloodTypes = [
            'A+' => 'A Positivo',
            'A-' => 'A Negativo',
            'B+' => 'B Positivo',
            'B-' => 'B Negativo',
            'AB+' => 'AB Positivo',
            'AB-' => 'AB Negativo',
            'O+' => 'O Positivo',
            'O-' => 'O Negativo',
        ];
        
        return $bloodTypes[$this->blood_type] ?? $this->blood_type;
    }

    /**
     * Obtener el número total de citas del paciente.
     */
    public function getTotalAppointmentsAttribute(): int
    {
        return $this->appointments()->count();
    }

    /**
     * Obtener el número de citas completadas del paciente.
     */
    public function getCompletedAppointmentsAttribute(): int
    {
        return $this->appointments()->where('status', 'completada')->count();
    }

    /**
     * Obtener el número de citas pendientes del paciente.
     */
    public function getPendingAppointmentsAttribute(): int
    {
        return $this->appointments()->where('status', 'programada')->count();
    }

    /**
     * Obtener el número de citas canceladas del paciente.
     */
    public function getCancelledAppointmentsAttribute(): int
    {
        return $this->appointments()->where('status', 'cancelada')->count();
    }

    /**
     * Obtener la última cita del paciente.
     */
    public function getLastAppointmentAttribute()
    {
        return $this->appointments()->latest('appointment_date')->first();
    }

    /**
     * Obtener la próxima cita del paciente.
     */
    public function getNextAppointmentAttribute()
    {
        return $this->appointments()
            ->where('appointment_date', '>=', now()->toDateString())
            ->where('status', 'programada')
            ->orderBy('appointment_date')
            ->first();
    }

    /**
     * Verificar si el paciente tiene alergias.
     */
    public function hasAllergies(): bool
    {
        return !empty($this->allergies);
    }

    /**
     * Verificar si el paciente tiene condiciones médicas.
     */
    public function hasMedicalConditions(): bool
    {
        return !empty($this->medical_conditions);
    }

    /**
     * Verificar si el paciente toma medicamentos regulares.
     */
    public function takesMedications(): bool
    {
        return !empty($this->medications);
    }

    /**
     * Verificar si el paciente tiene historial familiar.
     */
    public function hasFamilyHistory(): bool
    {
        return !empty($this->family_history);
    }

    /**
     * Verificar si el paciente tiene contacto de emergencia.
     */
    public function hasEmergencyContact(): bool
    {
        return !empty($this->emergency_contact);
    }

    /**
     * Verificar si el paciente tiene citas pendientes.
     */
    public function hasPendingAppointments(): bool
    {
        return $this->pending_appointments > 0;
    }

    /**
     * Verificar si el paciente es frecuente (más de 5 citas).
     */
    public function isFrequent(): bool
    {
        return $this->total_appointments > 5;
    }

    /**
     * Verificar si el paciente es nuevo (menos de 3 citas).
     */
    public function isNew(): bool
    {
        return $this->total_appointments < 3;
    }

    /**
     * Obtener el estado de salud del paciente.
     */
    public function getHealthStatusAttribute(): string
    {
        if ($this->hasMedicalConditions() && $this->hasAllergies()) {
            return 'Complejo';
        } elseif ($this->hasMedicalConditions() || $this->hasAllergies()) {
            return 'Moderado';
        } else {
            return 'Saludable';
        }
    }

    /**
     * Obtener las alergias como array.
     */
    public function getAllergiesArrayAttribute(): array
    {
        if (empty($this->allergies)) {
            return [];
        }
        return array_map('trim', explode(',', $this->allergies));
    }

    /**
     * Obtener las condiciones médicas como array.
     */
    public function getMedicalConditionsArrayAttribute(): array
    {
        if (empty($this->medical_conditions)) {
            return [];
        }
        return array_map('trim', explode(',', $this->medical_conditions));
    }

    /**
     * Obtener los medicamentos como array.
     */
    public function getMedicationsArrayAttribute(): array
    {
        if (empty($this->medications)) {
            return [];
        }
        return array_map('trim', explode(',', $this->medications));
    }

    /**
     * Boot del modelo.
     */
    protected static function boot()
    {
        parent::boot();

        // Evento antes de crear
        static::creating(function ($patient) {
            if (!isset($patient->is_active)) {
                $patient->is_active = true;
            }
        });
    }
} 