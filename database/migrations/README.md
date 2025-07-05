# Migraciones de Base de Datos - Sistema de Gestión Médica

## Descripción

Este directorio contiene todas las migraciones necesarias para crear la estructura de base de datos del sistema de gestión médica. Las migraciones están organizadas en orden de dependencias para garantizar una ejecución correcta.

## Orden de Ejecución

Las migraciones deben ejecutarse en el siguiente orden:

1. `2025_01_01_000001_create_roles_table.php` - Roles del sistema
2. `0001_01_01_000000_create_users_table.php` - Usuarios (actualizada)
3. `2025_01_01_000002_create_profiles_table.php` - Perfiles de usuario
4. `2025_01_01_000003_create_specialties_table.php` - Especialidades médicas
5. `2025_01_01_000004_create_doctors_table.php` - Doctores
6. `2025_01_01_000005_create_secretaries_table.php` - Secretarias
7. `2025_01_01_000006_create_patients_table.php` - Pacientes
8. `2025_01_01_000007_create_medical_records_table.php` - Historiales médicos
9. `2025_01_01_000008_create_schedules_table.php` - Horarios de doctores
10. `2025_01_01_000009_create_appointments_table.php` - Citas médicas
11. `2025_01_01_000010_create_medical_record_details_table.php` - Detalles de historial
12. `2025_01_01_000011_create_payments_table.php` - Pagos
13. `2025_01_01_000012_create_audit_logs_table.php` - Logs de auditoría

## Comandos de Ejecución

### Ejecutar todas las migraciones
```bash
php artisan migrate
```

### Ejecutar migraciones específicas
```bash
php artisan migrate --path=database/migrations/2025_01_01_000001_create_roles_table.php
```

### Revertir migraciones
```bash
php artisan migrate:rollback
```

### Revertir y volver a ejecutar
```bash
php artisan migrate:refresh
```

### Ejecutar con seeders
```bash
php artisan migrate --seed
```

## Características Implementadas

### ✅ Mejoras de Rendimiento
- **Índices optimizados** en campos de búsqueda frecuente
- **Índices compuestos** para consultas complejas
- **Índices únicos** para evitar duplicados

### ✅ Integridad Referencial
- **ON DELETE CASCADE** para relaciones padre-hijo
- **ON DELETE RESTRICT** para relaciones críticas
- **ON UPDATE CASCADE** para mantener consistencia

### ✅ Soft Deletes
- Implementado en todas las tablas principales
- Permite recuperación de datos eliminados
- Mantiene integridad referencial

### ✅ Validaciones
- **ENUM** para valores predefinidos
- **UNIQUE** para campos únicos
- **NULLABLE** para campos opcionales

### ✅ Auditoría
- Logs completos de todas las acciones
- Seguimiento de cambios (valores anteriores y nuevos)
- Información de contexto (IP, user agent, sesión)

## Estructura de Datos

### Roles Disponibles
- `admin` - Administrador del sistema
- `doctor` - Médico especialista
- `secretary` - Secretaria administrativa
- `patient` - Paciente

### Estados de Citas
- `scheduled` - Programada
- `confirmed` - Confirmada
- `in_progress` - En progreso
- `completed` - Completada
- `cancelled` - Cancelada
- `no_show` - No se presentó

### Estados de Pagos
- `pending` - Pendiente
- `validated` - Validado
- `rejected` - Rechazado
- `refunded` - Reembolsado

### Métodos de Pago
- `yape` - Yape
- `plin` - Plin
- `transfer` - Transferencia bancaria
- `cash` - Efectivo
- `card` - Tarjeta

## Consideraciones Importantes

### 1. Backup Antes de Ejecutar
```bash
# Crear backup de la base de datos actual
mysqldump -u username -p database_name > backup_before_migration.sql
```

### 2. Verificar Dependencias
- Asegurarse de que todas las tablas base existan antes de crear las dependientes
- Verificar que las claves foráneas apunten a tablas existentes

### 3. Datos de Prueba
- Las migraciones solo crean la estructura
- Usar seeders para datos de prueba
- Verificar integridad de datos después de la migración

### 4. Rendimiento
- Las migraciones incluyen índices optimizados
- Considerar el impacto en tablas grandes
- Monitorear el tiempo de ejecución

## Troubleshooting

### Error de Clave Foránea
```bash
# Verificar que las tablas base existan
php artisan migrate:status

# Ejecutar migraciones faltantes
php artisan migrate --force
```

### Error de Índice Duplicado
```bash
# Limpiar cache de migraciones
php artisan config:clear
php artisan cache:clear

# Revertir y volver a ejecutar
php artisan migrate:rollback
php artisan migrate
```

### Error de Permisos
```bash
# Verificar permisos de escritura
chmod -R 755 database/migrations/

# Ejecutar como administrador si es necesario
sudo php artisan migrate
```

## Documentación Adicional

Para más detalles sobre la estructura de la base de datos, consultar:
- `DATABASE_STRUCTURE.md` - Documentación completa de la estructura
- `../seeders/` - Datos de prueba y configuración inicial
- `../factories/` - Generadores de datos de prueba

## Soporte

En caso de problemas con las migraciones:
1. Verificar logs en `storage/logs/laravel.log`
2. Revisar la documentación de Laravel sobre migraciones
3. Consultar el archivo `DATABASE_STRUCTURE.md` para entender las relaciones 