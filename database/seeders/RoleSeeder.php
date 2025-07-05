<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Seeder para crear los roles básicos del sistema
     * Define los diferentes tipos de usuarios que pueden acceder al sistema
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'admin',
                'description' => 'Administrador del sistema con acceso completo',
                'is_active' => true
            ],
            [
                'name' => 'doctor',
                'description' => 'Médico especialista que atiende pacientes',
                'is_active' => true
            ],
            [
                'name' => 'paciente',
                'description' => 'Paciente que puede agendar citas y ver su historial',
                'is_active' => true
            ],
            [
                'name' => 'secretaria',
                'description' => 'Secretaria administrativa que gestiona citas y pagos',
                'is_active' => true
            ]
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }

        $this->command->info('Roles creados exitosamente');
    }
} 