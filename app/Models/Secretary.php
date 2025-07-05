<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

/**
 * Modelo Secretary - Secretarias del Sistema
 * 
 * Este modelo almacena la información específica de las secretarias,
 * incluyendo su código de empleado y fecha de contratación.
 * 
 * @property int $id
 * @property int $user_id
 * @property string $employee_code Código de empleado
 * @property \Carbon\Carbon $hire_date Fecha de contratación
 * @property bool $is_active Estado activo/inactivo
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * 
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Payment[] $validatedPayments
 */
class Secretary extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'employee_code',
        'hire_date',
        'is_active'
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'hire_date' => 'date',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Obtener el usuario al que pertenece esta secretaria.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtener los pagos validados por esta secretaria.
     */
    public function validatedPayments()
    {
        return $this->hasMany(Payment::class, 'validated_by', 'user_id');
    }

    /**
     * Scope para filtrar secretarias activas.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope para filtrar secretarias inactivas.
     */
    public function scopeInactive(Builder $query): Builder
    {
        return $query->where('is_active', false);
    }

    /**
     * Scope para buscar por código de empleado.
     */
    public function scopeByEmployeeCode(Builder $query, string $code): Builder
    {
        return $query->where('employee_code', 'like', "%{$code}%");
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
     * Obtener el nombre completo de la secretaria.
     */
    public function getFullNameAttribute(): string
    {
        return $this->user->full_name;
    }

    /**
     * Obtener el email de la secretaria.
     */
    public function getEmailAttribute(): ?string
    {
        return $this->user->email;
    }

    /**
     * Obtener el teléfono de la secretaria.
     */
    public function getPhoneAttribute(): ?string
    {
        return $this->user->phone;
    }

    /**
     * Obtener los años de servicio de la secretaria.
     */
    public function getYearsOfServiceAttribute(): int
    {
        return $this->hire_date->diffInYears(now());
    }

    /**
     * Obtener el tiempo de servicio formateado.
     */
    public function getServiceTimeAttribute(): string
    {
        $years = $this->years_of_service;
        $months = $this->hire_date->diffInMonths(now()) % 12;
        
        if ($years > 0 && $months > 0) {
            return "{$years} año(s) y {$months} mes(es)";
        } elseif ($years > 0) {
            return "{$years} año(s)";
        } elseif ($months > 0) {
            return "{$months} mes(es)";
        } else {
            return "Menos de 1 mes";
        }
    }

    /**
     * Obtener el número de pagos validados por esta secretaria.
     */
    public function getValidatedPaymentsCountAttribute(): int
    {
        return $this->validatedPayments()->count();
    }

    /**
     * Obtener el número de pagos validados este mes.
     */
    public function getThisMonthValidationsAttribute(): int
    {
        return $this->validatedPayments()
            ->whereMonth('validated_at', now()->month)
            ->whereYear('validated_at', now()->year)
            ->count();
    }

    /**
     * Obtener el número de pagos validados esta semana.
     */
    public function getThisWeekValidationsAttribute(): int
    {
        return $this->validatedPayments()
            ->whereBetween('validated_at', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ])
            ->count();
    }

    /**
     * Obtener el número de pagos rechazados por esta secretaria.
     */
    public function getRejectedPaymentsCountAttribute(): int
    {
        return $this->validatedPayments()
            ->where('status', 'rechazado')
            ->count();
    }

    /**
     * Obtener el porcentaje de pagos validados exitosamente.
     */
    public function getValidationSuccessRateAttribute(): float
    {
        $total = $this->validated_payments_count;
        if ($total === 0) {
            return 0;
        }
        
        $rejected = $this->rejected_payments_count;
        $successful = $total - $rejected;
        
        return round(($successful / $total) * 100, 2);
    }

    /**
     * Verificar si la secretaria es nueva (menos de 1 año).
     */
    public function isNew(): bool
    {
        return $this->years_of_service < 1;
    }

    /**
     * Verificar si la secretaria es experimentada (más de 5 años).
     */
    public function isExperienced(): bool
    {
        return $this->years_of_service >= 5;
    }

    /**
     * Verificar si la secretaria ha validado pagos este mes.
     */
    public function hasValidatedThisMonth(): bool
    {
        return $this->this_month_validations > 0;
    }

    /**
     * Verificar si la secretaria ha validado pagos esta semana.
     */
    public function hasValidatedThisWeek(): bool
    {
        return $this->this_week_validations > 0;
    }

    /**
     * Obtener el nivel de experiencia en texto.
     */
    public function getExperienceLevelAttribute(): string
    {
        if ($this->years_of_service >= 10) {
            return 'Muy Experimentada';
        } elseif ($this->years_of_service >= 5) {
            return 'Experimentada';
        } elseif ($this->years_of_service >= 2) {
            return 'Intermedia';
        } elseif ($this->years_of_service >= 1) {
            return 'Principiante';
        } else {
            return 'Nueva';
        }
    }

    /**
     * Boot del modelo.
     */
    protected static function boot()
    {
        parent::boot();

        // Evento antes de crear
        static::creating(function ($secretary) {
            if (!isset($secretary->is_active)) {
                $secretary->is_active = true;
            }
            if (!isset($secretary->hire_date)) {
                $secretary->hire_date = now();
            }
        });
    }
} 