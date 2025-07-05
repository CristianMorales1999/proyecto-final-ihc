<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

/**
 * Modelo MedicalRecordDetail - Detalles del Historial Médico
 * 
 * Este modelo almacena los detalles específicos de cada consulta médica,
 * incluyendo síntomas, diagnóstico, tratamiento y signos vitales.
 * 
 * @property int $id
 * @property int $medical_record_id
 * @property int $appointment_id
 * @property int $doctor_id
 * @property string|null $symptoms Síntomas reportados
 * @property string|null $diagnosis Diagnóstico
 * @property string|null $treatment Tratamiento prescrito
 * @property string|null $prescription Receta médica
 * @property string|null $notes Notas del doctor
 * @property array|null $vital_signs Signos vitales (JSON)
 * @property float|null $weight Peso (kg)
 * @property float|null $height Altura (cm)
 * @property int|null $blood_pressure_systolic Presión sistólica
 * @property int|null $blood_pressure_diastolic Presión diastólica
 * @property int|null $heart_rate Frecuencia cardíaca
 * @property float|null $temperature Temperatura (°C)
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * 
 * @property-read \App\Models\MedicalRecord $medicalRecord
 * @property-read \App\Models\Appointment $appointment
 * @property-read \App\Models\Doctor $doctor
 */
class MedicalRecordDetail extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array<string>
     */
    protected $fillable = [
        'medical_record_id',
        'appointment_id',
        'doctor_id',
        'symptoms',
        'diagnosis',
        'treatment',
        'prescription',
        'notes',
        'vital_signs',
        'weight',
        'height',
        'blood_pressure_systolic',
        'blood_pressure_diastolic',
        'heart_rate',
        'temperature'
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'weight' => 'decimal:2',
        'height' => 'decimal:2',
        'blood_pressure_systolic' => 'integer',
        'blood_pressure_diastolic' => 'integer',
        'heart_rate' => 'integer',
        'temperature' => 'decimal:1',
        'symptoms' => 'array',
        'diagnosis' => 'array',
        'treatment' => 'array',
        'prescription' => 'array',
        'notes' => 'array',
        'vital_signs' => 'array',
        'consultation_date' => 'date',
        'consultation_time' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Obtener el historial médico al que pertenece este detalle.
     */
    public function medicalRecord()
    {
        return $this->belongsTo(MedicalRecord::class);
    }

    /**
     * Obtener la cita asociada a este detalle.
     */
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    /**
     * Obtener el doctor que realizó la consulta.
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    /**
     * Scope para filtrar por doctor.
     */
    public function scopeByDoctor(Builder $query, int $doctorId): Builder
    {
        return $query->where('doctor_id', $doctorId);
    }

    /**
     * Scope para filtrar por paciente.
     */
    public function scopeByPatient(Builder $query, int $patientId): Builder
    {
        return $query->whereHas('medicalRecord', function ($q) use ($patientId) {
            $q->where('patient_id', $patientId);
        });
    }

    /**
     * Scope para filtrar por especialidad.
     */
    public function scopeBySpecialty(Builder $query, int $specialtyId): Builder
    {
        return $query->whereHas('doctor', function ($q) use ($specialtyId) {
            $q->where('specialty_id', $specialtyId);
        });
    }

    /**
     * Scope para filtrar por fecha de consulta.
     */
    public function scopeByDate(Builder $query, string $date): Builder
    {
        return $query->whereDate('created_at', $date);
    }

    /**
     * Scope para filtrar consultas de este año.
     */
    public function scopeThisYear(Builder $query): Builder
    {
        return $query->whereYear('created_at', now()->year);
    }

    /**
     * Scope para filtrar consultas de este mes.
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
        return $this->medicalRecord->patient_name;
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
     * Obtener la fecha de la consulta.
     */
    public function getConsultationDateAttribute(): string
    {
        return $this->created_at->format('d/m/Y');
    }

    /**
     * Obtener la hora de la consulta.
     */
    public function getConsultationTimeAttribute(): string
    {
        return $this->created_at->format('H:i');
    }

    /**
     * Obtener la fecha y hora de la consulta.
     */
    public function getConsultationDateTimeAttribute(): string
    {
        return $this->created_at->format('d/m/Y H:i');
    }

    /**
     * Obtener el IMC (Índice de Masa Corporal).
     */
    public function getBmiAttribute(): ?float
    {
        if (!$this->weight || !$this->height || $this->height <= 0) {
            return null;
        }
        
        $heightInMeters = $this->height / 100;
        return round($this->weight / ($heightInMeters * $heightInMeters), 2);
    }

    /**
     * Obtener la categoría del IMC.
     */
    public function getBmiCategoryAttribute(): ?string
    {
        $bmi = $this->bmi;
        if (!$bmi) {
            return null;
        }

        if ($bmi < 18.5) {
            return 'Bajo peso';
        } elseif ($bmi < 25) {
            return 'Peso normal';
        } elseif ($bmi < 30) {
            return 'Sobrepeso';
        } elseif ($bmi < 35) {
            return 'Obesidad I';
        } elseif ($bmi < 40) {
            return 'Obesidad II';
        } else {
            return 'Obesidad III';
        }
    }

    /**
     * Obtener la presión arterial formateada.
     */
    public function getBloodPressureAttribute(): ?string
    {
        if (!$this->blood_pressure_systolic || !$this->blood_pressure_diastolic) {
            return null;
        }
        return "{$this->blood_pressure_systolic}/{$this->blood_pressure_diastolic} mmHg";
    }

    /**
     * Obtener la categoría de presión arterial.
     */
    public function getBloodPressureCategoryAttribute(): ?string
    {
        if (!$this->blood_pressure_systolic || !$this->blood_pressure_diastolic) {
            return null;
        }

        $systolic = $this->blood_pressure_systolic;
        $diastolic = $this->blood_pressure_diastolic;

        if ($systolic < 120 && $diastolic < 80) {
            return 'Normal';
        } elseif ($systolic < 130 && $diastolic < 80) {
            return 'Elevada';
        } elseif ($systolic < 140 && $diastolic < 90) {
            return 'Hipertensión I';
        } elseif ($systolic < 180 && $diastolic < 110) {
            return 'Hipertensión II';
        } else {
            return 'Crisis hipertensiva';
        }
    }

    /**
     * Obtener la categoría de frecuencia cardíaca.
     */
    public function getHeartRateCategoryAttribute(): ?string
    {
        if (!$this->heart_rate) {
            return null;
        }

        if ($this->heart_rate < 60) {
            return 'Bradicardia';
        } elseif ($this->heart_rate < 100) {
            return 'Normal';
        } elseif ($this->heart_rate < 120) {
            return 'Taquicardia leve';
        } else {
            return 'Taquicardia';
        }
    }

    /**
     * Obtener la categoría de temperatura.
     */
    public function getTemperatureCategoryAttribute(): ?string
    {
        if (!$this->temperature) {
            return null;
        }

        if ($this->temperature < 35) {
            return 'Hipotermia';
        } elseif ($this->temperature < 37.5) {
            return 'Normal';
        } elseif ($this->temperature < 38) {
            return 'Febrícula';
        } elseif ($this->temperature < 39) {
            return 'Fiebre';
        } else {
            return 'Fiebre alta';
        }
    }

    /**
     * Obtener el peso formateado.
     */
    public function getWeightDisplayAttribute(): ?string
    {
        return $this->weight ? number_format($this->weight, 1) . ' kg' : null;
    }

    /**
     * Obtener la altura formateada.
     */
    public function getHeightDisplayAttribute(): ?string
    {
        return $this->height ? number_format($this->height, 1) . ' cm' : null;
    }

    /**
     * Obtener la frecuencia cardíaca formateada.
     */
    public function getHeartRateDisplayAttribute(): ?string
    {
        return $this->heart_rate ? $this->heart_rate . ' lpm' : null;
    }

    /**
     * Obtener la temperatura formateada.
     */
    public function getTemperatureDisplayAttribute(): ?string
    {
        return $this->temperature ? number_format($this->temperature, 1) . '°C' : null;
    }

    /**
     * Verificar si tiene síntomas registrados.
     */
    public function hasSymptoms(): bool
    {
        return !empty($this->symptoms);
    }

    /**
     * Verificar si tiene diagnóstico registrado.
     */
    public function hasDiagnosis(): bool
    {
        return !empty($this->diagnosis);
    }

    /**
     * Verificar si tiene tratamiento registrado.
     */
    public function hasTreatment(): bool
    {
        return !empty($this->treatment);
    }

    /**
     * Verificar si tiene receta médica.
     */
    public function hasPrescription(): bool
    {
        return !empty($this->prescription);
    }

    /**
     * Verificar si tiene notas del doctor.
     */
    public function hasNotes(): bool
    {
        return !empty($this->notes);
    }

    /**
     * Verificar si tiene signos vitales registrados.
     */
    public function hasVitalSigns(): bool
    {
        return !empty($this->vital_signs);
    }

    /**
     * Verificar si tiene peso registrado.
     */
    public function hasWeight(): bool
    {
        return !is_null($this->weight);
    }

    /**
     * Verificar si tiene altura registrada.
     */
    public function hasHeight(): bool
    {
        return !is_null($this->height);
    }

    /**
     * Verificar si tiene presión arterial registrada.
     */
    public function hasBloodPressure(): bool
    {
        return !is_null($this->blood_pressure_systolic) && !is_null($this->blood_pressure_diastolic);
    }

    /**
     * Verificar si tiene frecuencia cardíaca registrada.
     */
    public function hasHeartRate(): bool
    {
        return !is_null($this->heart_rate);
    }

    /**
     * Verificar si tiene temperatura registrada.
     */
    public function hasTemperature(): bool
    {
        return !is_null($this->temperature);
    }

    /**
     * Obtener el nivel de completitud de la consulta.
     */
    public function getCompletenessLevelAttribute(): string
    {
        $fields = [
            $this->has_symptoms,
            $this->has_diagnosis,
            $this->has_treatment,
            $this->has_prescription,
            $this->has_notes,
            $this->has_vital_signs
        ];
        
        $completed = count(array_filter($fields));
        $total = count($fields);
        $percentage = ($completed / $total) * 100;
        
        if ($percentage >= 90) {
            return 'Completa';
        } elseif ($percentage >= 70) {
            return 'Buena';
        } elseif ($percentage >= 50) {
            return 'Regular';
        } else {
            return 'Incompleta';
        }
    }

    /**
     * Obtener el color del nivel de completitud.
     */
    public function getCompletenessColorAttribute(): string
    {
        $colors = [
            'Completa' => 'green',
            'Buena' => 'blue',
            'Regular' => 'yellow',
            'Incompleta' => 'red',
        ];
        
        return $colors[$this->completeness_level] ?? 'gray';
    }

    /**
     * Boot del modelo.
     */
    protected static function boot()
    {
        parent::boot();

        // Evento antes de guardar
        static::saving(function ($detail) {
            // Validar que los valores numéricos estén en rangos razonables
            if ($detail->weight && ($detail->weight < 1 || $detail->weight > 500)) {
                $detail->weight = null;
            }
            if ($detail->height && ($detail->height < 50 || $detail->height > 300)) {
                $detail->height = null;
            }
            if ($detail->heart_rate && ($detail->heart_rate < 30 || $detail->heart_rate > 200)) {
                $detail->heart_rate = null;
            }
            if ($detail->temperature && ($detail->temperature < 30 || $detail->temperature > 45)) {
                $detail->temperature = null;
            }
        });
    }
} 