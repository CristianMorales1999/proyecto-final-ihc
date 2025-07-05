<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

/**
 * Modelo Role - Roles del Sistema
 * 
 * Este modelo define los diferentes roles que pueden tener los usuarios
 * en el sistema (admin, doctor, secretaria, paciente).
 * 
 * @property int $id
 * @property string $name Nombre del rol
 * @property string $description Descripción del rol
 * @property bool $is_active Estado activo/inactivo
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * 
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 */
class Role extends Model
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
     * Obtener los usuarios que tienen este rol.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Scope para filtrar roles activos.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope para filtrar roles inactivos.
     */
    public function scopeInactive(Builder $query): Builder
    {
        return $query->where('is_active', false);
    }

    /**
     * Scope para filtrar por nombre de rol.
     */
    public function scopeByName(Builder $query, string $name): Builder
    {
        return $query->where('name', $name);
    }

    /**
     * Verificar si el rol es administrador.
     */
    public function isAdmin(): bool
    {
        return $this->name === 'admin';
    }

    /**
     * Verificar si el rol es doctor.
     */
    public function isDoctor(): bool
    {
        return $this->name === 'doctor';
    }

    /**
     * Verificar si el rol es secretaria.
     */
    public function isSecretary(): bool
    {
        return $this->name === 'secretaria';
    }

    /**
     * Verificar si el rol es paciente.
     */
    public function isPatient(): bool
    {
        return $this->name === 'paciente';
    }

    /**
     * Obtener el nombre del rol en español.
     */
    public function getDisplayNameAttribute(): string
    {
        $roles = [
            'admin' => 'Administrador',
            'doctor' => 'Doctor',
            'secretaria' => 'Secretaria',
            'paciente' => 'Paciente',
        ];
        
        return $roles[$this->name] ?? ucfirst($this->name);
    }

    /**
     * Boot del modelo.
     */
    protected static function boot()
    {
        parent::boot();

        // Evento antes de crear
        static::creating(function ($role) {
            if (!isset($role->is_active)) {
                $role->is_active = true;
            }
        });
    }
} 