<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Profile;
use App\Models\Patient;
use App\Models\MedicalRecord;

class PatientsSeeder extends Seeder
{
    /**
     * Seeder para crear usuarios pacientes con sus perfiles e historiales médicos
     * Crea 10 pacientes con información médica básica
     */
    public function run(): void
    {
        $patients = [
            [
                'document_id' => '30000001',
                'email' => 'paciente1@gmail.com',
                'first_name' => 'Juan',
                'last_name' => 'García',
                'phone' => '930000001',
                'birthdate' => '1990-05-15',
                'address' => 'Av. Brasil 123, Breña',
                'gender' => 'Masculino',
                'civil_status' => 'Soltero',
                'region' => 'Lima',
                'province' => 'Lima',
                'district' => 'Breña',
                'blood_type' => 'O+',
                'allergies' => 'Ninguna',
                'medical_conditions' => 'Ninguna condición médica preexistente',
                'medications' => 'No toma medicamentos regularmente',
                'family_history' => 'Padre con diabetes tipo 2',
                'emergency_contact' => 'María García - 930000002 - Esposa'
            ],
            [
                'document_id' => '30000002',
                'email' => 'paciente2@gmail.com',
                'first_name' => 'María',
                'last_name' => 'López',
                'phone' => '930000002',
                'birthdate' => '1988-08-22',
                'address' => 'Av. Tacna 456, Lima',
                'gender' => 'Femenino',
                'civil_status' => 'Casado',
                'region' => 'Lima',
                'province' => 'Lima',
                'district' => 'Lima',
                'blood_type' => 'A+',
                'allergies' => 'Penicilina',
                'medical_conditions' => 'Hipertensión arterial controlada',
                'medications' => 'Losartán 50mg diario',
                'family_history' => 'Madre con hipertensión',
                'emergency_contact' => 'Carlos López - 930000003 - Esposo'
            ],
            [
                'document_id' => '30000003',
                'email' => 'paciente3@gmail.com',
                'first_name' => 'Carlos',
                'last_name' => 'Rodríguez',
                'phone' => '930000003',
                'birthdate' => '1995-03-10',
                'address' => 'Av. Arequipa 789, Miraflores',
                'gender' => 'Masculino',
                'civil_status' => 'Soltero',
                'region' => 'Lima',
                'province' => 'Lima',
                'district' => 'Miraflores',
                'blood_type' => 'B+',
                'allergies' => 'Polvo, ácaros',
                'medical_conditions' => 'Asma bronquial leve',
                'medications' => 'Salbutamol inhalador según necesidad',
                'family_history' => 'Hermano con asma',
                'emergency_contact' => 'Ana Rodríguez - 930000004 - Hermana'
            ],
            [
                'document_id' => '30000004',
                'email' => 'paciente4@gmail.com',
                'first_name' => 'Ana',
                'last_name' => 'Martínez',
                'phone' => '930000004',
                'birthdate' => '1985-12-05',
                'address' => 'Av. Javier Prado 321, San Isidro',
                'gender' => 'Femenino',
                'civil_status' => 'Divorciado',
                'region' => 'Lima',
                'province' => 'Lima',
                'district' => 'San Isidro',
                'blood_type' => 'AB+',
                'allergies' => 'Ninguna',
                'medical_conditions' => 'Diabetes tipo 2',
                'medications' => 'Metformina 500mg dos veces al día',
                'family_history' => 'Padre y abuelo con diabetes',
                'emergency_contact' => 'Luis Martínez - 930000005 - Hijo'
            ],
            [
                'document_id' => '30000005',
                'email' => 'paciente5@gmail.com',
                'first_name' => 'Luis',
                'last_name' => 'Fernández',
                'phone' => '930000005',
                'birthdate' => '1978-07-18',
                'address' => 'Av. La Marina 654, San Miguel',
                'gender' => 'Masculino',
                'civil_status' => 'Casado',
                'region' => 'Lima',
                'province' => 'Lima',
                'district' => 'San Miguel',
                'blood_type' => 'O-',
                'allergies' => 'Sulfamidas',
                'medical_conditions' => 'Artritis reumatoide',
                'medications' => 'Methotrexate semanal',
                'family_history' => 'Madre con artritis',
                'emergency_contact' => 'Carmen Fernández - 930000006 - Esposa'
            ],
            [
                'document_id' => '30000006',
                'email' => 'paciente6@gmail.com',
                'first_name' => 'Carmen',
                'last_name' => 'González',
                'phone' => '930000006',
                'birthdate' => '1992-11-30',
                'address' => 'Av. Angamos 147, Surco',
                'gender' => 'Femenino',
                'civil_status' => 'Soltero',
                'region' => 'Lima',
                'province' => 'Lima',
                'district' => 'Santiago de Surco',
                'blood_type' => 'A-',
                'allergies' => 'Ninguna',
                'medical_conditions' => 'Ninguna condición médica preexistente',
                'medications' => 'No toma medicamentos regularmente',
                'family_history' => 'Sin antecedentes familiares relevantes',
                'emergency_contact' => 'Roberto González - 930000007 - Padre'
            ],
            [
                'document_id' => '30000007',
                'email' => 'paciente7@gmail.com',
                'first_name' => 'Roberto',
                'last_name' => 'Pérez',
                'phone' => '930000007',
                'birthdate' => '1983-04-12',
                'address' => 'Av. Salaverry 258, Jesús María',
                'gender' => 'Masculino',
                'civil_status' => 'Viudo',
                'region' => 'Lima',
                'province' => 'Lima',
                'district' => 'Jesús María',
                'blood_type' => 'B-',
                'allergies' => 'Ninguna',
                'medical_conditions' => 'Hipercolesterolemia',
                'medications' => 'Atorvastatina 20mg diario',
                'family_history' => 'Padre con enfermedad cardiovascular',
                'emergency_contact' => 'Patricia Pérez - 930000008 - Hija'
            ],
            [
                'document_id' => '30000008',
                'email' => 'paciente8@gmail.com',
                'first_name' => 'Patricia',
                'last_name' => 'Torres',
                'phone' => '930000008',
                'birthdate' => '1987-09-25',
                'address' => 'Av. Arequipa 369, San Borja',
                'gender' => 'Femenino',
                'civil_status' => 'Casado',
                'region' => 'Lima',
                'province' => 'Lima',
                'district' => 'San Borja',
                'blood_type' => 'AB-',
                'allergies' => 'Látex',
                'medical_conditions' => 'Hipotiroidismo',
                'medications' => 'Levotiroxina 50mcg diario',
                'family_history' => 'Madre con hipotiroidismo',
                'emergency_contact' => 'Miguel Torres - 930000009 - Esposo'
            ],
            [
                'document_id' => '30000009',
                'email' => 'paciente9@gmail.com',
                'first_name' => 'Miguel',
                'last_name' => 'Vargas',
                'phone' => '930000009',
                'birthdate' => '1998-01-08',
                'address' => 'Av. Brasil 741, Breña',
                'gender' => 'Masculino',
                'civil_status' => 'Soltero',
                'region' => 'Lima',
                'province' => 'Lima',
                'district' => 'Breña',
                'blood_type' => 'O+',
                'allergies' => 'Ninguna',
                'medical_conditions' => 'Ninguna condición médica preexistente',
                'medications' => 'No toma medicamentos regularmente',
                'family_history' => 'Sin antecedentes familiares relevantes',
                'emergency_contact' => 'Elena Vargas - 930000010 - Madre'
            ],
            [
                'document_id' => '30000010',
                'email' => 'paciente10@gmail.com',
                'first_name' => 'Elena',
                'last_name' => 'Herrera',
                'phone' => '930000010',
                'birthdate' => '1975-06-14',
                'address' => 'Av. Tacna 852, Lima',
                'gender' => 'Femenino',
                'civil_status' => 'Casado',
                'region' => 'Lima',
                'province' => 'Lima',
                'district' => 'Lima',
                'blood_type' => 'A+',
                'allergies' => 'Ninguna',
                'medical_conditions' => 'Osteoporosis',
                'medications' => 'Calcio + Vitamina D diario',
                'family_history' => 'Madre con osteoporosis',
                'emergency_contact' => 'Fernando Herrera - 930000011 - Esposo'
            ]
        ];

        foreach ($patients as $index => $patientData) {
            // Crear usuario
            $user = User::create([
                'role_id' => 3, // Rol de paciente
                'document_id' => $patientData['document_id'],
                'password' => Hash::make("paciente" . ($index + 1)),
                'is_active' => true
            ]);

            // Crear perfil
            Profile::create([
                'user_id' => $user->id,
                'email' => $patientData['email'],
                'first_name' => $patientData['first_name'],
                'last_name' => $patientData['last_name'],
                'phone' => $patientData['phone'],
                'birthdate' => $patientData['birthdate'],
                'address' => $patientData['address'],
                'gender' => $patientData['gender'],
                'civil_status' => $patientData['civil_status'],
                'region' => $patientData['region'],
                'province' => $patientData['province'],
                'district' => $patientData['district']
            ]);

            // Crear paciente
            $patient = Patient::create([
                'user_id' => $user->id,
                'blood_type' => $patientData['blood_type'],
                'allergies' => $patientData['allergies'],
                'medical_conditions' => $patientData['medical_conditions'],
                'medications' => $patientData['medications'],
                'family_history' => $patientData['family_history'],
                'emergency_contact' => $patientData['emergency_contact'],
                'is_active' => true
            ]);

            // Crear historial médico
            MedicalRecord::create([
                'patient_id' => $patient->id,
                'record_number' => 'HMR-' . str_pad($patient->id, 6, '0', STR_PAD_LEFT),
                'general_notes' => 'Historial médico inicial del paciente',
                'is_active' => true
            ]);
        }

        $this->command->info('Pacientes creados exitosamente');
    }
} 