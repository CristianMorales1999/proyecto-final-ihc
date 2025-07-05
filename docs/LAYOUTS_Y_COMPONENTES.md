# Layouts y Componentes - HealthPlus

## Estructura de Layouts

### 1. Layout Welcome (`resources/views/layouts/welcome.blade.php`)
- **Propósito**: Layout para la página de bienvenida (pública)
- **Características**:
  - Incluye header con navegación completa
  - Incluye footer
  - Diseño responsivo con Tailwind CSS
  - Soporte para Material Icons

### 2. Layout Dashboard (`resources/views/layouts/dashboard.blade.php`)
- **Propósito**: Layout para todas las páginas del dashboard
- **Características**:
  - Incluye header con navegación de usuario autenticado
  - Sin footer
  - Diseño responsivo con Tailwind CSS
  - Soporte para Material Icons

## Componentes

### 1. Header (`resources/views/components/header.blade.php`)
- **Funcionalidad**:
  - **Usuarios no autenticados**: Muestra navegación completa + botones "Acceder" y "Registrarse"
  - **Usuarios autenticados**: 
    - En welcome: Muestra navegación + menú de usuario con opción "Dashboard"
    - En dashboard: Solo menú de usuario con opción "Inicio"
  - **Menú de usuario**: Foto de perfil, nombre, notificaciones y opciones desplegables

### 2. Footer (`resources/views/components/footer.blade.php`)
- **Funcionalidad**:
  - Solo se muestra en la página de bienvenida
  - Información de contacto y enlaces útiles
  - Diseño responsivo

## Vistas del Dashboard

### 1. Dashboard Administrador (`resources/views/dashboard/admin.blade.php`)
- **Estadísticas**: Total de doctores, pacientes, citas y secretarias
- **Acciones rápidas**: Gestión de personal y reportes
- **Actividad reciente**: Logs de actividades del sistema

### 2. Dashboard Doctor (`resources/views/dashboard/doctor.blade.php`)
- **Estadísticas**: Total de citas, citas de hoy y pendientes
- **Acciones rápidas**: Gestión de citas y pacientes
- **Próximas citas**: Lista de citas programadas

### 3. Dashboard Secretaria (`resources/views/dashboard/secretaria.blade.php`)
- **Estadísticas**: Total de citas, citas de hoy, pendientes y confirmadas
- **Acciones rápidas**: Gestión de citas y pacientes
- **Citas de hoy**: Lista detallada de citas del día
- **Tareas pendientes**: Lista de tareas por realizar

### 4. Dashboard Paciente (`resources/views/dashboard/paciente.blade.php`)
- **Próxima cita**: Información sobre la próxima cita programada
- **Accesos directos**: Reservar cita, ver historial, actualizar perfil
- **Consejo de salud**: Consejo diario de salud
- **Notificaciones**: Notificaciones recientes del sistema

## Controladores

### 1. HomeController (`app/Http/Controllers/HomeController.php`)
- **Método**: `index()` - Muestra la página de bienvenida

### 2. DashboardController (`app/Http/Controllers/DashboardController.php`)
- **Método**: `index()` - Redirige al dashboard según el rol del usuario
- **Métodos privados**:
  - `adminDashboard()` - Dashboard del administrador
  - `doctorDashboard()` - Dashboard del doctor
  - `secretariaDashboard()` - Dashboard de la secretaria
  - `pacienteDashboard()` - Dashboard del paciente

## Middleware

### EnsureUserHasProfile (`app/Http/Middleware/EnsureUserHasProfile.php`)
- **Propósito**: Verifica que el usuario tenga el perfil correspondiente a su rol
- **Registro**: En `bootstrap/app.php` como alias `ensure.profile`
- **Aplicación**: En las rutas del dashboard

## Rutas

### Rutas Principales
```php
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified', 'ensure.profile'])
    ->name('dashboard');
```

### Rutas de Configuración
```php
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});
```

## Características del Header

### Estados del Header
1. **No autenticado**: Navegación completa + botones de acceso
2. **Autenticado en Welcome**: Navegación completa + menú de usuario + opción "Dashboard"
3. **Autenticado en Dashboard**: Solo menú de usuario + opción "Inicio"

### Menú de Usuario
- **Opciones comunes**: Mi Perfil, Configuración, Cerrar Sesión
- **Opción dinámica**: Dashboard (en welcome) / Inicio (en dashboard)
- **Foto de perfil**: Usa foto del perfil o avatar generado automáticamente
- **Notificaciones**: Icono con indicador de notificaciones

## Tecnologías Utilizadas

- **Tailwind CSS**: Para estilos y diseño responsivo
- **Material Icons**: Para iconografía
- **Blade Templates**: Para las vistas
- **Laravel Livewire**: Para componentes interactivos (configuración)
- **Laravel Middleware**: Para control de acceso y validaciones

## Consideraciones de Diseño

1. **Responsive**: Todos los componentes son completamente responsivos
2. **Accesibilidad**: Uso de colores contrastantes y navegación por teclado
3. **UX**: Transiciones suaves y feedback visual
4. **Consistencia**: Diseño uniforme en todas las vistas
5. **Performance**: Uso de CDN para Tailwind y Material Icons 