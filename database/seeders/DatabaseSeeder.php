<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    /**
     * Seeder principal que ejecuta todos los seeders en el orden correcto
     * Garantiza que las dependencias se creen antes que las entidades que las necesitan
     */
    public function run(): void
    {
        $this->command->info('Iniciando proceso de seeding...');

        // 1. Crear roles del sistema
        $this->call(RoleSeeder::class);

        // 2. Crear especialidades médicas
        $this->call(SpecialtiesSeeder::class);

        // 3. Crear administrador
        $this->call(AdminSeeder::class);

        // 4. Crear doctores
        $this->call(DoctorSeeder::class);

        // 5. Crear secretarias
        $this->call(SecretariesSeeder::class);

        // 6. Crear pacientes
        $this->call(PatientsSeeder::class);

        // 7. Crear horarios de doctores
        $this->call(ScheduleSeeder::class);

        // 8. Crear citas, pagos y detalles médicos
        $this->call(AppointmentsSeeder::class);

        $this->command->info('Proceso de seeding completado exitosamente');
        $this->command->info('Credenciales de acceso:');
        $this->command->info('Admin: admin@gmail.com / admin123');
        $this->command->info('Doctores: doctor1@gmail.com / doctor1, doctor2@gmail.com / doctor2, etc.');
        $this->command->info('Secretarias: secretaria1@gmail.com / secretaria1, secretaria2@gmail.com / secretaria2, etc.');
        $this->command->info('Pacientes: paciente1@gmail.com / paciente1, paciente2@gmail.com / paciente2, etc.');
    }
}
