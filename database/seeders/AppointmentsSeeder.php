<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Schedule;
use App\Models\MedicalRecordDetail;
use App\Models\MedicalRecord;
use App\Models\Payment;
use App\Models\Secretary;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AppointmentsSeeder extends Seeder
{
    /**
     * Seeder para crear citas médicas, pagos y detalles de historial médico
     * Crea citas futuras y pasadas con sus respectivos pagos y detalles médicos
     */
    public function run(): void
    {
        $this->command->info('Creando citas médicas...');

        // Obtener todos los doctores, pacientes y secretarias
        $doctors = Doctor::with('user.profile')->get();
        $patients = Patient::with('user.profile')->get();
        $secretaries = Secretary::with('user.profile')->get();
        $schedules = Schedule::all();

        // Crear citas futuras (programadas)
        $this->createFutureAppointments($doctors, $patients, $schedules);

        // Crear citas pasadas (completadas)
        $this->createPastAppointments($doctors, $patients, $schedules, $secretaries);

        $this->command->info('Citas médicas creadas exitosamente');
    }

    /**
     * Crear citas futuras programadas
     */
    private function createFutureAppointments($doctors, $patients, $schedules)
    {
        $usedSlots = []; // Array para rastrear slots ya utilizados

        foreach ($doctors as $doctor) {
            $doctorSchedules = $schedules->where('doctor_id', $doctor->id);
            
            foreach ($doctorSchedules as $schedule) {
                // Crear 1-2 citas por horario (reducido para evitar conflictos)
                $appointmentsCount = rand(1, 2);
                
                for ($i = 0; $i < $appointmentsCount; $i++) {
                    $patient = $patients->random();
                    
                    // Generar fecha futura en día laboral
                    $appointmentDate = $this->generateFutureWeekdayDate();
                    
                    // Generar hora dentro del horario del doctor
                    $appointmentTime = $this->generateTimeInSchedule($schedule);
                    
                    // Verificar que no haya conflicto
                    $slotKey = $doctor->id . '_' . $appointmentDate . '_' . $appointmentTime;
                    if (in_array($slotKey, $usedSlots)) {
                        continue; // Saltar si ya existe una cita en este slot
                    }
                    
                    $usedSlots[] = $slotKey;
                    
                    // Crear la cita
                    $appointment = Appointment::create([
                        'patient_id' => $patient->id,
                        'doctor_id' => $doctor->id,
                        'schedule_id' => $schedule->id,
                        'appointment_date' => $appointmentDate,
                        'appointment_time' => $appointmentTime,
                        'status' => 'programada',
                        'reason' => $this->getRandomReason($doctor->specialty->name),
                        'notes' => 'Cita programada para consulta médica',
                        'fee' => $doctor->consultation_fee
                    ]);

                    // Crear pago según método seleccionado
                    $paymentMethod = $this->getRandomPaymentMethod();
                    $paymentStatus = $this->getPaymentStatus($paymentMethod);
                    $paymentData = [
                        'appointment_id' => $appointment->id,
                        'uploaded_by' => $patient->user_id,
                        'validated_by' => null,
                        'payment_number' => 'PAY-' . str_pad($appointment->id, 8, '0', STR_PAD_LEFT),
                        'image_path' => null,
                        'payment_method' => $paymentMethod,
                        'amount' => $doctor->consultation_fee,
                        'status' => $paymentStatus,
                        'uploaded_at' => now(),
                        'validated_at' => null
                    ];

                    // Agregar datos específicos según método de pago
                    if ($paymentMethod === 'clinica') {
                        $paymentData['payment_deadline'] = $this->getPaymentDeadline($appointmentDate);
                    } elseif ($paymentMethod === 'tarjeta') {
                        $cardData = $this->getRandomCardData();
                        $paymentData['card_number'] = $cardData['card_number'];
                        $paymentData['card_expiry'] = $cardData['card_expiry'];
                        $paymentData['card_cvv'] = $cardData['card_cvv'];
                        $paymentData['validated_at'] = now(); // Simulado como pagado
                    }

                    Payment::create($paymentData);
                }
            }
        }
    }

    /**
     * Crear citas pasadas completadas
     */
    private function createPastAppointments($doctors, $patients, $schedules, $secretaries)
    {
        $usedSlots = []; // Array para rastrear slots ya utilizados

        foreach ($doctors as $doctor) {
            $doctorSchedules = $schedules->where('doctor_id', $doctor->id);
            
            foreach ($doctorSchedules as $schedule) {
                // Crear 1 cita pasada por horario (reducido para evitar conflictos)
                $appointmentsCount = 1;
                
                for ($i = 0; $i < $appointmentsCount; $i++) {
                    $patient = $patients->random();
                    $secretary = $secretaries->random();
                    
                    // Generar fecha pasada en día laboral
                    $appointmentDate = $this->generatePastWeekdayDate();
                    
                    // Generar hora dentro del horario del doctor
                    $appointmentTime = $this->generateTimeInSchedule($schedule);
                    
                    // Verificar que no haya conflicto
                    $slotKey = $doctor->id . '_' . $appointmentDate . '_' . $appointmentTime;
                    if (in_array($slotKey, $usedSlots)) {
                        continue; // Saltar si ya existe una cita en este slot
                    }
                    
                    $usedSlots[] = $slotKey;
                    
                    // Crear la cita completada
                    $appointment = Appointment::create([
                        'patient_id' => $patient->id,
                        'doctor_id' => $doctor->id,
                        'schedule_id' => $schedule->id,
                        'appointment_date' => $appointmentDate,
                        'appointment_time' => $appointmentTime,
                        'status' => 'completada',
                        'reason' => $this->getRandomReason($doctor->specialty->name),
                        'notes' => 'Consulta médica realizada exitosamente',
                        'fee' => $doctor->consultation_fee,
                        'confirmed_at' => $appointmentDate . ' ' . $appointmentTime,
                        'completed_at' => $appointmentDate . ' ' . $this->addMinutesToTime($appointmentTime, 30)
                    ]);

                    // Crear pago validado
                    Payment::create([
                        'appointment_id' => $appointment->id,
                        'uploaded_by' => $patient->user_id,
                        'validated_by' => $secretary->user_id,
                        'payment_number' => 'PAY-' . str_pad($appointment->id, 8, '0', STR_PAD_LEFT),
                        'image_path' => null,
                        'payment_method' => $this->getRandomPaymentMethod(),
                        'amount' => $doctor->consultation_fee,
                        'status' => 'validado',
                        'uploaded_at' => $appointmentDate . ' ' . $appointmentTime,
                        'validated_at' => $appointmentDate . ' ' . $this->addMinutesToTime($appointmentTime, 15)
                    ]);

                    // Crear detalle del historial médico
                    $medicalRecord = MedicalRecord::where('patient_id', $patient->id)->first();
                    if ($medicalRecord) {
                        MedicalRecordDetail::create([
                            'medical_record_id' => $medicalRecord->id,
                            'appointment_id' => $appointment->id,
                            'doctor_id' => $doctor->id,
                            'symptoms' => $this->getRandomSymptoms($doctor->specialty->name),
                            'diagnosis' => $this->getRandomDiagnosis($doctor->specialty->name),
                            'treatment' => $this->getRandomTreatment($doctor->specialty->name),
                            'prescription' => $this->getRandomPrescription($doctor->specialty->name),
                            'notes' => 'Consulta médica realizada con éxito. Paciente presenta mejoría.',
                            'vital_signs' => json_encode($this->getRandomVitalSigns()),
                            'weight' => rand(50, 100) + (rand(0, 99) / 100),
                            'height' => rand(150, 190) + (rand(0, 99) / 100),
                            'blood_pressure_systolic' => rand(110, 140),
                            'blood_pressure_diastolic' => rand(70, 90),
                            'heart_rate' => rand(60, 100),
                            'temperature' => rand(360, 375) / 10
                        ]);
                    }
                }
            }
        }
    }

    /**
     * Generar fecha futura en día laboral
     */
    private function generateFutureWeekdayDate()
    {
        $randomDays = rand(1, 30);
        $date = Carbon::now()->addDays($randomDays);
        
        while ($date->isWeekend()) {
            $date = $date->addDay();
        }
        
        return $date->format('Y-m-d');
    }

    /**
     * Generar fecha pasada en día laboral
     */
    private function generatePastWeekdayDate()
    {
        $randomDays = rand(1, 60);
        $date = Carbon::now()->subDays($randomDays);
        
        while ($date->isWeekend()) {
            $date = $date->subDay();
        }
        
        return $date->format('Y-m-d');
    }

    /**
     * Generar hora dentro del horario del doctor
     */
    private function generateTimeInSchedule($schedule)
    {
        $startTime = Carbon::parse($schedule->start_time);
        $endTime = Carbon::parse($schedule->end_time);
        
        // Generar hora aleatoria entre el inicio y fin del horario
        $randomMinutes = rand(0, $endTime->diffInMinutes($startTime));
        $appointmentTime = $startTime->copy()->addMinutes($randomMinutes);
        
        return $appointmentTime->format('H:i:s');
    }

    /**
     * Agregar minutos a una hora
     */
    private function addMinutesToTime($time, $minutes)
    {
        return Carbon::parse($time)->addMinutes($minutes)->format('H:i:s');
    }

    /**
     * Obtener razón aleatoria según especialidad
     */
    private function getRandomReason($specialty)
    {
        $reasons = [
            'Cardiología' => ['Dolor en el pecho', 'Palpitaciones', 'Hipertensión', 'Control cardiológico'],
            'Neurología' => ['Dolor de cabeza', 'Mareos', 'Problemas de memoria', 'Control neurológico'],
            'Oncología' => ['Seguimiento oncológico', 'Control de tratamiento', 'Revisión de resultados'],
            'Pediatría' => ['Control pediátrico', 'Vacunación', 'Fiebre', 'Revisión general'],
            'Ortopedia' => ['Dolor en articulaciones', 'Lesión deportiva', 'Control post-operatorio'],
            'Dermatología' => ['Erupción cutánea', 'Lunares', 'Acné', 'Control dermatológico'],
            'Gastroenterología' => ['Dolor abdominal', 'Problemas digestivos', 'Control gastrointestinal'],
            'Neumología' => ['Tos persistente', 'Dificultad para respirar', 'Control respiratorio']
        ];

        $specialtyReasons = $reasons[$specialty] ?? ['Consulta médica general'];
        return $specialtyReasons[array_rand($specialtyReasons)];
    }

    /**
     * Obtener síntomas aleatorios según especialidad
     */
    private function getRandomSymptoms($specialty)
    {
        $symptoms = [
            'Cardiología' => ['Dolor en el pecho', 'Palpitaciones', 'Fatiga', 'Dificultad para respirar'],
            'Neurología' => ['Dolor de cabeza', 'Mareos', 'Pérdida de memoria', 'Entumecimiento'],
            'Oncología' => ['Fatiga', 'Pérdida de peso', 'Dolor generalizado'],
            'Pediatría' => ['Fiebre', 'Tos', 'Dolor de garganta', 'Diarrea'],
            'Ortopedia' => ['Dolor articular', 'Inflamación', 'Limitación de movimiento'],
            'Dermatología' => ['Picazón', 'Erupción', 'Cambios en la piel'],
            'Gastroenterología' => ['Dolor abdominal', 'Náuseas', 'Acidez', 'Diarrea'],
            'Neumología' => ['Tos', 'Dificultad para respirar', 'Sibilancias']
        ];

        $specialtySymptoms = $symptoms[$specialty] ?? ['Síntomas generales'];
        return $specialtySymptoms[array_rand($specialtySymptoms)];
    }

    /**
     * Obtener diagnóstico aleatorio según especialidad
     */
    private function getRandomDiagnosis($specialty)
    {
        $diagnoses = [
            'Cardiología' => ['Hipertensión arterial', 'Arritmia', 'Angina de pecho'],
            'Neurología' => ['Migraña', 'Cefalea tensional', 'Vértigo'],
            'Oncología' => ['Seguimiento oncológico', 'Remisión'],
            'Pediatría' => ['Infección respiratoria', 'Gastroenteritis', 'Control de crecimiento'],
            'Ortopedia' => ['Artritis', 'Lesión muscular', 'Fractura consolidada'],
            'Dermatología' => ['Dermatitis', 'Acné', 'Melanoma benigno'],
            'Gastroenterología' => ['Gastritis', 'Reflujo gastroesofágico', 'Colitis'],
            'Neumología' => ['Bronquitis', 'Asma', 'Neumonía']
        ];

        $specialtyDiagnoses = $diagnoses[$specialty] ?? ['Diagnóstico general'];
        return $specialtyDiagnoses[array_rand($specialtyDiagnoses)];
    }

    /**
     * Obtener tratamiento aleatorio según especialidad
     */
    private function getRandomTreatment($specialty)
    {
        $treatments = [
            'Cardiología' => ['Medicación antihipertensiva', 'Control de dieta', 'Ejercicio moderado'],
            'Neurología' => ['Analgésicos', 'Terapia de relajación', 'Control de estrés'],
            'Oncología' => ['Seguimiento médico', 'Control de síntomas'],
            'Pediatría' => ['Antibióticos', 'Reposo', 'Hidratación'],
            'Ortopedia' => ['Fisioterapia', 'Antiinflamatorios', 'Reposo'],
            'Dermatología' => ['Cremas tópicas', 'Antibióticos', 'Protección solar'],
            'Gastroenterología' => ['Antiácidos', 'Cambios en dieta', 'Probióticos'],
            'Neumología' => ['Broncodilatadores', 'Corticoides', 'Oxigenoterapia']
        ];

        $specialtyTreatments = $treatments[$specialty] ?? ['Tratamiento general'];
        return $specialtyTreatments[array_rand($specialtyTreatments)];
    }

    /**
     * Obtener prescripción aleatoria según especialidad
     */
    private function getRandomPrescription($specialty)
    {
        $prescriptions = [
            'Cardiología' => ['Amlodipino 5mg', 'Losartán 50mg', 'Atorvastatina 20mg'],
            'Neurología' => ['Ibuprofeno 400mg', 'Paracetamol 500mg', 'Sumatriptán 50mg'],
            'Oncología' => ['Medicación de soporte', 'Antiinflamatorios'],
            'Pediatría' => ['Amoxicilina 250mg', 'Paracetamol 125mg', 'Suero oral'],
            'Ortopedia' => ['Ibuprofeno 600mg', 'Diclofenaco 50mg', 'Paracetamol 500mg'],
            'Dermatología' => ['Hidrocortisona 1%', 'Clotrimazol 1%', 'Protector solar'],
            'Gastroenterología' => ['Omeprazol 20mg', 'Ranitidina 150mg', 'Lactobacillus'],
            'Neumología' => ['Salbutamol inhalador', 'Budesonida', 'Prednisona']
        ];

        $specialtyPrescriptions = $prescriptions[$specialty] ?? ['Medicación general'];
        return $specialtyPrescriptions[array_rand($specialtyPrescriptions)];
    }

    /**
     * Obtener método de pago aleatorio
     */
    private function getRandomPaymentMethod()
    {
        $methods = ['transferencia', 'clinica', 'tarjeta'];
        return $methods[array_rand($methods)];
    }

    /**
     * Obtener estado de pago según método
     */
    private function getPaymentStatus($method)
    {
        switch ($method) {
            case 'transferencia':
                return 'pendiente';
            case 'clinica':
                return 'pendiente';
            case 'tarjeta':
                return 'validado';
            default:
                return 'pendiente';
        }
    }

    /**
     * Obtener fecha límite para pago en clínica
     */
    private function getPaymentDeadline($appointmentDate)
    {
        return Carbon::parse($appointmentDate)->subDay()->format('Y-m-d H:i:s');
    }

    /**
     * Obtener datos de tarjeta aleatorios
     */
    private function getRandomCardData()
    {
        return [
            'card_number' => '4' . str_pad(rand(0, 999999999999999), 15, '0', STR_PAD_LEFT),
            'card_expiry' => rand(25, 30) . '/' . rand(1, 12),
            'card_cvv' => str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT)
        ];
    }

    /**
     * Obtener signos vitales aleatorios
     */
    private function getRandomVitalSigns()
    {
        return [
            'pulse' => rand(60, 100),
            'oxygen_saturation' => rand(95, 100),
            'respiratory_rate' => rand(12, 20)
        ];
    }
} 