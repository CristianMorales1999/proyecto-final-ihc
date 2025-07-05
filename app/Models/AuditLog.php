<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

/**
 * Modelo AuditLog - Logs de Auditoría
 * 
 * Este modelo registra todas las acciones realizadas en el sistema
 * para mantener un historial de auditoría completo.
 * 
 * @property int $id
 * @property int $user_id
 * @property string $action Acción realizada
 * @property string $table_name Nombre de la tabla afectada
 * @property int $record_id ID del registro afectado
 * @property array|null $changes Cambios realizados (JSON)
 * @property string|null $ip_address Dirección IP del usuario
 * @property string|null $user_agent User agent del navegador
 * @property \Carbon\Carbon $created_at
 * 
 * @property-read \App\Models\User $user
 */
class AuditLog extends Model
{
    use HasFactory;

    /**
     * Indica si el modelo debe ser timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'action',
        'table_name',
        'record_id',
        'changes',
        'ip_address',
        'user_agent',
        'created_at'
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'changes' => 'array',
        'created_at' => 'datetime',
    ];

    /**
     * Obtener el usuario que realizó la acción.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope para filtrar por usuario.
     */
    public function scopeByUser(Builder $query, int $userId): Builder
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope para filtrar por acción.
     */
    public function scopeByAction(Builder $query, string $action): Builder
    {
        return $query->where('action', $action);
    }

    /**
     * Scope para filtrar por tabla.
     */
    public function scopeByTable(Builder $query, string $tableName): Builder
    {
        return $query->where('table_name', $tableName);
    }

    /**
     * Scope para filtrar por registro específico.
     */
    public function scopeByRecord(Builder $query, string $tableName, int $recordId): Builder
    {
        return $query->where('table_name', $tableName)
                    ->where('record_id', $recordId);
    }

    /**
     * Scope para filtrar por fecha.
     */
    public function scopeByDate(Builder $query, string $date): Builder
    {
        return $query->whereDate('created_at', $date);
    }

    /**
     * Scope para filtrar por rango de fechas.
     */
    public function scopeByDateRange(Builder $query, string $startDate, string $endDate): Builder
    {
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }

    /**
     * Scope para filtrar logs de hoy.
     */
    public function scopeToday(Builder $query): Builder
    {
        return $query->whereDate('created_at', now()->toDateString());
    }

    /**
     * Scope para filtrar logs de esta semana.
     */
    public function scopeThisWeek(Builder $query): Builder
    {
        return $query->whereBetween('created_at', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ]);
    }

    /**
     * Scope para filtrar logs de este mes.
     */
    public function scopeThisMonth(Builder $query): Builder
    {
        return $query->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year);
    }

    /**
     * Scope para filtrar por dirección IP.
     */
    public function scopeByIpAddress(Builder $query, string $ipAddress): Builder
    {
        return $query->where('ip_address', $ipAddress);
    }

    /**
     * Obtener el nombre del usuario.
     */
    public function getUserNameAttribute(): string
    {
        return $this->user->full_name;
    }

    /**
     * Obtener el email del usuario.
     */
    public function getUserEmailAttribute(): ?string
    {
        return $this->user->email;
    }

    /**
     * Obtener el rol del usuario.
     */
    public function getUserRoleAttribute(): string
    {
        return $this->user->role->display_name;
    }

    /**
     * Obtener la acción en español.
     */
    public function getActionDisplayAttribute(): string
    {
        $actions = [
            'create' => 'Crear',
            'update' => 'Actualizar',
            'delete' => 'Eliminar',
            'login' => 'Iniciar Sesión',
            'logout' => 'Cerrar Sesión',
            'password_change' => 'Cambio de Contraseña',
            'profile_update' => 'Actualización de Perfil',
            'payment_validation' => 'Validación de Pago',
            'appointment_creation' => 'Creación de Cita',
            'appointment_cancellation' => 'Cancelación de Cita',
            'medical_record_update' => 'Actualización de Historial',
        ];
        
        return $actions[$this->action] ?? ucfirst($this->action);
    }

    /**
     * Obtener el nombre de la tabla en español.
     */
    public function getTableDisplayAttribute(): string
    {
        $tables = [
            'users' => 'Usuarios',
            'patients' => 'Pacientes',
            'doctors' => 'Doctores',
            'secretaries' => 'Secretarias',
            'appointments' => 'Citas',
            'payments' => 'Pagos',
            'medical_records' => 'Historiales Médicos',
            'medical_record_details' => 'Detalles Médicos',
            'schedules' => 'Horarios',
            'specialties' => 'Especialidades',
            'roles' => 'Roles',
            'profiles' => 'Perfiles',
        ];
        
        return $tables[$this->table_name] ?? ucfirst($this->table_name);
    }

    /**
     * Obtener la fecha formateada.
     */
    public function getDateDisplayAttribute(): string
    {
        return $this->created_at->format('d/m/Y H:i:s');
    }

    /**
     * Obtener la fecha sin hora.
     */
    public function getDateOnlyAttribute(): string
    {
        return $this->created_at->format('d/m/Y');
    }

    /**
     * Obtener la hora.
     */
    public function getTimeOnlyAttribute(): string
    {
        return $this->created_at->format('H:i:s');
    }

    /**
     * Obtener el tiempo transcurrido desde la acción.
     */
    public function getTimeAgoAttribute(): string
    {
        return $this->created_at->diffForHumans();
    }

    /**
     * Obtener el color de la acción para la interfaz.
     */
    public function getActionColorAttribute(): string
    {
        $colors = [
            'create' => 'green',
            'update' => 'blue',
            'delete' => 'red',
            'login' => 'purple',
            'logout' => 'gray',
            'password_change' => 'orange',
            'profile_update' => 'cyan',
            'payment_validation' => 'teal',
            'appointment_creation' => 'indigo',
            'appointment_cancellation' => 'pink',
            'medical_record_update' => 'amber',
        ];
        
        return $colors[$this->action] ?? 'gray';
    }

    /**
     * Verificar si la acción es de creación.
     */
    public function isCreateAction(): bool
    {
        return $this->action === 'create';
    }

    /**
     * Verificar si la acción es de actualización.
     */
    public function isUpdateAction(): bool
    {
        return $this->action === 'update';
    }

    /**
     * Verificar si la acción es de eliminación.
     */
    public function isDeleteAction(): bool
    {
        return $this->action === 'delete';
    }

    /**
     * Verificar si la acción es de autenticación.
     */
    public function isAuthAction(): bool
    {
        return in_array($this->action, ['login', 'logout', 'password_change']);
    }

    /**
     * Verificar si la acción es de gestión de citas.
     */
    public function isAppointmentAction(): bool
    {
        return in_array($this->action, ['appointment_creation', 'appointment_cancellation']);
    }

    /**
     * Verificar si la acción es de gestión de pagos.
     */
    public function isPaymentAction(): bool
    {
        return in_array($this->action, ['payment_validation']);
    }

    /**
     * Verificar si la acción es de gestión médica.
     */
    public function isMedicalAction(): bool
    {
        return in_array($this->action, ['medical_record_update']);
    }

    /**
     * Obtener el resumen de cambios.
     */
    public function getChangesSummaryAttribute(): ?string
    {
        if (!$this->changes) {
            return null;
        }

        $summary = [];
        
        if (isset($this->changes['old']) && isset($this->changes['new'])) {
            foreach ($this->changes['new'] as $field => $newValue) {
                $oldValue = $this->changes['old'][$field] ?? null;
                if ($oldValue !== $newValue) {
                    $summary[] = "{$field}: {$oldValue} → {$newValue}";
                }
            }
        }

        return implode(', ', $summary);
    }

    /**
     * Obtener el número de campos modificados.
     */
    public function getModifiedFieldsCountAttribute(): int
    {
        if (!$this->changes || !isset($this->changes['old']) || !isset($this->changes['new'])) {
            return 0;
        }

        $count = 0;
        foreach ($this->changes['new'] as $field => $newValue) {
            $oldValue = $this->changes['old'][$field] ?? null;
            if ($oldValue !== $newValue) {
                $count++;
            }
        }

        return $count;
    }

    /**
     * Verificar si tiene cambios registrados.
     */
    public function hasChangesRecorded(): bool
    {
        return !empty($this->changes);
    }

    /**
     * Obtener el mensaje descriptivo de la acción.
     */
    public function getActionMessageAttribute(): string
    {
        $userName = $this->user_name;
        $action = $this->action_display;
        $table = $this->table_display;
        $date = $this->date_display;

        return "{$userName} {$action} en {$table} el {$date}";
    }

    /**
     * Boot del modelo.
     */
    protected static function boot()
    {
        parent::boot();

        // Evento antes de crear
        static::creating(function ($log) {
            if (!isset($log->created_at)) {
                $log->created_at = now();
            }
        });
    }
} 