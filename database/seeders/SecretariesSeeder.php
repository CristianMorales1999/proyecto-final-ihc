<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Profile;
use App\Models\Secretary;

class SecretariesSeeder extends Seeder
{
    /**
     * Seeder para crear usuarios secretarias con sus perfiles
     * Crea 3 secretarias para el sistema
     */
    public function run(): void
    {
        $secretaries = [
            [
                'document_id' => '40000001',
                'email' => 'secretaria1@gmail.com',
                'first_name' => 'Rosa',
                'last_name' => 'Gómez',
                'phone' => '940000001',
                'birthdate' => '1992-04-15',
                'address' => 'Av. Javier Prado 123, San Borja',
                'gender' => 'Femenino',
                'civil_status' => 'Soltero',
                'region' => 'Lima',
                'province' => 'Lima',
                'district' => 'San Borja',
                'employee_code' => 'SEC001',
                'hire_date' => '2020-03-01'
            ],
            [
                'document_id' => '40000002',
                'email' => 'secretaria2@gmail.com',
                'first_name' => 'Carmen',
                'last_name' => 'Vásquez',
                'phone' => '940000002',
                'birthdate' => '1988-09-22',
                'address' => 'Av. Arequipa 456, Miraflores',
                'gender' => 'Femenino',
                'civil_status' => 'Casado',
                'region' => 'Lima',
                'province' => 'Lima',
                'district' => 'Miraflores',
                'employee_code' => 'SEC002',
                'hire_date' => '2019-07-15'
            ],
            [
                'document_id' => '40000003',
                'email' => 'secretaria3@gmail.com',
                'first_name' => 'Ana',
                'last_name' => 'Mendoza',
                'phone' => '940000003',
                'birthdate' => '1995-12-08',
                'address' => 'Av. La Marina 789, San Miguel',
                'gender' => 'Femenino',
                'civil_status' => 'Soltero',
                'region' => 'Lima',
                'province' => 'Lima',
                'district' => 'San Miguel',
                'employee_code' => 'SEC003',
                'hire_date' => '2021-01-10'
            ]
        ];

        foreach ($secretaries as $index => $secretaryData) {
            // Crear usuario
            $user = User::create([
                'role_id' => 4, // Rol de secretaria
                'document_id' => $secretaryData['document_id'],
                'password' => Hash::make("secretaria" . ($index + 1)),
                'is_active' => true
            ]);

            // Crear perfil
            Profile::create([
                'user_id' => $user->id,
                'email' => $secretaryData['email'],
                'first_name' => $secretaryData['first_name'],
                'last_name' => $secretaryData['last_name'],
                'phone' => $secretaryData['phone'],
                'birthdate' => $secretaryData['birthdate'],
                'address' => $secretaryData['address'],
                'gender' => $secretaryData['gender'],
                'civil_status' => $secretaryData['civil_status'],
                'region' => $secretaryData['region'],
                'province' => $secretaryData['province'],
                'district' => $secretaryData['district']
            ]);

            // Crear secretaria
            Secretary::create([
                'user_id' => $user->id,
                'employee_code' => $secretaryData['employee_code'],
                'hire_date' => $secretaryData['hire_date'],
                'is_active' => true
            ]);
        }

        $this->command->info('Secretarias creadas exitosamente');
    }
} 