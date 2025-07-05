<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

/**
 * Modelo Specialty - Especialidades Médicas
 * 
 * Este modelo define las especialidades médicas disponibles en el sistema
 * y sus descripciones detalladas.
 * 
 * @property int $id
 * @property string $name Nombre de la especialidad
 * @property string $description Descripción detallada
 * @property bool $is_active Estado activo/inactivo
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * 
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Doctor[] $doctors
 */
class Specialty extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'description',
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
     * Obtener los doctores que tienen esta especialidad.
     */
    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    /**
     * Scope para filtrar especialidades activas.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope para filtrar especialidades inactivas.
     */
    public function scopeInactive(Builder $query): Builder
    {
        return $query->where('is_active', false);
    }

    /**
     * Scope para buscar por nombre.
     */
    public function scopeSearchByName(Builder $query, string $search): Builder
    {
        return $query->where('name', 'like', "%{$search}%");
    }

    /**
     * Scope para buscar por descripción.
     */
    public function scopeSearchByDescription(Builder $query, string $search): Builder
    {
        return $query->where('description', 'like', "%{$search}%");
    }

    /**
     * Obtener el nombre de la especialidad en español.
     */
    public function getDisplayNameAttribute(): string
    {
        $specialties = [
            'cardiologia' => 'Cardiología',
            'dermatologia' => 'Dermatología',
            'endocrinologia' => 'Endocrinología',
            'gastroenterologia' => 'Gastroenterología',
            'ginecologia' => 'Ginecología',
            'neurologia' => 'Neurología',
            'oftalmologia' => 'Oftalmología',
            'ortopedia' => 'Ortopedia',
            'pediatria' => 'Pediatría',
            'psiquiatria' => 'Psiquiatría',
            'radiologia' => 'Radiología',
            'traumatologia' => 'Traumatología',
            'urologia' => 'Urología',
            'medicina_general' => 'Medicina General',
            'oncologia' => 'Oncología',
        ];
        
        return $specialties[$this->name] ?? ucfirst($this->name);
    }

    /**
     * Obtener el número de doctores en esta especialidad.
     */
    public function getDoctorsCountAttribute(): int
    {
        return $this->doctors()->count();
    }

    /**
     * Obtener el número de doctores activos en esta especialidad.
     */
    public function getActiveDoctorsCountAttribute(): int
    {
        return $this->doctors()->whereHas('user', function ($q) {
            $q->where('is_active', true);
        })->count();
    }

    /**
     * Verificar si la especialidad tiene doctores.
     */
    public function hasDoctors(): bool
    {
        return $this->doctors_count > 0;
    }

    /**
     * Verificar si la especialidad tiene doctores activos.
     */
    public function hasActiveDoctors(): bool
    {
        return $this->active_doctors_count > 0;
    }

    /**
     * Obtener la tarifa promedio de consulta en esta especialidad.
     */
    public function getAverageConsultationFeeAttribute(): ?float
    {
        $average = $this->doctors()->avg('consultation_fee');
        return $average ? round($average, 2) : null;
    }

    /**
     * Obtener la tarifa mínima de consulta en esta especialidad.
     */
    public function getMinConsultationFeeAttribute(): ?float
    {
        return $this->doctors()->min('consultation_fee');
    }

    /**
     * Obtener la tarifa máxima de consulta en esta especialidad.
     */
    public function getMaxConsultationFeeAttribute(): ?float
    {
        return $this->doctors()->max('consultation_fee');
    }

    /**
     * Boot del modelo.
     */
    protected static function boot()
    {
        parent::boot();

        // Evento antes de crear
        static::creating(function ($specialty) {
            if (!isset($specialty->is_active)) {
                $specialty->is_active = true;
            }
        });

        // Evento antes de guardar
        static::saving(function ($specialty) {
            // Capitalizar nombre
            if ($specialty->name) {
                $specialty->name = strtolower($specialty->name);
            }
        });
    }
} 