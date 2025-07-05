<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Profile;

class AdminSeeder extends Seeder
{
    /**
     * Seeder para crear el usuario administrador del sistema
     * Crea un usuario con rol de administrador y su perfil correspondiente
     */
    public function run(): void
    {
        // Crear usuario administrador
        $adminUser = User::create([
            'role_id' => 1, // ID del rol admin
            'document_id' => '12345678', // DNI del administrador
            'password' => Hash::make('admin123'),
            'is_active' => true
        ]);

        // Crear perfil del administrador
        Profile::create([
            'user_id' => $adminUser->id,
            'email' => 'admin@gmail.com',
            'first_name' => 'Admin',
            'last_name' => 'Principal',
            'phone' => '900000001',
            'birthdate' => '1990-01-01',
            'address' => 'Oficina central del sistema',
            'gender' => 'Masculino',
            'civil_status' => 'Soltero',
            'region' => 'Lima',
            'province' => 'Lima',
            'district' => 'Lima'
        ]);

        $this->command->info('Administrador creado exitosamente');
        $this->command->info('DNI: 12345678');
        $this->command->info('Contraseña: admin123');
    }
} 