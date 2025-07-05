<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified', 'ensure.profile'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('perfil/editar', \App\Livewire\Profile\EditProfile::class)->name('perfil.edit');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    // Rutas para Pacientes
    Route::prefix('paciente')->name('paciente.')->group(function () {
        Route::get('/agendar-cita', function () {
            return view('paciente.agendar-cita', [
                'header' => 'Reservar Cita',
                'headerDescription' => 'Agenda tu cita médica con nuestros especialistas'
            ]);
        })->name('agendarCita.create');
        
        Route::get('/mis-citas', function () {
            return view('paciente.mis-citas', [
                'header' => 'Mis Citas',
                'headerDescription' => 'Gestiona tus citas médicas'
            ]);
        })->name('misCitas.index');
        
        Route::get('/historial', function () {
            return view('paciente.historial', [
                'header' => 'Historial Médico',
                'headerDescription' => 'Consulta tu historial médico completo'
            ]);
        })->name('historial.index');
    });

    // Rutas para Doctores
    Route::prefix('doctor')->name('doctor.')->group(function () {
        Route::get('/agenda', function () {
            return view('doctor.agenda', [
                'header' => 'Mi Agenda',
                'headerDescription' => 'Gestiona tu agenda de citas médicas'
            ]);
        })->name('agenda.index');
    });

    // Rutas para Secretarias
    Route::prefix('secretaria')->name('secretaria.')->group(function () {
        Route::get('/pagos', function () {
            return view('secretaria.pagos', [
                'header' => 'Validar Pagos',
                'headerDescription' => 'Gestiona y valida los pagos de citas'
            ]);
        })->name('pagos.index');
        
        Route::get('/reportes', function () {
            return view('secretaria.reportes', [
                'header' => 'Generar Reportes',
                'headerDescription' => 'Genera reportes del sistema'
            ]);
        })->name('reportes.index');
    });

    // Rutas para Administradores
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/personal', function () {
            return view('admin.personal', [
                'header' => 'Gestión de Cuentas',
                'headerDescription' => 'Administra el personal del sistema'
            ]);
        })->name('personal.index');
        
        Route::get('/horarios', function () {
            return view('admin.horarios', [
                'header' => 'Gestión de Horarios',
                'headerDescription' => 'Configura los horarios de atención'
            ]);
        })->name('horarios.index');
        
        Route::get('/especialidades', function () {
            return view('admin.especialidades', [
                'header' => 'Gestión de Especialidades',
                'headerDescription' => 'Administra las especialidades médicas'
            ]);
        })->name('especialidades.index');
    });

    // Rutas comunes
    Route::get('/notificaciones', function () {
        return view('notificaciones.index', [
            'header' => 'Notificaciones',
            'headerDescription' => 'Gestiona tus notificaciones'
        ]);
    })->name('notificaciones.index');
});

require __DIR__.'/auth.php';
