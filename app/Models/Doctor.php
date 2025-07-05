<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

/**
 * Modelo Doctor - Doctores del Sistema
 * 
 * Este modelo almacena la información específica de los doctores,
 * incluyendo su especialidad, licencia, experiencia y tarifas.
 * 
 * @property int $id
 * @property int $user_id
 * @property int $specialty_id
 * @property string $license_code Código de licencia médica
 * @property int $experience_years Años de experiencia
 * @property string|null $biography Biografía del doctor
 * @property float $consultation_fee Tarifa de consulta
 * @property bool $is_available Disponibilidad
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * 
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Specialty $specialty
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Schedule[] $schedules
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Appointment[] $appointments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MedicalRecordDetail[] $medicalRecordDetails
 */
class Doctor extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'specialty_id',
        'license_code',
        'experience_years',
        'biography',
        'consultation_fee',
        'is_available'
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'consultation_fee' => 'decimal:2',
        'experience_years' => 'integer',
        'is_available' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Obtener el usuario al que pertenece este doctor.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtener la especialidad del doctor.
     */
    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }

    /**
     * Obtener los horarios del doctor.
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    /**
     * Obtener las citas del doctor.
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Obtener los detalles médicos creados por este doctor.
     */
    public function medicalRecordDetails()
    {
        return $this->hasMany(MedicalRecordDetail::class);
    }

    /**
     * Scope para filtrar doctores disponibles.
     */
    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('is_available', true);
    }

    /**
     * Scope para filtrar doctores no disponibles.
     */
    public function scopeUnavailable(Builder $query): Builder
    {
        return $query->where('is_available', false);
    }

    /**
     * Scope para filtrar por especialidad.
     */
    public function scopeBySpecialty(Builder $query, int $specialtyId): Builder
    {
        return $query->where('specialty_id', $specialtyId);
    }

    /**
     * Scope para filtrar por años de experiencia mínimos.
     */
    public function scopeMinExperience(Builder $query, int $years): Builder
    {
        return $query->where('experience_years', '>=', $years);
    }

    /**
     * Scope para filtrar por rango de tarifas.
     */
    public function scopeByFeeRange(Builder $query, float $min, float $max): Builder
    {
        return $query->whereBetween('consultation_fee', [$min, $max]);
    }

    /**
     * Scope para buscar por nombre o licencia.
     */
    public function scopeSearch(Builder $query, string $search): Builder
    {
        return $query->whereHas('user.profile', function ($q) use ($search) {
            $q->where('first_name', 'like', "%{$search}%")
              ->orWhere('last_name', 'like', "%{$search}%");
        })->orWhere('license_code', 'like', "%{$search}%");
    }

    /**
     * Obtener el nombre completo del doctor.
     */
    public function getFullNameAttribute(): string
    {
        return $this->user->full_name;
    }

    /**
     * Obtener el email del doctor.
     */
    public function getEmailAttribute(): ?string
    {
        return $this->user->email;
    }

    /**
     * Obtener el teléfono del doctor.
     */
    public function getPhoneAttribute(): ?string
    {
        return $this->user->phone;
    }

    /**
     * Obtener el nombre de la especialidad.
     */
    public function getSpecialtyNameAttribute(): string
    {
        return $this->specialty->display_name;
    }

    /**
     * Obtener el nivel de experiencia en texto.
     */
    public function getExperienceLevelAttribute(): string
    {
        if ($this->experience_years >= 20) {
            return 'Experto';
        } elseif ($this->experience_years >= 10) {
            return 'Experimentado';
        } elseif ($this->experience_years >= 5) {
            return 'Intermedio';
        } elseif ($this->experience_years >= 2) {
            return 'Principiante';
        } else {
            return 'Nuevo';
        }
    }

    /**
     * Obtener la tarifa formateada.
     */
    public function getFormattedFeeAttribute(): string
    {
        return 'S/ ' . number_format($this->consultation_fee, 2);
    }

    /**
     * Obtener el número total de citas del doctor.
     */
    public function getTotalAppointmentsAttribute(): int
    {
        return $this->appointments()->count();
    }

    /**
     * Obtener el número de citas completadas del doctor.
     */
    public function getCompletedAppointmentsAttribute(): int
    {
        return $this->appointments()->where('status', 'completada')->count();
    }

    /**
     * Obtener el número de citas pendientes del doctor.
     */
    public function getPendingAppointmentsAttribute(): int
    {
        return $this->appointments()->where('status', 'programada')->count();
    }

    /**
     * Obtener el porcentaje de citas completadas.
     */
    public function getCompletionRateAttribute(): float
    {
        if ($this->total_appointments === 0) {
            return 0;
        }
        return round(($this->completed_appointments / $this->total_appointments) * 100, 2);
    }

    /**
     * Verificar si el doctor tiene horarios disponibles.
     */
    public function hasSchedules(): bool
    {
        return $this->schedules()->active()->exists();
    }

    /**
     * Verificar si el doctor tiene citas pendientes.
     */
    public function hasPendingAppointments(): bool
    {
        return $this->pending_appointments > 0;
    }

    /**
     * Obtener los horarios activos del doctor.
     */
    public function getActiveSchedulesAttribute()
    {
        return $this->schedules()->active()->get();
    }

    /**
     * Boot del modelo.
     */
    protected static function boot()
    {
        parent::boot();

        // Evento antes de crear
        static::creating(function ($doctor) {
            if (!isset($doctor->is_available)) {
                $doctor->is_available = true;
            }
        });
    }
} 