<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Profile;
use App\Models\Doctor;

class DoctorSeeder extends Seeder
{
    /**
     * Seeder para crear usuarios doctores con sus perfiles y especialidades
     * Crea 8 doctores, uno para cada especialidad médica
     */
    public function run(): void
    {
        $doctors = [
            [
                'document_id' => '20000001',
                'email' => 'doctor1@gmail.com',
                'first_name' => 'Carlos',
                'last_name' => 'Pérez',
                'phone' => '920000001',
                'birthdate' => '1985-03-15',
                'address' => 'Av. Arequipa 123, Miraflores',
                'gender' => 'Masculino',
                'civil_status' => 'Casado',
                'region' => 'Lima',
                'province' => 'Lima',
                'district' => 'Miraflores',
                'license_code' => 'LIC001',
                'experience_years' => 15,
                'biography' => 'Cardiólogo con más de 15 años de experiencia en el tratamiento de enfermedades cardiovasculares.',
                'consultation_fee' => 150.00,
                'specialty_id' => 1 // Cardiología
            ],
            [
                'document_id' => '20000002',
                'email' => 'doctor2@gmail.com',
                'first_name' => 'María',
                'last_name' => 'García',
                'phone' => '920000002',
                'birthdate' => '1988-07-22',
                'address' => 'Av. Javier Prado 456, San Isidro',
                'gender' => 'Femenino',
                'civil_status' => 'Soltero',
                'region' => 'Lima',
                'province' => 'Lima',
                'district' => 'San Isidro',
                'license_code' => 'LIC002',
                'experience_years' => 12,
                'biography' => 'Dermatóloga especializada en el tratamiento de enfermedades de la piel y estética dermatológica.',
                'consultation_fee' => 120.00,
                'specialty_id' => 2 // Dermatología
            ],
            [
                'document_id' => '20000003',
                'email' => 'doctor3@gmail.com',
                'first_name' => 'Ana',
                'last_name' => 'Rodríguez',
                'phone' => '920000003',
                'birthdate' => '1983-11-08',
                'address' => 'Av. La Marina 789, San Miguel',
                'gender' => 'Femenino',
                'civil_status' => 'Casado',
                'region' => 'Lima',
                'province' => 'Lima',
                'district' => 'San Miguel',
                'license_code' => 'LIC003',
                'experience_years' => 18,
                'biography' => 'Ginecóloga con amplia experiencia en salud reproductiva y obstetricia.',
                'consultation_fee' => 140.00,
                'specialty_id' => 3 // Ginecología
            ],
            [
                'document_id' => '20000004',
                'email' => 'doctor4@gmail.com',
                'first_name' => 'Roberto',
                'last_name' => 'López',
                'phone' => '920000004',
                'birthdate' => '1987-05-12',
                'address' => 'Av. Brasil 321, Breña',
                'gender' => 'Masculino',
                'civil_status' => 'Soltero',
                'region' => 'Lima',
                'province' => 'Lima',
                'district' => 'Breña',
                'license_code' => 'LIC004',
                'experience_years' => 10,
                'biography' => 'Pediatra especializado en el cuidado integral de niños y adolescentes.',
                'consultation_fee' => 100.00,
                'specialty_id' => 4 // Pediatría
            ],
            [
                'document_id' => '20000005',
                'email' => 'doctor5@gmail.com',
                'first_name' => 'Carmen',
                'last_name' => 'Vargas',
                'phone' => '920000005',
                'birthdate' => '1986-09-30',
                'address' => 'Av. Tacna 654, Lima',
                'gender' => 'Femenino',
                'civil_status' => 'Casado',
                'region' => 'Lima',
                'province' => 'Lima',
                'district' => 'Lima',
                'license_code' => 'LIC005',
                'experience_years' => 14,
                'biography' => 'Oftalmóloga especializada en cirugía refractiva y tratamiento de enfermedades oculares.',
                'consultation_fee' => 160.00,
                'specialty_id' => 5 // Oftalmología
            ],
            [
                'document_id' => '20000006',
                'email' => 'doctor6@gmail.com',
                'first_name' => 'Miguel',
                'last_name' => 'Torres',
                'phone' => '920000006',
                'birthdate' => '1984-12-03',
                'address' => 'Av. Salaverry 987, Jesús María',
                'gender' => 'Masculino',
                'civil_status' => 'Divorciado',
                'region' => 'Lima',
                'province' => 'Lima',
                'district' => 'Jesús María',
                'license_code' => 'LIC006',
                'experience_years' => 16,
                'biography' => 'Neurólogo especializado en el diagnóstico y tratamiento de enfermedades neurológicas.',
                'consultation_fee' => 180.00,
                'specialty_id' => 6 // Neurología
            ],
            [
                'document_id' => '20000007',
                'email' => 'doctor7@gmail.com',
                'first_name' => 'Patricia',
                'last_name' => 'Flores',
                'phone' => '920000007',
                'birthdate' => '1989-02-18',
                'address' => 'Av. Angamos 147, Surco',
                'gender' => 'Femenino',
                'civil_status' => 'Soltero',
                'region' => 'Lima',
                'province' => 'Lima',
                'district' => 'Santiago de Surco',
                'license_code' => 'LIC007',
                'experience_years' => 8,
                'biography' => 'Psiquiatra especializada en el tratamiento de trastornos mentales y salud mental.',
                'consultation_fee' => 130.00,
                'specialty_id' => 7 // Psiquiatría
            ],
            [
                'document_id' => '20000008',
                'email' => 'doctor8@gmail.com',
                'first_name' => 'Fernando',
                'last_name' => 'Herrera',
                'phone' => '920000008',
                'birthdate' => '1982-08-25',
                'address' => 'Av. Arequipa 258, San Borja',
                'gender' => 'Masculino',
                'civil_status' => 'Casado',
                'region' => 'Lima',
                'province' => 'Lima',
                'district' => 'San Borja',
                'license_code' => 'LIC008',
                'experience_years' => 20,
                'biography' => 'Traumatólogo especializado en cirugía ortopédica y traumatología deportiva.',
                'consultation_fee' => 170.00,
                'specialty_id' => 8 // Traumatología
            ]
        ];

        foreach ($doctors as $index => $doctorData) {
            // Crear usuario
            $user = User::create([
                'role_id' => 2, // Rol de doctor
                'document_id' => $doctorData['document_id'],
                'password' => Hash::make("doctor" . ($index + 1)),
                'is_active' => true
            ]);

            // Crear perfil
            Profile::create([
                'user_id' => $user->id,
                'email' => $doctorData['email'],
                'first_name' => $doctorData['first_name'],
                'last_name' => $doctorData['last_name'],
                'phone' => $doctorData['phone'],
                'birthdate' => $doctorData['birthdate'],
                'address' => $doctorData['address'],
                'gender' => $doctorData['gender'],
                'civil_status' => $doctorData['civil_status'],
                'region' => $doctorData['region'],
                'province' => $doctorData['province'],
                'district' => $doctorData['district']
            ]);

            // Crear doctor
            Doctor::create([
                'user_id' => $user->id,
                'specialty_id' => $doctorData['specialty_id'],
                'license_code' => $doctorData['license_code'],
                'experience_years' => $doctorData['experience_years'],
                'biography' => $doctorData['biography'],
                'consultation_fee' => $doctorData['consultation_fee'],
                'is_available' => true
            ]);
        }

        $this->command->info('Doctores creados exitosamente');
    }
} 