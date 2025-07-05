# Cambios en Métodos de Pago - Sistema de Gestión Médica

## Resumen de Modificaciones

Se han actualizado los métodos de pago del sistema para reflejar el flujo real de negocio, incluyendo tres tipos principales de pago con sus respectivos flujos y validaciones.

## Cambios Realizados

### 1. Migración de Pagos (`2025_01_01_000011_create_payments_table.php`)

#### Campos Agregados:
- `payment_deadline` (DATE, nullable): Fecha límite para pago en clínica
- `card_number` (VARCHAR(20), nullable): Número de tarjeta (últimos 4 dígitos)
- `card_expiry` (VARCHAR(5), nullable): Fecha de expiración (MM/AA)
- `card_cvv` (VARCHAR(4), nullable): CVV de la tarjeta

#### ENUMs Actualizados:
- **Métodos de Pago**: `['transferencia', 'yape', 'plin', 'clinica', 'tarjeta']`
- **Estados de Pago**: `['pendiente', 'validado', 'rechazado', 'reembolsado', 'pre_reserva']`

### 2. Seeder de Citas (`AppointmentsSeeder.php`)

#### Nuevos Métodos Agregados:
- `getPaymentStatus($method)`: Determina el estado según el método de pago
- `getPaymentDeadline($appointmentDate)`: Calcula fecha límite (2 días antes)
- `getRandomCardData()`: Genera datos de tarjeta simulados

#### Lógica de Creación de Pagos:
- **Transferencia/Yape/Plin**: Estado `pendiente`, requiere validación
- **Clínica**: Estado `pre_reserva`, con fecha límite
- **Tarjeta**: Estado `validado`, con datos simulados

### 3. Documentación Actualizada

#### `DATABASE_STRUCTURE.md`:
- Descripción detallada de los nuevos campos
- Explicación de los métodos de pago
- Índices optimizados para filtros

#### `database/seeders/README.md`:
- Flujo de pagos por método
- Estados de pago explicados
- Características de cada método

## Métodos de Pago Implementados

### 1. Transferencia / Yape / Plin
**Flujo**:
1. Usuario selecciona método
2. Sube comprobante de pago
3. Secretaria valida el comprobante
4. Estado cambia a `validado` o `rechazado`

**Características**:
- Estado inicial: `pendiente`
- Requiere campo `image_path` para comprobante
- Validación manual por secretaria

### 2. Pago en Clínica
**Flujo**:
1. Usuario selecciona "Pago en Clínica"
2. Sistema muestra mensaje de pre-reserva
3. Fecha límite: 2 días antes de la cita
4. Pago presencial en clínica

**Características**:
- Estado inicial: `pre_reserva`
- Campo `payment_deadline` con fecha límite
- Mensaje: "Su cita quedará pre-reservada. Complete el pago en la clínica hasta [fecha] para confirmar."

### 3. Pago en Línea (Simulado)
**Flujo**:
1. Usuario selecciona "Pago en Línea"
2. Ingresa datos de tarjeta (número, expiración, CVV)
3. Sistema simula procesamiento
4. Estado inmediato: `validado`

**Características**:
- Estado inicial: `validado` (simulado)
- Campos: `card_number`, `card_expiry`, `card_cvv`
- Sin pasarela de pago real
- Datos simulados en seeders

## Estados de Pago

| Estado | Descripción | Métodos Aplicables |
|--------|-------------|-------------------|
| `pendiente` | Esperando validación | Transferencia, Yape, Plin |
| `pre_reserva` | Pre-reserva con pago pendiente | Clínica |
| `validado` | Pago confirmado | Todos (después de validación) |
| `rechazado` | Comprobante rechazado | Transferencia, Yape, Plin |
| `reembolsado` | Pago devuelto | Todos |

## Campos Específicos por Método

### Transferencia/Yape/Plin
- `image_path`: Ruta del comprobante
- `status`: `pendiente` → `validado`/`rechazado`

### Clínica
- `payment_deadline`: Fecha límite de pago
- `status`: `pre_reserva` → `validado`

### Tarjeta
- `card_number`: Número de tarjeta (últimos 4 dígitos)
- `card_expiry`: Fecha de expiración (MM/AA)
- `card_cvv`: CVV
- `status`: `validado` (inmediato)

## Consideraciones de Seguridad

### Datos de Tarjeta
- Solo se almacenan los últimos 4 dígitos
- Fecha de expiración en formato MM/AA
- CVV no se almacena en producción real
- Datos simulados solo para desarrollo

### Validaciones
- Fecha límite automática para pagos en clínica
- Estados coherentes con el método de pago
- Auditoría de validaciones por secretaria

## Próximos Pasos

1. **Implementar interfaz de usuario** para cada método de pago
2. **Crear validaciones** de comprobantes por secretaria
3. **Implementar notificaciones** de fecha límite
4. **Agregar reportes** de pagos por método
5. **Considerar integración** con pasarela de pago real (futuro)

## Comandos para Aplicar Cambios

```bash
# Ejecutar migraciones
php artisan migrate:fresh

# Ejecutar seeders con nuevos métodos de pago
php artisan db:seed

# Verificar datos generados
php artisan tinker
>>> App\Models\Payment::with('appointment')->get()->pluck('payment_method', 'status');
```

## Notas Importantes

- Los cambios son **compatibles hacia atrás** con la estructura existente
- Los seeders generan datos **realistas** para cada método de pago
- La documentación está **completamente actualizada**
- Los índices están **optimizados** para consultas frecuentes
- El sistema está **listo para desarrollo** y pruebas 