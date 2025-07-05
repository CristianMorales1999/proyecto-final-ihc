<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

/**
 * Modelo User - Usuarios del Sistema
 * 
 * Este modelo maneja la autenticación y información básica de todos los usuarios
 * del sistema (administradores, doctores, secretarias, pacientes).
 * 
 * @property int $id
 * @property int $role_id
 * @property string $document_id DNI como identificador único
 * @property string $password Contraseña encriptada
 * @property bool $is_active Estado activo/inactivo
 * @property string|null $remember_token Token para "recordarme"
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * 
 * @property-read \App\Models\Role $role
 * @property-read \App\Models\Profile $profile
 * @property-read \App\Models\Doctor|null $doctor
 * @property-read \App\Models\Patient|null $patient
 * @property-read \App\Models\Secretary|null $secretary
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Payment[] $uploadedPayments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Payment[] $validatedPayments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AuditLog[] $auditLogs
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'role_id',
        'document_id',
        'password',
        'is_active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];



    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    /**
     * Obtener el rol del usuario.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Obtener el perfil del usuario.
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * Obtener la información de doctor (si existe).
     */
    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }

    /**
     * Obtener la información de paciente (si existe).
     */
    public function patient()
    {
        return $this->hasOne(Patient::class);
    }

    /**
     * Obtener la información de secretaria (si existe).
     */
    public function secretary()
    {
        return $this->hasOne(Secretary::class);
    }

    /**
     * Obtener los pagos subidos por este usuario.
     */
    public function uploadedPayments()
    {
        return $this->hasMany(Payment::class, 'uploaded_by');
    }

    /**
     * Obtener los pagos validados por este usuario.
     */
    public function validatedPayments()
    {
        return $this->hasMany(Payment::class, 'validated_by');
    }

    /**
     * Obtener los logs de auditoría de este usuario.
     */
    public function auditLogs()
    {
        return $this->hasMany(AuditLog::class);
    }

    /**
     * Scope para filtrar usuarios activos.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope para filtrar usuarios inactivos.
     */
    public function scopeInactive(Builder $query): Builder
    {
        return $query->where('is_active', false);
    }

    /**
     * Scope para filtrar por rol.
     */
    public function scopeByRole(Builder $query, string $roleName): Builder
    {
        return $query->whereHas('role', function ($q) use ($roleName) {
            $q->where('name', $roleName);
        });
    }

    /**
     * Verificar si el usuario tiene un rol específico.
     */
    public function hasRole(string $roleName): bool
    {
        return $this->role->name === $roleName;
    }

    /**
     * Verificar si el usuario es administrador.
     */
    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    /**
     * Verificar si el usuario es doctor.
     */
    public function isDoctor(): bool
    {
        return $this->hasRole('doctor');
    }

    /**
     * Verificar si el usuario es secretaria.
     */
    public function isSecretary(): bool
    {
        return $this->hasRole('secretaria');
    }

    /**
     * Verificar si el usuario es paciente.
     */
    public function isPatient(): bool
    {
        return $this->hasRole('paciente');
    }

    /**
     * Obtener el nombre completo del usuario.
     */
    public function getFullNameAttribute(): string
    {
        if ($this->profile) {
            return $this->profile->first_name . ' ' . $this->profile->last_name;
        }
        return 'Usuario #' . $this->id;
    }

    /**
     * Obtener el email del usuario.
     */
    public function getEmailAttribute(): ?string
    {
        return $this->profile?->email;
    }

    /**
     * Obtener el teléfono del usuario.
     */
    public function getPhoneAttribute(): ?string
    {
        return $this->profile?->phone;
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Evento antes de crear
        static::creating(function ($user) {
            if (!isset($user->is_active)) {
                $user->is_active = true;
            }
        });
    }
}
