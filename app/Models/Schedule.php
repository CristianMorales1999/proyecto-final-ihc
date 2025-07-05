<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

/**
 * Modelo Schedule - Horarios de Doctores
 * 
 * Este modelo define los horarios de atención de cada doctor,
 * incluyendo días, horarios y configuración de citas.
 * 
 * @property int $id
 * @property int $doctor_id
 * @property string $day_of_week Día de la semana
 * @property string $start_time Hora de inicio
 * @property string $end_time Hora de fin
 * @property int $appointment_duration Duración de cada cita (minutos)
 * @property int $max_appointments Máximo número de citas por día
 * @property bool $is_active Estado activo/inactivo
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * 
 * @property-read \App\Models\Doctor $doctor
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Appointment[] $appointments
 */
class Schedule extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array<string>
     */
    protected $fillable = [
        'doctor_id',
        'day_of_week',
        'start_time',
        'end_time',
        'appointment_duration',
        'max_appointments',
        'is_active'
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'appointment_duration' => 'integer',
        'max_appointments' => 'integer',
        'is_active' => 'boolean',
        'start_time' => 'string',
        'end_time' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Obtener el doctor al que pertenece este horario.
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    /**
     * Obtener las citas programadas en este horario.
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Scope para filtrar horarios activos.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope para filtrar horarios inactivos.
     */
    public function scopeInactive(Builder $query): Builder
    {
        return $query->where('is_active', false);
    }

    /**
     * Scope para filtrar por día de la semana.
     */
    public function scopeByDay(Builder $query, string $day): Builder
    {
        return $query->where('day_of_week', $day);
    }

    /**
     * Scope para filtrar por doctor.
     */
    public function scopeByDoctor(Builder $query, int $doctorId): Builder
    {
        return $query->where('doctor_id', $doctorId);
    }

    /**
     * Scope para filtrar horarios de mañana (antes de las 12:00).
     */
    public function scopeMorning(Builder $query): Builder
    {
        return $query->where('start_time', '<', '12:00:00');
    }

    /**
     * Scope para filtrar horarios de tarde (después de las 12:00).
     */
    public function scopeAfternoon(Builder $query): Builder
    {
        return $query->where('start_time', '>=', '12:00:00');
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
     * Obtener el día de la semana en español.
     */
    public function getDayDisplayAttribute(): string
    {
        $days = [
            'lunes' => 'Lunes',
            'martes' => 'Martes',
            'miercoles' => 'Miércoles',
            'jueves' => 'Jueves',
            'viernes' => 'Viernes',
            'sabado' => 'Sábado',
            'domingo' => 'Domingo',
        ];
        
        return $days[$this->day_of_week] ?? ucfirst($this->day_of_week);
    }

    /**
     * Obtener el horario formateado.
     */
    public function getTimeRangeAttribute(): string
    {
        $start = substr($this->start_time, 0, 5);
        $end = substr($this->end_time, 0, 5);
        return "{$start} - {$end}";
    }

    /**
     * Obtener la duración de cita formateada.
     */
    public function getDurationDisplayAttribute(): string
    {
        if ($this->appointment_duration >= 60) {
            $hours = floor($this->appointment_duration / 60);
            $minutes = $this->appointment_duration % 60;
            
            if ($minutes > 0) {
                return "{$hours}h {$minutes}min";
            }
            return "{$hours}h";
        }
        
        return "{$this->appointment_duration}min";
    }

    /**
     * Obtener el número de citas programadas para este horario.
     */
    public function getScheduledAppointmentsAttribute(): int
    {
        return $this->appointments()
            ->where('status', 'programada')
            ->count();
    }

    /**
     * Obtener el número de citas disponibles.
     */
    public function getAvailableSlotsAttribute(): int
    {
        return max(0, $this->max_appointments - $this->scheduled_appointments);
    }

    /**
     * Obtener el porcentaje de ocupación del horario.
     */
    public function getOccupancyRateAttribute(): float
    {
        if ($this->max_appointments === 0) {
            return 0;
        }
        return round(($this->scheduled_appointments / $this->max_appointments) * 100, 2);
    }

    /**
     * Verificar si el horario está disponible.
     */
    public function isAvailable(): bool
    {
        return $this->available_slots > 0;
    }

    /**
     * Verificar si el horario está completo.
     */
    public function isFull(): bool
    {
        return $this->available_slots === 0;
    }

    /**
     * Verificar si el horario está casi completo (menos del 20% disponible).
     */
    public function isAlmostFull(): bool
    {
        return $this->occupancy_rate >= 80;
    }

    /**
     * Obtener el estado de disponibilidad en texto.
     */
    public function getAvailabilityStatusAttribute(): string
    {
        if ($this->is_full()) {
            return 'Completo';
        } elseif ($this->is_almost_full()) {
            return 'Casi Completo';
        } elseif ($this->is_available()) {
            return 'Disponible';
        } else {
            return 'No Disponible';
        }
    }

    /**
     * Obtener las horas de cita disponibles.
     */
    public function getAvailableHoursAttribute(): array
    {
        $hours = [];
        $current = \Carbon\Carbon::createFromFormat('H:i:s', $this->start_time);
        $end = \Carbon\Carbon::createFromFormat('H:i:s', $this->end_time);
        
        while ($current < $end) {
            $hours[] = $current->format('H:i');
            $current = $current->copy()->addMinutes($this->appointment_duration);
        }
        
        return $hours;
    }

    /**
     * Obtener las horas ocupadas.
     */
    public function getOccupiedHoursAttribute(): array
    {
        return $this->appointments()
            ->where('status', 'programada')
            ->pluck('appointment_time')
            ->map(function ($time) {
                return $time->format('H:i');
            })
            ->toArray();
    }

    /**
     * Obtener las horas disponibles (no ocupadas).
     */
    public function getFreeHoursAttribute(): array
    {
        $available = $this->available_hours;
        $occupied = $this->occupied_hours;
        
        return array_diff($available, $occupied);
    }

    /**
     * Verificar si una hora específica está disponible.
     */
    public function isHourAvailable(string $hour): bool
    {
        return in_array($hour, $this->free_hours);
    }

    /**
     * Obtener el próximo horario disponible.
     */
    public function getNextAvailableHourAttribute(): ?string
    {
        $freeHours = $this->free_hours;
        return !empty($freeHours) ? reset($freeHours) : null;
    }

    /**
     * Boot del modelo.
     */
    protected static function boot()
    {
        parent::boot();

        // Evento antes de crear
        static::creating(function ($schedule) {
            if (!isset($schedule->is_active)) {
                $schedule->is_active = true;
            }
            if (!isset($schedule->appointment_duration)) {
                $schedule->appointment_duration = 30;
            }
            if (!isset($schedule->max_appointments)) {
                $schedule->max_appointments = 8;
            }
        });
    }
} 