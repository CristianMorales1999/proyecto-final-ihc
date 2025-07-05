<?php

namespace App\Livewire\Profile;

use App\Models\Profile;
use App\Models\User;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Secretary;
use App\Models\Specialty;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Rule;

class EditProfile extends Component
{
    use WithFileUploads;

    // Propiedades del perfil básico
    public $email;
    public $first_name;
    public $last_name;
    public $address;
    public $phone;
    public $birthdate;
    public $gender;
    public $civil_status;
    public $region;
    public $province;
    public $district;

    // Propiedades para ubigeo
    public $departments = [];
    public $provinces = [];
    public $districts = [];
    public $selectedDepartment = '';
    public $selectedProvince = '';

    // Propiedades para foto
    public $photo;
    public $currentPhotoPath;
    public $document_id;

    // Propiedades específicas para PACIENTES
    public $blood_type;
    public $allergies = [];
    public $medical_conditions = [];
    public $medications = [];
    public $family_history = [];
    public $emergency_contact = [];

    // Propiedades específicas para DOCTORES
    public $license_code;
    public $experience_years;
    public $biography;
    public $consultation_fee;
    public $is_available;
    public $specialty_id;
    public $specialties = [];

    // Propiedades específicas para SECRETARIAS
    public $employee_code;
    public $hire_date;
    public $is_active;

    // Propiedades para manejo de arrays
    public $allergy_text = '';
    public $medical_condition_text = '';
    public $medication_text = '';
    public $family_history_text = '';

    protected function rules()
    {
        $user = Auth::user();
        $profileId = $user->profile ? $user->profile->id : null;
        
        $rules = [
            'email' => 'nullable|email|unique:profiles,email,' . $profileId,
            'first_name' => 'nullable|string|max:50',
            'last_name' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:12',
            'birthdate' => 'nullable|date',
            'gender' => 'nullable|in:Masculino,Femenino,Otro',
            'civil_status' => 'nullable|in:Soltero,Casado,Viudo,Divorciado',
            'region' => 'nullable|string|max:50',
            'province' => 'nullable|string|max:50',
            'district' => 'nullable|string|max:50',
            'photo' => 'nullable|image|max:5120', // 5MB max
        ];

        // Reglas específicas según el rol
        if ($user->role->name === 'paciente') {
            $rules = array_merge($rules, [
                'blood_type' => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
                'allergies' => 'nullable|array',
                'medical_conditions' => 'nullable|array',
                'medications' => 'nullable|array',
                'family_history' => 'nullable|array',
                'emergency_contact' => 'nullable|array',
            ]);
        } elseif ($user->role->name === 'doctor') {
            $rules = array_merge($rules, [
                'license_code' => 'nullable|string|max:20',
                'experience_years' => 'nullable|integer|min:0|max:50',
                'biography' => 'nullable|string|max:1000',
                'consultation_fee' => 'nullable|numeric|min:0',
                'is_available' => 'boolean',
                'specialty_id' => 'nullable|exists:specialties,id',
            ]);
        } elseif ($user->role->name === 'secretaria') {
            $rules = array_merge($rules, [
                'employee_code' => 'nullable|string|max:20',
                'hire_date' => 'nullable|date',
                'is_active' => 'boolean',
            ]);
        }

        return $rules;
    }

    public function mount()
    {
        $user = Auth::user();
        $this->document_id = $user->document_id;
        
        // Cargar datos del perfil si existe
        if ($user->profile) {
            $profile = $user->profile;
            $this->email = $profile->email;
            $this->first_name = $profile->first_name;
            $this->last_name = $profile->last_name;
            $this->address = $profile->address;
            $this->phone = $profile->phone;
            $this->birthdate = $profile->birthdate;
            $this->gender = $profile->gender;
            $this->civil_status = $profile->civil_status;
            $this->region = $profile->region;
            $this->province = $profile->province;
            $this->district = $profile->district;
            $this->currentPhotoPath = $profile->photo_path;
        }

        // Cargar datos específicos según el rol
        $this->loadRoleSpecificData($user);

        // Cargar departamentos
        $this->loadDepartments();
        
        // Si ya tiene región y provincia, cargar las opciones correspondientes
        if ($this->region) {
            $this->loadRegionData();
        }
    }

    public function loadRoleSpecificData($user)
    {
        if ($user->role->name === 'paciente' && $user->patient) {
            $patient = $user->patient;
            $this->blood_type = $patient->blood_type;
            $this->allergies = $patient->allergies ?? [];
            $this->medical_conditions = $patient->medical_conditions ?? [];
            $this->medications = $patient->medications ?? [];
            $this->family_history = $patient->family_history ?? [];
            $this->emergency_contact = $patient->emergency_contact ?? [];
            
            // Convertir arrays a texto para los inputs
            $this->allergy_text = implode(', ', $this->allergies);
            $this->medical_condition_text = implode(', ', $this->medical_conditions);
            $this->medication_text = implode(', ', $this->medications);
            $this->family_history_text = implode(', ', $this->family_history);
        } elseif ($user->role->name === 'doctor' && $user->doctor) {
            $doctor = $user->doctor;
            $this->license_code = $doctor->license_code;
            $this->experience_years = $doctor->experience_years;
            $this->biography = $doctor->biography;
            $this->consultation_fee = $doctor->consultation_fee;
            $this->is_available = $doctor->is_available;
            $this->specialty_id = $doctor->specialty_id;
            
            // Cargar especialidades
            $this->specialties = Specialty::all();
        } elseif ($user->role->name === 'secretaria' && $user->secretary) {
            $secretary = $user->secretary;
            $this->employee_code = $secretary->employee_code;
            $this->hire_date = $secretary->hire_date;
            $this->is_active = $secretary->is_active;
        }
    }

    public function loadDepartments()
    {
        $departmentsJson = file_get_contents(public_path('js/ubigeo_peru_2016_departamentos.json'));
        $this->departments = json_decode($departmentsJson, true);
    }

    public function loadRegionData()
    {
        // Buscar el departamento por nombre
        foreach ($this->departments as $dept) {
            if ($dept['name'] === $this->region) {
                $this->selectedDepartment = $dept['id'];
                $this->loadProvinces();
                break;
            }
        }
    }

    public function loadProvinces()
    {
        if ($this->selectedDepartment) {
            $provincesJson = file_get_contents(public_path('js/ubigeo_peru_2016_provincias.json'));
            $allProvinces = json_decode($provincesJson, true);
            
            $this->provinces = array_filter($allProvinces, function($province) {
                return $province['department_id'] === $this->selectedDepartment;
            });
            
            // Si ya tiene provincia, buscar y seleccionar
            if ($this->province) {
                foreach ($this->provinces as $prov) {
                    if ($prov['name'] === $this->province) {
                        $this->selectedProvince = $prov['id'];
                        $this->loadDistricts();
                        break;
                    }
                }
            }
        }
    }

    public function loadDistricts()
    {
        if ($this->selectedProvince) {
            $districtsJson = file_get_contents(public_path('js/ubigeo_peru_2016_distritos.json'));
            $allDistricts = json_decode($districtsJson, true);
            
            $this->districts = array_filter($allDistricts, function($district) {
                return $district['province_id'] === $this->selectedProvince;
            });
        }
    }

    public function updatedSelectedDepartment()
    {
        $this->selectedProvince = '';
        $this->province = '';
        $this->district = '';
        $this->provinces = [];
        $this->districts = [];

        if ($this->selectedDepartment) {
            // Actualizar el nombre de la región
            foreach ($this->departments as $dept) {
                if ($dept['id'] === $this->selectedDepartment) {
                    $this->region = $dept['name'];
                    break;
                }
            }
            
            $this->loadProvinces();
        } else {
            $this->region = '';
        }
    }

    public function updatedSelectedProvince()
    {
        $this->district = '';
        $this->districts = [];

        if ($this->selectedProvince) {
            // Actualizar el nombre de la provincia
            foreach ($this->provinces as $prov) {
                if ($prov['id'] === $this->selectedProvince) {
                    $this->province = $prov['name'];
                    break;
                }
            }
            
            $this->loadDistricts();
        } else {
            $this->province = '';
        }
    }

    // Métodos para manejar arrays de texto
    public function updatedAllergyText()
    {
        $this->allergies = array_filter(array_map('trim', explode(',', $this->allergy_text)));
    }

    public function updatedMedicalConditionText()
    {
        $this->medical_conditions = array_filter(array_map('trim', explode(',', $this->medical_condition_text)));
    }

    public function updatedMedicationText()
    {
        $this->medications = array_filter(array_map('trim', explode(',', $this->medication_text)));
    }

    public function updatedFamilyHistoryText()
    {
        $this->family_history = array_filter(array_map('trim', explode(',', $this->family_history_text)));
    }

    public function save()
    {
        $this->validate();

        $user = Auth::user();
        
        // Crear o actualizar perfil básico
        $profile = $user->profile ?? new Profile();
        $profile->user_id = $user->id;
        $profile->email = $this->email;
        $profile->first_name = $this->first_name;
        $profile->last_name = $this->last_name;
        $profile->address = $this->address;
        $profile->phone = $this->phone;
        $profile->birthdate = $this->birthdate;
        $profile->gender = $this->gender;
        $profile->civil_status = $this->civil_status;
        $profile->region = $this->region;
        $profile->province = $this->province;
        $profile->district = $this->district;

        // Manejar carga de foto
        if ($this->photo) {
            // Eliminar foto anterior si existe
            if ($this->currentPhotoPath && Storage::disk('public')->exists($this->currentPhotoPath)) {
                Storage::disk('public')->delete($this->currentPhotoPath);
            }

            // Guardar nueva foto
            $photoPath = $this->photo->store('profile-photos', 'public');
            $profile->photo_path = $photoPath;
            $this->currentPhotoPath = $photoPath;
        }

        $profile->save();

        // Guardar datos específicos según el rol
        $this->saveRoleSpecificData($user);

        session()->flash('message', 'Perfil actualizado correctamente.');
    }

    public function saveRoleSpecificData($user)
    {
        if ($user->role->name === 'paciente') {
            $patient = $user->patient ?? new Patient();
            $patient->user_id = $user->id;
            $patient->blood_type = $this->blood_type;
            $patient->allergies = $this->allergies;
            $patient->medical_conditions = $this->medical_conditions;
            $patient->medications = $this->medications;
            $patient->family_history = $this->family_history;
            $patient->emergency_contact = $this->emergency_contact;
            $patient->is_active = true;
            $patient->save();
        } elseif ($user->role->name === 'doctor') {
            $doctor = $user->doctor ?? new Doctor();
            $doctor->user_id = $user->id;
            $doctor->license_code = $this->license_code;
            $doctor->experience_years = $this->experience_years;
            $doctor->biography = $this->biography;
            $doctor->consultation_fee = $this->consultation_fee;
            $doctor->is_available = $this->is_available;
            $doctor->specialty_id = $this->specialty_id;
            $doctor->save();
        } elseif ($user->role->name === 'secretaria') {
            $secretary = $user->secretary ?? new Secretary();
            $secretary->user_id = $user->id;
            $secretary->employee_code = $this->employee_code;
            $secretary->hire_date = $this->hire_date;
            $secretary->is_active = $this->is_active;
            $secretary->save();
        }
    }

    public function render()
    {
        return view('livewire.profile.edit-profile');
    }
} 