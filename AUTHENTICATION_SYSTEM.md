# Sistema de Autenticación - SaludIntegra

## Descripción General

El sistema de autenticación de SaludIntegra utiliza el **DNI (Documento Nacional de Identidad)** como identificador único para el login y registro, en lugar del correo electrónico tradicional. Esto proporciona mayor seguridad y facilita el acceso para usuarios que pueden no recordar su correo electrónico.

## Estructura de Base de Datos

### Tabla `users`
- `id` - Identificador único
- `role_id` - Referencia al rol del usuario
- `document_id` - **DNI del usuario (8 caracteres, único)**
- `password` - Contraseña hasheada
- `is_active` - Estado activo/inactivo del usuario
- `remember_token` - Token para "recordar sesión"
- `timestamps` - Fechas de creación y actualización
- `soft_deletes` - Eliminación suave

### Tabla `profiles`
- `id` - Identificador único
- `user_id` - Referencia al usuario
- `email` - Correo electrónico (opcional)
- `first_name` - Nombre
- `last_name` - Apellido
- `phone` - Teléfono
- `address` - Dirección
- `birthdate` - Fecha de nacimiento
- `gender` - Género (Masculino/Femenino/Otro)
- `civil_status` - Estado civil
- `region` - Región
- `province` - Provincia
- `district` - Distrito
- `photo_path` - Ruta de la foto de perfil

## Flujo de Autenticación

### 1. Login
1. Usuario ingresa su **DNI** y contraseña
2. Sistema valida que el DNI exista en `users.document_id`
3. Sistema verifica la contraseña hasheada
4. Sistema verifica que el usuario esté activo (`is_active = true`)
5. Sistema verifica que el usuario tenga un perfil asociado
6. Se inicia la sesión y se redirige al dashboard correspondiente

### 2. Registro
1. Usuario ingresa su **DNI**, contraseña y confirma contraseña
2. Sistema valida que el DNI no esté registrado previamente
3. Sistema valida que la contraseña cumpla los requisitos mínimos
4. Sistema crea el usuario en `users` con el DNI como `document_id`
5. Sistema crea el perfil asociado en `profiles`
6. Sistema crea el registro específico según el rol (paciente, doctor, etc.)
7. Se inicia la sesión automáticamente

## Controladores

### LoginController
- `showLoginForm()` - Muestra el formulario de login
- `login(Request $request)` - Procesa el login con DNI
- `logout(Request $request)` - Cierra la sesión

### RegisterController
- `showRegistrationForm()` - Muestra el formulario de registro
- `store(Request $request)` - Procesa el registro con DNI

## Middleware

### EnsureUserHasProfile
Verifica que el usuario autenticado:
- Tenga un `document_id` válido
- Tenga un perfil asociado
- Esté activo en el sistema

## Validaciones

### Login
- DNI: requerido, string, máximo 8 caracteres
- Contraseña: requerida

### Registro
- DNI: requerido, string, máximo 8 caracteres, único en `users.document_id`
- Contraseña: requerida, mínimo 8 caracteres, confirmada
- Términos: debe aceptar términos y condiciones

## Seguridad

1. **DNI como identificador único**: Mayor seguridad que email
2. **Contraseñas hasheadas**: Uso de Hash::make()
3. **Validación de estado activo**: Usuarios pueden ser desactivados
4. **Middleware de verificación**: Asegura integridad de datos
5. **Soft deletes**: Mantiene integridad referencial
6. **Tokens de sesión**: Gestión segura de sesiones

## Vistas

### Login (`resources/views/auth/login.blade.php`)
- Formulario con campos DNI y contraseña
- Diseño responsivo con Tailwind CSS
- Validación en tiempo real
- Enlaces a registro y recuperación de contraseña

### Registro (`resources/views/auth/register.blade.php`)
- Formulario con DNI, contraseña y confirmación
- Validación en tiempo real
- Checkbox de términos y condiciones
- Enlaces a login

## Rutas

```php
// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Registro
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
```

## Credenciales de Prueba

### Administrador
- **DNI**: 12345678
- **Contraseña**: admin123

### Doctores
- **DNI**: 20000001 a 20000008
- **Contraseña**: doctor1 a doctor8

### Pacientes
- **DNI**: 30000001 a 30000010
- **Contraseña**: paciente1 a paciente10

### Secretarias
- **DNI**: 40000001 a 40000003
- **Contraseña**: secretaria1 a secretaria3

## Configuración

### Archivo de configuración
El sistema está configurado para usar DNI como identificador principal en:
- `config/auth.php` - Configuración de autenticación
- Migraciones de base de datos
- Modelos de Eloquent
- Controladores de autenticación

### Variables de entorno
Asegúrate de tener configurado:
- `APP_NAME=SaludIntegra`
- `APP_ENV=local`
- `APP_DEBUG=true` (para desarrollo)

## Notas Importantes

1. **DNI único**: Cada DNI solo puede estar registrado una vez
2. **Perfil obligatorio**: Todo usuario debe tener un perfil asociado
3. **Roles específicos**: Los usuarios se crean con roles específicos (admin, doctor, paciente, secretaria)
4. **Email opcional**: El email se puede configurar después del registro
5. **Recuperación de contraseña**: Funciona con DNI en lugar de email

## Troubleshooting

### Error: "DNI ya registrado"
- Verificar que el DNI no esté en uso
- Usar un DNI diferente para pruebas

### Error: "Usuario sin perfil"
- Ejecutar `php artisan db:seed` para crear datos de prueba
- Verificar que el middleware funcione correctamente

### Error: "Credenciales inválidas"
- Verificar que el DNI esté correctamente ingresado
- Verificar que la contraseña coincida con los datos de prueba

## Características Implementadas

### 🔐 **Autenticación por DNI**
- Los usuarios se identifican usando su número de DNI
- Validación de credenciales contra la base de datos
- Búsqueda de usuarios a través de la relación con perfiles

### 📝 **Registro de Pacientes**
- Registro automático como paciente
- Creación automática de perfil y datos de paciente
- Validación de términos y condiciones
- Email temporal generado automáticamente

### 🎨 **Diseño Personalizado**
- Interfaz basada en el diseño proporcionado
- Header y footer consistentes
- Formularios con validación en tiempo real
- Toggle de visibilidad de contraseñas

## Estructura de Archivos

### Controladores
```
app/Http/Controllers/Auth/
├── LoginController.php      # Manejo de login/logout
└── RegisterController.php   # Manejo de registro
```

### Vistas
```
resources/views/
├── layouts/
│   └── auth.blade.php       # Layout de autenticación
└── auth/
    ├── login.blade.php      # Vista de login
    └── register.blade.php   # Vista de registro
```

### Middleware
```
app/Http/Middleware/
└── EnsureUserHasProfile.php # Verificación de perfiles
```

## Funcionalidades Adicionales

### 🔄 **Recuperación de Contraseña**
- Sistema de recuperación por email (Livewire)
- Tokens de recuperación seguros
- Expiración automática de tokens

### ✅ **Verificación de Email**
- Sistema de verificación de email (Livewire)
- Envío de emails de verificación
- Protección de rutas no verificadas

## Notas Técnicas

### Base de Datos
- Los usuarios se almacenan en `users` con email temporal
- Los perfiles se almacenan en `profiles` con DNI real
- Los pacientes se almacenan en `patients` con datos médicos

### Relaciones
- `User` → `Profile` (1:1)
- `User` → `Patient` (1:1) - Solo para pacientes
- `User` → `Role` (N:1)

### Middleware
- `ensure.profile`: Verifica que el usuario tenga perfil configurado
- Se aplica automáticamente en rutas protegidas

## Próximas Mejoras

### 🚀 **Funcionalidades Planificadas**
- Autenticación de dos factores
- Bloqueo de cuenta por intentos fallidos
- Historial de sesiones
- Notificaciones de login sospechoso
- Integración con redes sociales

### 🔧 **Optimizaciones**
- Cache de perfiles de usuario
- Optimización de consultas de autenticación
- Compresión de assets
- Lazy loading de componentes

---

**Desarrollado para SaludIntegra - Sistema de Gestión Hospitalaria** 