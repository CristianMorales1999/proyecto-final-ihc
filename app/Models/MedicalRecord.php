<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

/**
 * Modelo MedicalRecord - Historiales Médicos
 * 
 * Este modelo almacena el historial médico principal de cada paciente,
 * incluyendo notas generales y referencias a los detalles específicos.
 * 
 * @property int $id
 * @property int $patient_id
 * @property string $record_number Número de historial médico
 * @property string|null $general_notes Notas generales del historial
 * @property bool $is_active Estado activo/inactivo
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * 
 * @property-read \App\Models\Patient $patient
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MedicalRecordDetail[] $details
 */
class MedicalRecord extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array<string>
     */
    protected $fillable = [
        'patient_id',
        'record_number',
        'general_notes',
        'is_active'
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Obtener el paciente al que pertenece este historial.
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Obtener los detalles del historial médico.
     */
    public function details()
    {
        return $this->hasMany(MedicalRecordDetail::class);
    }

    /**
     * Scope para filtrar historiales activos.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope para filtrar historiales inactivos.
     */
    public function scopeInactive(Builder $query): Builder
    {
        return $query->where('is_active', false);
    }

    /**
     * Scope para buscar por número de historial.
     */
    public function scopeByRecordNumber(Builder $query, string $recordNumber): Builder
    {
        return $query->where('record_number', 'like', "%{$recordNumber}%");
    }

    /**
     * Scope para buscar por paciente.
     */
    public function scopeByPatient(Builder $query, int $patientId): Builder
    {
        return $query->where('patient_id', $patientId);
    }

    /**
     * Obtener el nombre del paciente.
     */
    public function getPatientNameAttribute(): string
    {
        return $this->patient->full_name;
    }

    /**
     * Obtener el email del paciente.
     */
    public function getPatientEmailAttribute(): ?string
    {
        return $this->patient->email;
    }

    /**
     * Obtener el teléfono del paciente.
     */
    public function getPatientPhoneAttribute(): ?string
    {
        return $this->patient->phone;
    }

    /**
     * Obtener la edad del paciente.
     */
    public function getPatientAgeAttribute(): ?int
    {
        return $this->patient->age;
    }

    /**
     * Obtener el tipo de sangre del paciente.
     */
    public function getPatientBloodTypeAttribute(): string
    {
        return $this->patient->blood_type_display;
    }

    /**
     * Obtener el número total de consultas.
     */
    public function getTotalConsultationsAttribute(): int
    {
        return $this->details()->count();
    }

    /**
     * Obtener la primera consulta.
     */
    public function getFirstConsultationAttribute()
    {
        return $this->details()->oldest()->first();
    }

    /**
     * Obtener la última consulta.
     */
    public function getLastConsultationAttribute()
    {
        return $this->details()->latest()->first();
    }

    /**
     * Obtener la fecha de la primera consulta.
     */
    public function getFirstConsultationDateAttribute(): ?string
    {
        $first = $this->first_consultation;
        return $first ? $first->created_at->format('d/m/Y') : null;
    }

    /**
     * Obtener la fecha de la última consulta.
     */
    public function getLastConsultationDateAttribute(): ?string
    {
        $last = $this->last_consultation;
        return $last ? $last->created_at->format('d/m/Y') : null;
    }

    /**
     * Obtener el tiempo transcurrido desde la última consulta.
     */
    public function getTimeSinceLastConsultationAttribute(): ?string
    {
        $last = $this->last_consultation;
        if (!$last) {
            return null;
        }

        $diff = now()->diff($last->created_at);
        
        if ($diff->y > 0) {
            return $diff->y . ' año(s)';
        } elseif ($diff->m > 0) {
            return $diff->m . ' mes(es)';
        } elseif ($diff->d > 0) {
            return $diff->d . ' día(s)';
        } else {
            return 'Hoy';
        }
    }

    /**
     * Obtener las consultas de este año.
     */
    public function getConsultationsThisYearAttribute()
    {
        return $this->details()
            ->whereYear('created_at', now()->year)
            ->get();
    }

    /**
     * Obtener las consultas de este mes.
     */
    public function getConsultationsThisMonthAttribute()
    {
        return $this->details()
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->get();
    }

    /**
     * Obtener el número de consultas este año.
     */
    public function getConsultationsThisYearCountAttribute(): int
    {
        return $this->details()
            ->whereYear('created_at', now()->year)
            ->count();
    }

    /**
     * Obtener el número de consultas este mes.
     */
    public function getConsultationsThisMonthCountAttribute(): int
    {
        return $this->details()
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
    }

    /**
     * Verificar si el paciente es frecuente (más de 5 consultas).
     */
    public function isFrequentPatient(): bool
    {
        return $this->total_consultations > 5;
    }

    /**
     * Verificar si el paciente es nuevo (menos de 3 consultas).
     */
    public function isNewPatient(): bool
    {
        return $this->total_consultations < 3;
    }

    /**
     * Verificar si el paciente ha tenido consultas este año.
     */
    public function hasConsultationsThisYear(): bool
    {
        return $this->consultations_this_year_count > 0;
    }

    /**
     * Verificar si el paciente ha tenido consultas este mes.
     */
    public function hasConsultationsThisMonth(): bool
    {
        return $this->consultations_this_month_count > 0;
    }

    /**
     * Obtener el estado del paciente basado en su historial.
     */
    public function getPatientStatusAttribute(): string
    {
        if ($this->is_frequent_patient) {
            return 'Frecuente';
        } elseif ($this->is_new_patient) {
            return 'Nuevo';
        } else {
            return 'Regular';
        }
    }

    /**
     * Obtener las alergias del paciente.
     */
    public function getPatientAllergiesAttribute(): array
    {
        return $this->patient->allergies_array;
    }

    /**
     * Obtener las condiciones médicas del paciente.
     */
    public function getPatientMedicalConditionsAttribute(): array
    {
        return $this->patient->medical_conditions_array;
    }

    /**
     * Obtener los medicamentos del paciente.
     */
    public function getPatientMedicationsAttribute(): array
    {
        return $this->patient->medications_array;
    }

    /**
     * Verificar si el paciente tiene alergias.
     */
    public function patientHasAllergies(): bool
    {
        return $this->patient->has_allergies;
    }

    /**
     * Verificar si el paciente tiene condiciones médicas.
     */
    public function patientHasMedicalConditions(): bool
    {
        return $this->patient->has_medical_conditions;
    }

    /**
     * Verificar si el paciente toma medicamentos.
     */
    public function patientTakesMedications(): bool
    {
        return $this->patient->takes_medications;
    }

    /**
     * Obtener el nivel de riesgo del paciente.
     */
    public function getPatientRiskLevelAttribute(): string
    {
        if ($this->patient_has_medical_conditions && $this->patient_has_allergies) {
            return 'Alto';
        } elseif ($this->patient_has_medical_conditions || $this->patient_has_allergies) {
            return 'Moderado';
        } else {
            return 'Bajo';
        }
    }

    /**
     * Boot del modelo.
     */
    protected static function boot()
    {
        parent::boot();

        // Evento antes de crear
        static::creating(function ($medicalRecord) {
            if (!isset($medicalRecord->is_active)) {
                $medicalRecord->is_active = true;
            }
            if (!isset($medicalRecord->record_number)) {
                $medicalRecord->record_number = 'HIST-' . str_pad($medicalRecord->patient_id, 6, '0', STR_PAD_LEFT);
            }
        });
    }
} 