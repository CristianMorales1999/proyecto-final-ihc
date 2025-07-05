# Seeders de Base de Datos - Sistema de Gestión Médica

## Descripción

Este directorio contiene todos los seeders necesarios para poblar la base de datos del sistema de gestión médica con datos de prueba. Los seeders están organizados en orden de dependencias para garantizar una ejecución correcta.

## Seeders Disponibles

### 1. `RoleSeeder.php` - Roles del Sistema
**Propósito**: Crea los roles básicos del sistema (admin, doctor, paciente, secretaria)

**Datos creados**:
- 4 roles con descripciones detalladas
- Estado activo por defecto

### 2. `SpecialtiesSeeder.php` - Especialidades Médicas
**Propósito**: Crea las especialidades médicas disponibles

**Datos creados**:
- 8 especialidades médicas principales
- Descripciones detalladas de cada especialidad
- Estado activo por defecto

### 3. `AdminSeeder.php` - Usuario Administrador
**Propósito**: Crea el usuario administrador del sistema

**Datos creados**:
- Usuario con rol de administrador
- Perfil completo del administrador
- Credenciales: admin@gmail.com / admin123

### 4. `DoctorSeeder.php` - Doctores
**Propósito**: Crea usuarios doctores con sus perfiles y especialidades

**Datos creados**:
- 8 doctores (uno por especialidad)
- Perfiles completos con información realista
- Información profesional (licencia, experiencia, biografía)
- Tarifas de consulta diferenciadas
- Credenciales: doctor1@gmail.com / doctor1, etc.

### 5. `SecretariesSeeder.php` - Secretarias
**Propósito**: Crea usuarios secretarias con sus perfiles

**Datos creados**:
- 3 secretarias administrativas
- Perfiles completos con información realista
- Códigos de empleado únicos
- Fechas de contratación
- Credenciales: secretaria1@gmail.com / secretaria1, etc.

### 6. `PatientsSeeder.php` - Pacientes
**Propósito**: Crea usuarios pacientes con información médica

**Datos creados**:
- 10 pacientes con perfiles completos
- Información médica detallada (tipo de sangre, alergias, etc.)
- Historiales médicos iniciales
- Contactos de emergencia
- Credenciales: paciente1@gmail.com / paciente1, etc.

### 7. `ScheduleSeeder.php` - Horarios de Doctores
**Propósito**: Crea horarios de atención para todos los doctores

**Datos creados**:
- Horarios de lunes a viernes para cada doctor
- Horarios diferenciados por especialidad
- Duración de citas de 30 minutos
- Máximo 8 citas por horario

### 8. `AppointmentsSeeder.php` - Citas y Pagos
**Propósito**: Crea citas médicas, pagos y detalles de historial

**Datos creados**:
- Citas futuras programadas con pagos pendientes
- Citas pasadas completadas con pagos validados
- Detalles médicos completos para citas pasadas
- Información médica realista por especialidad

## Comandos de Ejecución

### Ejecutar todos los seeders
```bash
php artisan db:seed
```

### Ejecutar seeder específico
```bash
php artisan db:seed --class=RoleSeeder
php artisan db:seed --class=DoctorSeeder
php artisan db:seed --class=PatientsSeeder
```

### Ejecutar con migraciones
```bash
php artisan migrate:fresh --seed
```

### Ejecutar solo seeders (sin migrar)
```bash
php artisan db:seed --force
```

## Credenciales de Acceso

### Administrador
- **Email**: admin@gmail.com
- **Contraseña**: admin123
- **DNI**: 00000000

### Doctores
- **Doctor 1**: doctor1@gmail.com / doctor1
- **Doctor 2**: doctor2@gmail.com / doctor2
- **Doctor 3**: doctor3@gmail.com / doctor3
- **Doctor 4**: doctor4@gmail.com / doctor4
- **Doctor 5**: doctor5@gmail.com / doctor5
- **Doctor 6**: doctor6@gmail.com / doctor6
- **Doctor 7**: doctor7@gmail.com / doctor7
- **Doctor 8**: doctor8@gmail.com / doctor8

### Secretarias
- **Secretaria 1**: secretaria1@gmail.com / secretaria1
- **Secretaria 2**: secretaria2@gmail.com / secretaria2
- **Secretaria 3**: secretaria3@gmail.com / secretaria3

### Pacientes
- **Paciente 1**: paciente1@gmail.com / paciente1
- **Paciente 2**: paciente2@gmail.com / paciente2
- **Paciente 3**: paciente3@gmail.com / paciente3
- **Paciente 4**: paciente4@gmail.com / paciente4
- **Paciente 5**: paciente5@gmail.com / paciente5
- **Paciente 6**: paciente6@gmail.com / paciente6
- **Paciente 7**: paciente7@gmail.com / paciente7
- **Paciente 8**: paciente8@gmail.com / paciente8
- **Paciente 9**: paciente9@gmail.com / paciente9
- **Paciente 10**: paciente10@gmail.com / paciente10

## Datos Generados

### Especialidades Médicas
1. **Cardiología** - Enfermedades del corazón y sistema circulatorio
2. **Dermatología** - Enfermedades de la piel
3. **Ginecología** - Salud reproductiva femenina
4. **Pediatría** - Cuidado de niños y adolescentes
5. **Oftalmología** - Enfermedades de los ojos
6. **Neurología** - Enfermedades del sistema nervioso
7. **Psiquiatría** - Salud mental
8. **Traumatología** - Lesiones músculo-esqueléticas

### Información Médica de Pacientes
- **Tipos de sangre**: A+, A-, B+, B-, AB+, AB-, O+, O-
- **Alergias**: Penicilina, polvo, ácaros, sulfamidas, látex
- **Condiciones médicas**: Hipertensión, diabetes, asma, artritis, etc.
- **Medicamentos**: Medicamentos específicos por condición
- **Historial familiar**: Antecedentes médicos familiares

### Horarios de Atención
- **Lunes a Viernes**: 8:00 AM - 8:00 PM
- **Duración de citas**: 30 minutos
- **Máximo citas por horario**: 8
- **Horarios diferenciados** por especialidad

### Estados de Citas
- **Programada**: Citas futuras con pagos pendientes
- **Completada**: Citas pasadas con pagos validados y detalles médicos

### Flujo de Pagos por Método
1. **Transferencia/Yape/Plin**:
   - Estado inicial: `pendiente`
   - Requiere subir comprobante
   - Validación por secretaria
   - Estado final: `validado` o `rechazado`

2. **Pago en Clínica**:
   - Estado inicial: `pre_reserva`
   - Fecha límite: 2 días antes de la cita
   - Pago presencial en clínica
   - Estado final: `validado` (después del pago)

3. **Pago en Línea**:
   - Estado inicial: `validado` (simulado)
   - Datos de tarjeta simulados
   - Sin pasarela de pago real
   - Estado final: `validado` (inmediato)

### Métodos de Pago
- **Transferencia**: Transferencia bancaria (requiere comprobante)
- **Yape**: Pago móvil (requiere comprobante)
- **Plin**: Pago móvil (requiere comprobante)
- **Clínica**: Pago presencial (pre-reserva con fecha límite)
- **Tarjeta**: Pago en línea simulado (datos de tarjeta)

### Estados de Pago
- **Pendiente**: Transferencias, Yape y Plin (esperando validación)
- **Pre-reserva**: Pagos en clínica (esperando pago presencial)
- **Validado**: Pagos en línea y comprobantes validados
- **Rechazado**: Comprobantes rechazados por secretaria
- **Reembolsado**: Pagos devueltos

## Características de los Datos

### ✅ Realismo
- Nombres y apellidos peruanos
- Direcciones reales de Lima
- Información médica verosímil
- Horarios de atención realistas

### ✅ Variedad
- Diferentes tipos de usuarios
- Múltiples especialidades médicas
- Variedad en condiciones médicas
- Diferentes métodos de pago

### ✅ Integridad
- Relaciones entre entidades correctas
- Datos consistentes entre tablas
- Información médica coherente
- Horarios sin conflictos

### ✅ Funcionalidad
- Datos listos para pruebas
- Credenciales de acceso funcionales
- Información completa para demostración
- Casos de uso cubiertos

## Consideraciones Importantes

### 1. Orden de Ejecución
Los seeders deben ejecutarse en el orden correcto debido a las dependencias:
1. Roles → Especialidades → Admin → Doctores → Secretarias → Pacientes → Horarios → Citas

### 2. Datos Sensibles
- Los datos son ficticios para pruebas
- No contienen información médica real
- Las contraseñas son simples para desarrollo

### 3. Rendimiento
- Los seeders crean una cantidad moderada de datos
- Apropiado para desarrollo y pruebas
- No recomendado para producción

### 4. Personalización
- Los seeders pueden modificarse según necesidades
- Fácil agregar más datos o cambiar información
- Estructura modular para extensibilidad

## Troubleshooting

### Error de Dependencias
```bash
# Verificar que las migraciones se ejecutaron
php artisan migrate:status

# Ejecutar migraciones faltantes
php artisan migrate
```

### Error de Datos Duplicados
```bash
# Limpiar base de datos y volver a ejecutar
php artisan migrate:fresh --seed
```

### Error de Memoria
```bash
# Aumentar límite de memoria
php -d memory_limit=512M artisan db:seed
```

## Documentación Adicional

Para más detalles sobre la estructura de datos, consultar:
- `../migrations/README.md` - Documentación de migraciones
- `DATABASE_STRUCTURE.md` - Estructura completa de la base de datos
- `../factories/` - Generadores de datos de prueba

## Soporte

En caso de problemas con los seeders:
1. Verificar logs en `storage/logs/laravel.log`
2. Revisar que las migraciones se ejecutaron correctamente
3. Verificar que los modelos existen y están configurados
4. Consultar la documentación de Laravel sobre seeders 