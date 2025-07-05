<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Specialty;

class SpecialtiesSeeder extends Seeder
{
    /**
     * Seeder para crear las especialidades médicas básicas
     * Define las diferentes especialidades que pueden tener los doctores
     */
    public function run(): void
    {
        $specialties = [
            [
                'name' => 'Cardiología',
                'description' => 'Especialidad médica que se encarga del diagnóstico y tratamiento de las enfermedades del corazón y del sistema circulatorio',
                'is_active' => true
            ],
            [
                'name' => 'Dermatología',
                'description' => 'Especialidad médica que se encarga del diagnóstico y tratamiento de las enfermedades de la piel',
                'is_active' => true
            ],
            [
                'name' => 'Ginecología',
                'description' => 'Especialidad médica que se encarga del diagnóstico y tratamiento de las enfermedades del aparato reproductor femenino',
                'is_active' => true
            ],
            [
                'name' => 'Pediatría',
                'description' => 'Especialidad médica que se encarga del diagnóstico y tratamiento de las enfermedades en niños y adolescentes',
                'is_active' => true
            ],
            [
                'name' => 'Oftalmología',
                'description' => 'Especialidad médica que se encarga del diagnóstico y tratamiento de las enfermedades de los ojos',
                'is_active' => true
            ],
            [
                'name' => 'Neurología',
                'description' => 'Especialidad médica que se encarga del diagnóstico y tratamiento de las enfermedades del sistema nervioso',
                'is_active' => true
            ],
            [
                'name' => 'Psiquiatría',
                'description' => 'Especialidad médica que se encarga del diagnóstico y tratamiento de las enfermedades mentales',
                'is_active' => true
            ],
            [
                'name' => 'Traumatología',
                'description' => 'Especialidad médica que se encarga del diagnóstico y tratamiento de las lesiones del sistema músculo-esquelético',
                'is_active' => true
            ]
        ];

        foreach ($specialties as $specialty) {
            Specialty::create($specialty);
        }

        $this->command->info('Especialidades médicas creadas exitosamente');
    }
} 