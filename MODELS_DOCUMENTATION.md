# Documentación de Modelos - Sistema de Gestión Médica

## Resumen General

Se han creado 12 modelos completamente documentados y optimizados para el sistema de gestión médica, todos alineados con las migraciones y seeders existentes. Cada modelo incluye:

- **Documentación completa** con PHPDoc
- **Relaciones Eloquent** optimizadas
- **Scopes de consulta** útiles
- **Accessors y Mutators** para formateo
- **Métodos de utilidad** específicos del dominio
- **Soft Deletes** donde corresponde
- **Validaciones** y eventos automáticos

## Modelos Implementados

### 1. **User** - Usuarios del Sistema
**Archivo**: `app/Models/User.php`

**Propósito**: Modelo principal de autenticación que maneja todos los usuarios del sistema.

**Características principales**:
- Extiende `Authenticatable` para autenticación Laravel
- Soft deletes para mantener historial
- Relaciones con todos los roles (admin, doctor, secretaria, paciente)
- Métodos de verificación de roles (`isAdmin()`, `isDoctor()`, etc.)
- Accessors para nombre completo, email y teléfono
- Scopes para filtrar por estado y rol

**Relaciones**:
- `role()` - BelongsTo con Role
- `profile()` - HasOne con Profile
- `doctor()`, `patient()`, `secretary()` - HasOne condicionales
- `uploadedPayments()`, `validatedPayments()` - HasMany con Payment
- `auditLogs()` - HasMany con AuditLog

**Métodos destacados**:
```php
$user->hasRole('admin')           // Verificar rol específico
$user->isAdmin()                  // Verificar si es administrador
$user->full_name                  // Obtener nombre completo
User::active()->byRole('doctor')  // Scope para doctores activos
```

---

### 2. **Role** - Roles del Sistema
**Archivo**: `app/Models/Role.php`

**Propósito**: Define los diferentes roles que pueden tener los usuarios.

**Características principales**:
- Soft deletes
- Descripción detallada de cada rol
- Estado activo/inactivo
- Métodos de verificación de tipo de rol
- Accessor para nombre en español

**Relaciones**:
- `users()` - HasMany con User

**Métodos destacados**:
```php
$role->isAdmin()                  // Verificar si es rol admin
$role->display_name               // Nombre en español
Role::active()->byName('doctor')  // Scope para roles activos
```

---

### 3. **Profile** - Perfiles de Usuario
**Archivo**: `app/Models/Profile.php`

**Propósito**: Almacena información personal detallada de cada usuario.

**Características principales**:
- Soft deletes
- Información personal completa (nombre, email, teléfono, dirección)
- Datos demográficos (género, estado civil, fecha de nacimiento)
- Ubicación geográfica (región, provincia, distrito)
- Capitalización automática de nombres y ubicación
- Cálculo automático de edad

**Relaciones**:
- `user()` - BelongsTo con User

**Métodos destacados**:
```php
$profile->full_name               // Nombre completo
$profile->age                     // Edad calculada
$profile->full_address            // Dirección completa
$profile->isAdult()               // Verificar si es mayor de edad
Profile::byGender('M')->byRegion('Lima')  // Scopes de filtrado
```

---

### 4. **Specialty** - Especialidades Médicas
**Archivo**: `app/Models/Specialty.php`

**Propósito**: Define las especialidades médicas disponibles en el sistema.

**Características principales**:
- Soft deletes
- Descripción detallada de cada especialidad
- Estado activo/inactivo
- Estadísticas de doctores por especialidad
- Análisis de tarifas (promedio, mínimo, máximo)

**Relaciones**:
- `doctors()` - HasMany con Doctor

**Métodos destacados**:
```php
$specialty->display_name          // Nombre en español
$specialty->doctors_count         // Número de doctores
$specialty->average_consultation_fee  // Tarifa promedio
$specialty->hasActiveDoctors()    // Verificar si tiene doctores activos
Specialty::active()->searchByName('cardio')  // Búsqueda
```

---

### 5. **Doctor** - Doctores del Sistema
**Archivo**: `app/Models/Doctor.php`

**Propósito**: Almacena información específica de los doctores.

**Características principales**:
- Soft deletes
- Información profesional (licencia, experiencia, biografía)
- Tarifa de consulta
- Estado de disponibilidad
- Estadísticas de citas y rendimiento
- Nivel de experiencia calculado

**Relaciones**:
- `user()` - BelongsTo con User
- `specialty()` - BelongsTo con Specialty
- `schedules()` - HasMany con Schedule
- `appointments()` - HasMany con Appointment
- `medicalRecordDetails()` - HasMany con MedicalRecordDetail

**Métodos destacados**:
```php
$doctor->full_name                // Nombre completo
$doctor->experience_level         // Nivel de experiencia
$doctor->completion_rate          // Porcentaje de citas completadas
$doctor->hasSchedules()           // Verificar si tiene horarios
Doctor::available()->bySpecialty(1)->minExperience(5)  // Filtros
```

---

### 6. **Secretary** - Secretarias del Sistema
**Archivo**: `app/Models/Secretary.php`

**Propósito**: Almacena información específica de las secretarias.

**Características principales**:
- Soft deletes
- Código de empleado único
- Fecha de contratación
- Estadísticas de validación de pagos
- Análisis de rendimiento y experiencia

**Relaciones**:
- `user()` - BelongsTo con User
- `validatedPayments()` - HasMany con Payment

**Métodos destacados**:
```php
$secretary->years_of_service      // Años de servicio
$secretary->validation_success_rate  // Porcentaje de éxito
$secretary->this_month_validations   // Validaciones del mes
$secretary->isExperienced()       // Verificar si es experimentada
Secretary::active()->byEmployeeCode('SEC001')  // Búsqueda
```

---

### 7. **Patient** - Pacientes del Sistema
**Archivo**: `app/Models/Patient.php`

**Propósito**: Almacena información médica específica de los pacientes.

**Características principales**:
- Soft deletes
- Información médica (tipo de sangre, alergias, condiciones)
- Medicamentos regulares
- Historial médico familiar
- Contacto de emergencia
- Estadísticas de citas y frecuencia

**Relaciones**:
- `user()` - BelongsTo con User
- `medicalRecord()` - HasOne con MedicalRecord
- `appointments()` - HasMany con Appointment

**Métodos destacados**:
```php
$patient->health_status           // Estado de salud
$patient->allergies_array         // Alergias como array
$patient->isFrequent()            // Verificar si es frecuente
$patient->next_appointment        // Próxima cita
Patient::withAllergies()->byBloodType('A+')  // Filtros médicos
```

---

### 8. **Schedule** - Horarios de Doctores
**Archivo**: `app/Models/Schedule.php`

**Propósito**: Define los horarios de atención de cada doctor.

**Características principales**:
- Soft deletes
- Configuración de citas (duración, máximo)
- Estado activo/inactivo
- Cálculo de disponibilidad y ocupación
- Generación automática de horas disponibles

**Relaciones**:
- `doctor()` - BelongsTo con Doctor
- `appointments()` - HasMany con Appointment

**Métodos destacados**:
```php
$schedule->time_range             // Horario formateado
$schedule->available_slots        // Citas disponibles
$schedule->occupancy_rate         // Porcentaje de ocupación
$schedule->free_hours             // Horas libres
$schedule->isHourAvailable('09:00')  // Verificar disponibilidad
Schedule::active()->byDay('lunes')->morning()  // Filtros
```

---

### 9. **Appointment** - Citas Médicas
**Archivo**: `app/Models/Appointment.php`

**Propósito**: Almacena todas las citas programadas en el sistema.

**Características principales**:
- Soft deletes
- Información completa de la cita (fecha, hora, motivo)
- Estado de la cita (programada, confirmada, completada, cancelada)
- Tarifa de consulta
- Fechas de confirmación y completado
- Análisis de tiempo restante

**Relaciones**:
- `patient()` - BelongsTo con Patient
- `doctor()` - BelongsTo con Doctor
- `schedule()` - BelongsTo con Schedule
- `payment()` - HasOne con Payment
- `medicalRecordDetail()` - HasOne con MedicalRecordDetail

**Métodos destacados**:
```php
$appointment->date_time           // Fecha y hora formateada
$appointment->time_until          // Tiempo restante
$appointment->payment_status      // Estado del pago
$appointment->isFuture()          // Verificar si es futura
Appointment::scheduled()->future()->byDoctor(1)  // Filtros
```

---

### 10. **Payment** - Pagos de Citas
**Archivo**: `app/Models/Payment.php`

**Propósito**: Almacena los pagos realizados por las consultas.

**Características principales**:
- Soft deletes
- Múltiples métodos de pago (transferencia, yape, plin, clínica, tarjeta)
- Estados de validación (pendiente, validado, rechazado, pre-reserva)
- Datos de tarjeta para pagos en línea
- Fecha límite para pagos en clínica
- Auditoría de subida y validación

**Relaciones**:
- `appointment()` - BelongsTo con Appointment
- `uploader()` - BelongsTo con User (quien subió)
- `validator()` - BelongsTo con User (quien validó)

**Métodos destacados**:
```php
$payment->payment_method_display  // Método en español
$payment->status_message          // Mensaje de estado
$payment->time_until_deadline     // Tiempo hasta fecha límite
$payment->requiresReceipt()       // Verificar si requiere comprobante
Payment::pending()->byMethod('transferencia')  // Filtros
```

---

### 11. **MedicalRecord** - Historiales Médicos
**Archivo**: `app/Models/MedicalRecord.php`

**Propósito**: Almacena el historial médico principal de cada paciente.

**Características principales**:
- Soft deletes
- Número de historial único
- Notas generales
- Estadísticas de consultas
- Análisis de frecuencia y tiempo transcurrido

**Relaciones**:
- `patient()` - BelongsTo con Patient
- `details()` - HasMany con MedicalRecordDetail

**Métodos destacados**:
```php
$record->total_consultations      // Total de consultas
$record->time_since_last_consultation  // Tiempo desde última consulta
$record->patient_risk_level       // Nivel de riesgo del paciente
$record->isFrequentPatient()      // Verificar si es frecuente
MedicalRecord::active()->byPatient(1)  // Filtros
```

---

### 12. **MedicalRecordDetail** - Detalles del Historial Médico
**Archivo**: `app/Models/MedicalRecordDetail.php`

**Propósito**: Almacena los detalles específicos de cada consulta médica.

**Características principales**:
- Soft deletes
- Información clínica completa (síntomas, diagnóstico, tratamiento)
- Signos vitales (peso, altura, presión arterial, frecuencia cardíaca, temperatura)
- Cálculo automático de IMC y categorías médicas
- Nivel de completitud de la consulta
- Validaciones de rangos médicos

**Relaciones**:
- `medicalRecord()` - BelongsTo con MedicalRecord
- `appointment()` - BelongsTo con Appointment
- `doctor()` - BelongsTo con Doctor

**Métodos destacados**:
```php
$detail->bmi                      // Índice de masa corporal
$detail->blood_pressure           // Presión arterial formateada
$detail->completeness_level       // Nivel de completitud
$detail->hasSymptoms()            // Verificar si tiene síntomas
MedicalRecordDetail::thisMonth()->byDoctor(1)  // Filtros
```

---

### 13. **AuditLog** - Logs de Auditoría
**Archivo**: `app/Models/AuditLog.php`

**Propósito**: Registra todas las acciones realizadas en el sistema.

**Características principales**:
- Sin timestamps (solo created_at)
- Registro completo de cambios (antes/después)
- Información de contexto (IP, user agent)
- Categorización de acciones
- Análisis de cambios realizados

**Relaciones**:
- `user()` - BelongsTo con User

**Métodos destacados**:
```php
$log->action_display              // Acción en español
$log->changes_summary             // Resumen de cambios
$log->time_ago                    // Tiempo transcurrido
$log->isCreateAction()            // Verificar tipo de acción
AuditLog::today()->byUser(1)->byAction('create')  // Filtros
```

## Características Comunes

### Soft Deletes
Todos los modelos principales implementan soft deletes para mantener integridad referencial y permitir recuperación de datos.

### Documentación PHPDoc
Cada modelo incluye documentación completa con:
- Descripción del propósito
- Propiedades con tipos y descripciones
- Relaciones documentadas
- Métodos con tipos de retorno

### Scopes de Consulta
Múltiples scopes para facilitar consultas comunes:
- Filtros por estado (`active()`, `inactive()`)
- Filtros por fecha (`today()`, `thisWeek()`, `thisMonth()`)
- Búsquedas (`searchByName()`, `byRole()`)
- Filtros específicos del dominio

### Accessors y Mutators
Accessors para formateo automático:
- Nombres en español
- Fechas formateadas
- Montos con formato de moneda
- Estados con colores para UI

### Eventos Automáticos
Eventos que se ejecutan automáticamente:
- Validaciones antes de guardar
- Capitalización de nombres
- Generación de códigos únicos
- Cálculos automáticos

### Métodos de Utilidad
Métodos específicos del dominio médico:
- Cálculo de IMC y categorías
- Análisis de presión arterial
- Verificación de disponibilidad
- Estadísticas de rendimiento

## Uso Recomendado

### Consultas Básicas
```php
// Obtener doctores activos de cardiología
$doctors = Doctor::active()->bySpecialty(1)->get();

// Obtener citas pendientes de hoy
$appointments = Appointment::scheduled()->today()->get();

// Obtener pagos pendientes de validación
$payments = Payment::pending()->withReceipt()->get();
```

### Relaciones Eager Loading
```php
// Cargar relaciones necesarias
$appointments = Appointment::with(['patient.user.profile', 'doctor.user.profile', 'payment'])->get();

// Cargar con condiciones
$doctors = Doctor::with(['user.profile', 'specialty', 'schedules' => function($q) {
    $q->active();
}])->get();
```

### Scopes Personalizados
```php
// Filtrar pacientes con alergias en Lima
$patients = Patient::withAllergies()->whereHas('user.profile', function($q) {
    $q->byRegion('Lima');
})->get();

// Obtener horarios disponibles de mañana
$schedules = Schedule::active()->morning()->where('available_slots', '>', 0)->get();
```

### Accessors Automáticos
```php
// Los accessors se aplican automáticamente
echo $doctor->full_name;          // "Dr. Juan Pérez"
echo $payment->amount_display;     // "S/ 150.00"
echo $appointment->date_display;   // "15/01/2024"
```

## Conclusión

Los modelos implementados proporcionan una base sólida y completa para el sistema de gestión médica, con:

- **Funcionalidad completa** para todas las entidades del sistema
- **Optimización de consultas** con scopes y relaciones
- **Validaciones automáticas** y eventos
- **Documentación exhaustiva** para facilitar el mantenimiento
- **Flexibilidad** para futuras extensiones

Todos los modelos están completamente alineados con las migraciones y seeders existentes, garantizando consistencia en toda la aplicación. 