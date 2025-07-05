<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;
use App\Models\Doctor;

class ScheduleSeeder extends Seeder
{
    /**
     * Seeder para crear horarios de atención para los doctores
     * Crea horarios de lunes a viernes para cada doctor
     */
    public function run(): void
    {
        $schedules = [
            // Doctor 1 - Cardiología
            [
                'doctor_id' => 1,
                'day_of_week' => 'Lunes',
                'start_time' => '08:00:00',
                'end_time' => '12:00:00',
                'appointment_duration' => 30,
                'max_appointments' => 8
            ],
            [
                'doctor_id' => 1,
                'day_of_week' => 'Martes',
                'start_time' => '14:00:00',
                'end_time' => '18:00:00',
                'appointment_duration' => 30,
                'max_appointments' => 8
            ],
            [
                'doctor_id' => 1,
                'day_of_week' => 'Miércoles',
                'start_time' => '08:00:00',
                'end_time' => '12:00:00',
                'appointment_duration' => 30,
                'max_appointments' => 8
            ],
            [
                'doctor_id' => 1,
                'day_of_week' => 'Jueves',
                'start_time' => '14:00:00',
                'end_time' => '18:00:00',
                'appointment_duration' => 30,
                'max_appointments' => 8
            ],
            [
                'doctor_id' => 1,
                'day_of_week' => 'Viernes',
                'start_time' => '08:00:00',
                'end_time' => '12:00:00',
                'appointment_duration' => 30,
                'max_appointments' => 8
            ],

            // Doctor 2 - Dermatología
            [
                'doctor_id' => 2,
                'day_of_week' => 'Lunes',
                'start_time' => '09:00:00',
                'end_time' => '13:00:00',
                'appointment_duration' => 30,
                'max_appointments' => 8
            ],
            [
                'doctor_id' => 2,
                'day_of_week' => 'Martes',
                'start_time' => '15:00:00',
                'end_time' => '19:00:00',
                'appointment_duration' => 30,
                'max_appointments' => 8
            ],
            [
                'doctor_id' => 2,
                'day_of_week' => 'Miércoles',
                'start_time' => '09:00:00',
                'end_time' => '13:00:00',
                'appointment_duration' => 30,
                'max_appointments' => 8
            ],
            [
                'doctor_id' => 2,
                'day_of_week' => 'Jueves',
                'start_time' => '15:00:00',
                'end_time' => '19:00:00',
                'appointment_duration' => 30,
                'max_appointments' => 8
            ],
            [
                'doctor_id' => 2,
                'day_of_week' => 'Viernes',
                'start_time' => '09:00:00',
                'end_time' => '13:00:00',
                'appointment_duration' => 30,
                'max_appointments' => 8
            ],

            // Doctor 3 - Ginecología
            [
                'doctor_id' => 3,
                'day_of_week' => 'Lunes',
                'start_time' => '08:30:00',
                'end_time' => '12:30:00',
                'appointment_duration' => 30,
                'max_appointments' => 8
            ],
            [
                'doctor_id' => 3,
                'day_of_week' => 'Martes',
                'start_time' => '14:30:00',
                'end_time' => '18:30:00',
                'appointment_duration' => 30,
                'max_appointments' => 8
            ],
            [
                'doctor_id' => 3,
                'day_of_week' => 'Miércoles',
                'start_time' => '08:30:00',
                'end_time' => '12:30:00',
                'appointment_duration' => 30,
                'max_appointments' => 8
            ],
            [
                'doctor_id' => 3,
                'day_of_week' => 'Jueves',
                'start_time' => '14:30:00',
                'end_time' => '18:30:00',
                'appointment_duration' => 30,
                'max_appointments' => 8
            ],
            [
                'doctor_id' => 3,
                'day_of_week' => 'Viernes',
                'start_time' => '08:30:00',
                'end_time' => '12:30:00',
                'appointment_duration' => 30,
                'max_appointments' => 8
            ],

            // Doctor 4 - Pediatría
            [
                'doctor_id' => 4,
                'day_of_week' => 'Lunes',
                'start_time' => '09:30:00',
                'end_time' => '13:30:00',
                'appointment_duration' => 30,
                'max_appointments' => 8
            ],
            [
                'doctor_id' => 4,
                'day_of_week' => 'Martes',
                'start_time' => '15:30:00',
                'end_time' => '19:30:00',
                'appointment_duration' => 30,
                'max_appointments' => 8
            ],
            [
                'doctor_id' => 4,
                'day_of_week' => 'Miércoles',
                'start_time' => '09:30:00',
                'end_time' => '13:30:00',
                'appointment_duration' => 30,
                'max_appointments' => 8
            ],
            [
                'doctor_id' => 4,
                'day_of_week' => 'Jueves',
                'start_time' => '15:30:00',
                'end_time' => '19:30:00',
                'appointment_duration' => 30,
                'max_appointments' => 8
            ],
            [
                'doctor_id' => 4,
                'day_of_week' => 'Viernes',
                'start_time' => '09:30:00',
                'end_time' => '13:30:00',
                'appointment_duration' => 30,
                'max_appointments' => 8
            ],

            // Doctor 5 - Oftalmología
            [
                'doctor_id' => 5,
                'day_of_week' => 'Lunes',
                'start_time' => '08:00:00',
                'end_time' => '12:00:00',
                'appointment_duration' => 30,
                'max_appointments' => 8
            ],
            [
                'doctor_id' => 5,
                'day_of_week' => 'Martes',
                'start_time' => '14:00:00',
                'end_time' => '18:00:00',
                'appointment_duration' => 30,
                'max_appointments' => 8
            ],
            [
                'doctor_id' => 5,
                'day_of_week' => 'Miércoles',
                'start_time' => '08:00:00',
                'end_time' => '12:00:00',
                'appointment_duration' => 30,
                'max_appointments' => 8
            ],
            [
                'doctor_id' => 5,
                'day_of_week' => 'Jueves',
                'start_time' => '14:00:00',
                'end_time' => '18:00:00',
                'appointment_duration' => 30,
                'max_appointments' => 8
            ],
            [
                'doctor_id' => 5,
                'day_of_week' => 'Viernes',
                'start_time' => '08:00:00',
                'end_time' => '12:00:00',
                'appointment_duration' => 30,
                'max_appointments' => 8
            ],

            // Doctor 6 - Neurología
            [
                'doctor_id' => 6,
                'day_of_week' => 'Lunes',
                'start_time' => '09:00:00',
                'end_time' => '13:00:00',
                'appointment_duration' => 30,
                'max_appointments' => 8
            ],
            [
                'doctor_id' => 6,
                'day_of_week' => 'Martes',
                'start_time' => '15:00:00',
                'end_time' => '19:00:00',
                'appointment_duration' => 30,
                'max_appointments' => 8
            ],
            [
                'doctor_id' => 6,
                'day_of_week' => 'Miércoles',
                'start_time' => '09:00:00',
                'end_time' => '13:00:00',
                'appointment_duration' => 30,
                'max_appointments' => 8
            ],
            [
                'doctor_id' => 6,
                'day_of_week' => 'Jueves',
                'start_time' => '15:00:00',
                'end_time' => '19:00:00',
                'appointment_duration' => 30,
                'max_appointments' => 8
            ],
            [
                'doctor_id' => 6,
                'day_of_week' => 'Viernes',
                'start_time' => '09:00:00',
                'end_time' => '13:00:00',
                'appointment_duration' => 30,
                'max_appointments' => 8
            ],

            // Doctor 7 - Psiquiatría
            [
                'doctor_id' => 7,
                'day_of_week' => 'Lunes',
                'start_time' => '10:00:00',
                'end_time' => '14:00:00',
                'appointment_duration' => 30,
                'max_appointments' => 8
            ],
            [
                'doctor_id' => 7,
                'day_of_week' => 'Martes',
                'start_time' => '16:00:00',
                'end_time' => '20:00:00',
                'appointment_duration' => 30,
                'max_appointments' => 8
            ],
            [
                'doctor_id' => 7,
                'day_of_week' => 'Miércoles',
                'start_time' => '10:00:00',
                'end_time' => '14:00:00',
                'appointment_duration' => 30,
                'max_appointments' => 8
            ],
            [
                'doctor_id' => 7,
                'day_of_week' => 'Jueves',
                'start_time' => '16:00:00',
                'end_time' => '20:00:00',
                'appointment_duration' => 30,
                'max_appointments' => 8
            ],
            [
                'doctor_id' => 7,
                'day_of_week' => 'Viernes',
                'start_time' => '10:00:00',
                'end_time' => '14:00:00',
                'appointment_duration' => 30,
                'max_appointments' => 8
            ],

            // Doctor 8 - Traumatología
            [
                'doctor_id' => 8,
                'day_of_week' => 'Lunes',
                'start_time' => '08:00:00',
                'end_time' => '12:00:00',
                'appointment_duration' => 30,
                'max_appointments' => 8
            ],
            [
                'doctor_id' => 8,
                'day_of_week' => 'Martes',
                'start_time' => '14:00:00',
                'end_time' => '18:00:00',
                'appointment_duration' => 30,
                'max_appointments' => 8
            ],
            [
                'doctor_id' => 8,
                'day_of_week' => 'Miércoles',
                'start_time' => '08:00:00',
                'end_time' => '12:00:00',
                'appointment_duration' => 30,
                'max_appointments' => 8
            ],
            [
                'doctor_id' => 8,
                'day_of_week' => 'Jueves',
                'start_time' => '14:00:00',
                'end_time' => '18:00:00',
                'appointment_duration' => 30,
                'max_appointments' => 8
            ],
            [
                'doctor_id' => 8,
                'day_of_week' => 'Viernes',
                'start_time' => '08:00:00',
                'end_time' => '12:00:00',
                'appointment_duration' => 30,
                'max_appointments' => 8
            ]
        ];

        foreach ($schedules as $schedule) {
            Schedule::create([
                'doctor_id' => $schedule['doctor_id'],
                'day_of_week' => $schedule['day_of_week'],
                'start_time' => $schedule['start_time'],
                'end_time' => $schedule['end_time'],
                'appointment_duration' => $schedule['appointment_duration'],
                'max_appointments' => $schedule['max_appointments'],
                'is_active' => true
            ]);
        }

        $this->command->info('Horarios creados exitosamente');
    }
} 