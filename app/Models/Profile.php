<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

/**
 * Modelo Profile - Perfiles de Usuario
 * 
 * Este modelo almacena la información personal detallada de cada usuario
 * del sistema (datos personales, contacto, ubicación, etc.).
 * 
 * @property int $id
 * @property int $user_id
 * @property string $email Correo electrónico
 * @property string $first_name Nombre
 * @property string $last_name Apellido
 * @property string|null $address Dirección
 * @property string|null $phone Teléfono
 * @property \Carbon\Carbon|null $birthdate Fecha de nacimiento
 * @property string $gender Género (M, F, O)
 * @property string $civil_status Estado civil (S, C, V, D)
 * @property string|null $region Región
 * @property string|null $province Provincia
 * @property string|null $district Distrito
 * @property string|null $photo_path Ruta de la foto de perfil
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * 
 * @property-read \App\Models\User $user
 */
class Profile extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'email',
        'first_name',
        'last_name',
        'address',
        'phone',
        'birthdate',
        'gender',
        'civil_status',
        'region',
        'province',
        'district',
        'photo_path'
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'birthdate' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];



    /**
     * Obtener el usuario al que pertenece este perfil.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope para filtrar por género.
     */
    public function scopeByGender(Builder $query, string $gender): Builder
    {
        return $query->where('gender', $gender);
    }

    /**
     * Scope para filtrar por estado civil.
     */
    public function scopeByCivilStatus(Builder $query, string $civilStatus): Builder
    {
        return $query->where('civil_status', $civilStatus);
    }

    /**
     * Scope para filtrar por región.
     */
    public function scopeByRegion(Builder $query, string $region): Builder
    {
        return $query->where('region', $region);
    }

    /**
     * Scope para buscar por nombre o apellido.
     */
    public function scopeSearchByName(Builder $query, string $search): Builder
    {
        return $query->where(function ($q) use ($search) {
            $q->where('first_name', 'like', "%{$search}%")
              ->orWhere('last_name', 'like', "%{$search}%");
        });
    }

    /**
     * Obtener el nombre completo.
     */
    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Obtener la edad del usuario.
     */
    public function getAgeAttribute(): ?int
    {
        if (!$this->birthdate) {
            return null;
        }
        return $this->birthdate->age;
    }

    /**
     * Obtener la dirección completa.
     */
    public function getFullAddressAttribute(): string
    {
        $parts = array_filter([
            $this->address,
            $this->district,
            $this->province,
            $this->region
        ]);
        
        return implode(', ', $parts);
    }

    /**
     * Obtener el género en español.
     */
    public function getGenderDisplayAttribute(): string
    {
        $genders = [
            'M' => 'Masculino',
            'F' => 'Femenino',
            'O' => 'Otro',
        ];
        
        return $genders[$this->gender] ?? 'No especificado';
    }

    /**
     * Obtener el estado civil en español.
     */
    public function getCivilStatusDisplayAttribute(): string
    {
        $civilStatuses = [
            'S' => 'Soltero/a',
            'C' => 'Casado/a',
            'V' => 'Viudo/a',
            'D' => 'Divorciado/a',
        ];
        
        return $civilStatuses[$this->civil_status] ?? 'No especificado';
    }

    /**
     * Verificar si el usuario es mayor de edad.
     */
    public function isAdult(): bool
    {
        return $this->age && $this->age >= 18;
    }

    /**
     * Verificar si el usuario es menor de edad.
     */
    public function isMinor(): bool
    {
        return $this->age && $this->age < 18;
    }

    /**
     * Boot del modelo.
     */
    protected static function boot()
    {
        parent::boot();

        // Evento antes de guardar
        static::saving(function ($profile) {
            // Capitalizar nombres
            if ($profile->first_name) {
                $profile->first_name = ucwords(strtolower($profile->first_name));
            }
            if ($profile->last_name) {
                $profile->last_name = ucwords(strtolower($profile->last_name));
            }
            
            // Capitalizar ubicación
            if ($profile->region) {
                $profile->region = ucwords(strtolower($profile->region));
            }
            if ($profile->province) {
                $profile->province = ucwords(strtolower($profile->province));
            }
            if ($profile->district) {
                $profile->district = ucwords(strtolower($profile->district));
            }
        });
    }
} 