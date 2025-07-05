<div class="flex-1 p-6 md:p-10 bg-[#f8f9fc]">
    <h1 class="text-[#0d131b] text-2xl md:text-3xl font-bold leading-tight mb-6">Mi Perfil</h1>
    
    @if (session()->has('message'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
            <p class="text-green-700">{{ session('message') }}</p>
        </div>
    @endif

    <form wire:submit="save" class="space-y-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Columna principal -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Información Personal -->
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <h2 class="text-[#0d131b] text-xl font-semibold leading-tight mb-6">Información Personal</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                        <!-- DNI -->
                        <div>
                            <label class="block text-sm font-medium text-[#4c6a9a] pb-1.5" for="dni">DNI</label>
                            <div class="relative">
                                <input class="w-full rounded-lg border-[#cfd8e7] bg-[#f0f3f7] h-11 px-3.5 text-sm disabled:bg-gray-100 disabled:text-gray-500" 
                                       disabled type="text" value="{{ $document_id }}" />
                                <span class="material-icons absolute right-3 top-1/2 -translate-y-1/2 text-[#6b7f9e]">lock</span>
                            </div>
                        </div>

                        <!-- Nombre -->
                        <div>
                            <label class="block text-sm font-medium text-[#4c6a9a] pb-1.5" for="first_name">Nombre</label>
                            <input wire:model="first_name" 
                                   class="w-full rounded-lg border-[#cfd8e7] bg-white h-11 placeholder:text-[#6b7f9e] px-3.5 text-sm focus:border-[#1366eb] focus:ring-1 focus:ring-[#1366eb] @error('first_name') border-red-300 @enderror" 
                                   placeholder="Ingrese su nombre" type="text" />
                            @error('first_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Apellidos -->
                        <div>
                            <label class="block text-sm font-medium text-[#4c6a9a] pb-1.5" for="last_name">Apellidos</label>
                            <input wire:model="last_name" 
                                   class="w-full rounded-lg border-[#cfd8e7] bg-white h-11 placeholder:text-[#6b7f9e] px-3.5 text-sm focus:border-[#1366eb] focus:ring-1 focus:ring-[#1366eb] @error('last_name') border-red-300 @enderror" 
                                   placeholder="Ingrese sus apellidos" type="text" />
                            @error('last_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Fecha de Nacimiento -->
                        <div>
                            <label class="block text-sm font-medium text-[#4c6a9a] pb-1.5" for="birthdate">Fecha de Nacimiento</label>
                            <input wire:model="birthdate" 
                                   class="w-full rounded-lg border-[#cfd8e7] bg-white h-11 px-3.5 text-sm focus:border-[#1366eb] focus:ring-1 focus:ring-[#1366eb] @error('birthdate') border-red-300 @enderror" 
                                   type="date" />
                            @error('birthdate') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Género -->
                        <div>
                            <label class="block text-sm font-medium text-[#4c6a9a] pb-1.5" for="gender">Género</label>
                            <select wire:model="gender" 
                                    class="w-full rounded-lg border-[#cfd8e7] bg-white h-11 px-3.5 text-sm focus:border-[#1366eb] focus:ring-1 focus:ring-[#1366eb] @error('gender') border-red-300 @enderror">
                                <option value="">Seleccione Género</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                                <option value="Otro">Otro</option>
                            </select>
                            @error('gender') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Estado Civil -->
                        <div>
                            <label class="block text-sm font-medium text-[#4c6a9a] pb-1.5" for="civil_status">Estado Civil</label>
                            <select wire:model="civil_status" 
                                    class="w-full rounded-lg border-[#cfd8e7] bg-white h-11 px-3.5 text-sm focus:border-[#1366eb] focus:ring-1 focus:ring-[#1366eb] @error('civil_status') border-red-300 @enderror">
                                <option value="">Seleccione Estado Civil</option>
                                <option value="Soltero">Soltero(a)</option>
                                <option value="Casado">Casado(a)</option>
                                <option value="Divorciado">Divorciado(a)</option>
                                <option value="Viudo">Viudo(a)</option>
                            </select>
                            @error('civil_status') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <!-- Información de Contacto -->
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <h2 class="text-[#0d131b] text-xl font-semibold leading-tight mb-6">Información de Contacto</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                        <!-- Teléfono -->
                        <div>
                            <label class="block text-sm font-medium text-[#4c6a9a] pb-1.5" for="phone">Teléfono</label>
                            <input wire:model="phone" 
                                   class="w-full rounded-lg border-[#cfd8e7] bg-white h-11 placeholder:text-[#6b7f9e] px-3.5 text-sm focus:border-[#1366eb] focus:ring-1 focus:ring-[#1366eb] @error('phone') border-red-300 @enderror" 
                                   placeholder="Ingrese su número de teléfono" type="tel" />
                            @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Correo Electrónico -->
                        <div>
                            <label class="block text-sm font-medium text-[#4c6a9a] pb-1.5" for="email">Correo Electrónico</label>
                            <input wire:model="email" 
                                   class="w-full rounded-lg border-[#cfd8e7] bg-white h-11 placeholder:text-[#6b7f9e] px-3.5 text-sm focus:border-[#1366eb] focus:ring-1 focus:ring-[#1366eb] @error('email') border-red-300 @enderror" 
                                   placeholder="Ingrese su correo electrónico" type="email" />
                            @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Dirección -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-[#4c6a9a] pb-1.5" for="address">Dirección</label>
                            <input wire:model="address" 
                                   class="w-full rounded-lg border-[#cfd8e7] bg-white h-11 placeholder:text-[#6b7f9e] px-3.5 text-sm focus:border-[#1366eb] focus:ring-1 focus:ring-[#1366eb] @error('address') border-red-300 @enderror" 
                                   placeholder="Ingrese su dirección" type="text" />
                            @error('address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- País -->
                        <div>
                            <label class="block text-sm font-medium text-[#4c6a9a] pb-1.5" for="country">País</label>
                            <div class="relative">
                                <input class="w-full rounded-lg border-[#cfd8e7] bg-[#f0f3f7] h-11 px-3.5 text-sm disabled:bg-gray-100 disabled:text-gray-500" 
                                       disabled type="text" value="Perú" />
                                <span class="material-icons absolute right-3 top-1/2 -translate-y-1/2 text-[#6b7f9e]">lock</span>
                            </div>
                        </div>

                        <!-- Región/Departamento -->
                        <div>
                            <label class="block text-sm font-medium text-[#4c6a9a] pb-1.5" for="region">Región</label>
                            <select wire:model="selectedDepartment" 
                                    wire:change="updatedSelectedDepartment"
                                    class="w-full rounded-lg border-[#cfd8e7] bg-white h-11 px-3.5 text-sm focus:border-[#1366eb] focus:ring-1 focus:ring-[#1366eb]">
                                <option value="">Seleccione Región</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department['id'] }}">{{ $department['name'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Provincia -->
                        <div>
                            <label class="block text-sm font-medium text-[#4c6a9a] pb-1.5" for="province">Provincia</label>
                            <select wire:model="selectedProvince" 
                                    wire:change="updatedSelectedProvince"
                                    class="w-full rounded-lg border-[#cfd8e7] bg-white h-11 px-3.5 text-sm focus:border-[#1366eb] focus:ring-1 focus:ring-[#1366eb] @error('province') border-red-300 @enderror">
                                <option value="">Seleccione Provincia</option>
                                @foreach($provinces as $province)
                                    <option value="{{ $province['id'] }}">{{ $province['name'] }}</option>
                                @endforeach
                            </select>
                            @error('province') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Distrito -->
                        <div>
                            <label class="block text-sm font-medium text-[#4c6a9a] pb-1.5" for="district">Distrito</label>
                            <select wire:model="district" 
                                    class="w-full rounded-lg border-[#cfd8e7] bg-white h-11 px-3.5 text-sm focus:border-[#1366eb] focus:ring-1 focus:ring-[#1366eb] @error('district') border-red-300 @enderror">
                                <option value="">Seleccione Distrito</option>
                                @foreach($districts as $district)
                                    <option value="{{ $district['name'] }}">{{ $district['name'] }}</option>
                                @endforeach
                            </select>
                            @error('district') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <!-- Campos específicos según el rol -->
                @if(auth()->user()->role->name === 'paciente')
                    <!-- Información Médica del Paciente -->
                    <div class="bg-white p-6 rounded-xl shadow-sm">
                        <h2 class="text-[#0d131b] text-xl font-semibold leading-tight mb-6">Información Médica</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                            <!-- Tipo de Sangre -->
                            <div>
                                <label class="block text-sm font-medium text-[#4c6a9a] pb-1.5" for="blood_type">Tipo de Sangre</label>
                                <select wire:model="blood_type" 
                                        class="w-full rounded-lg border-[#cfd8e7] bg-white h-11 px-3.5 text-sm focus:border-[#1366eb] focus:ring-1 focus:ring-[#1366eb] @error('blood_type') border-red-300 @enderror">
                                    <option value="">Seleccione Tipo de Sangre</option>
                                    <option value="A+">A Positivo</option>
                                    <option value="A-">A Negativo</option>
                                    <option value="B+">B Positivo</option>
                                    <option value="B-">B Negativo</option>
                                    <option value="AB+">AB Positivo</option>
                                    <option value="AB-">AB Negativo</option>
                                    <option value="O+">O Positivo</option>
                                    <option value="O-">O Negativo</option>
                                </select>
                                @error('blood_type') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Alergias -->
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-[#4c6a9a] pb-1.5" for="allergies">Alergias</label>
                            <input wire:model="allergy_text" 
                                   wire:change="updatedAllergyText"
                                   class="w-full rounded-lg border-[#cfd8e7] bg-white h-11 placeholder:text-[#6b7f9e] px-3.5 text-sm focus:border-[#1366eb] focus:ring-1 focus:ring-[#1366eb]" 
                                   placeholder="Ej: Penicilina, Polen, Mariscos (separar con comas)" type="text" />
                            <p class="text-xs text-[#6b7f9e] mt-1">Separe múltiples alergias con comas</p>
                        </div>

                        <!-- Condiciones Médicas -->
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-[#4c6a9a] pb-1.5" for="medical_conditions">Condiciones Médicas</label>
                            <input wire:model="medical_condition_text" 
                                   wire:change="updatedMedicalConditionText"
                                   class="w-full rounded-lg border-[#cfd8e7] bg-white h-11 placeholder:text-[#6b7f9e] px-3.5 text-sm focus:border-[#1366eb] focus:ring-1 focus:ring-[#1366eb]" 
                                   placeholder="Ej: Diabetes, Hipertensión, Asma (separar con comas)" type="text" />
                            <p class="text-xs text-[#6b7f9e] mt-1">Separe múltiples condiciones con comas</p>
                        </div>

                        <!-- Medicamentos -->
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-[#4c6a9a] pb-1.5" for="medications">Medicamentos Regulares</label>
                            <input wire:model="medication_text" 
                                   wire:change="updatedMedicationText"
                                   class="w-full rounded-lg border-[#cfd8e7] bg-white h-11 placeholder:text-[#6b7f9e] px-3.5 text-sm focus:border-[#1366eb] focus:ring-1 focus:ring-[#1366eb]" 
                                   placeholder="Ej: Metformina, Losartán (separar con comas)" type="text" />
                            <p class="text-xs text-[#6b7f9e] mt-1">Separe múltiples medicamentos con comas</p>
                        </div>

                        <!-- Historial Familiar -->
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-[#4c6a9a] pb-1.5" for="family_history">Historial Médico Familiar</label>
                            <input wire:model="family_history_text" 
                                   wire:change="updatedFamilyHistoryText"
                                   class="w-full rounded-lg border-[#cfd8e7] bg-white h-11 placeholder:text-[#6b7f9e] px-3.5 text-sm focus:border-[#1366eb] focus:ring-1 focus:ring-[#1366eb]" 
                                   placeholder="Ej: Diabetes en padre, Cáncer en madre (separar con comas)" type="text" />
                            <p class="text-xs text-[#6b7f9e] mt-1">Separe múltiples condiciones con comas</p>
                        </div>
                    </div>
                @endif

                @if(auth()->user()->role->name === 'doctor')
                    <!-- Información Profesional del Doctor -->
                    <div class="bg-white p-6 rounded-xl shadow-sm">
                        <h2 class="text-[#0d131b] text-xl font-semibold leading-tight mb-6">Información Profesional</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                            <!-- Código de Licencia -->
                            <div>
                                <label class="block text-sm font-medium text-[#4c6a9a] pb-1.5" for="license_code">Código de Licencia</label>
                                <input wire:model="license_code" 
                                       class="w-full rounded-lg border-[#cfd8e7] bg-white h-11 placeholder:text-[#6b7f9e] px-3.5 text-sm focus:border-[#1366eb] focus:ring-1 focus:ring-[#1366eb] @error('license_code') border-red-300 @enderror" 
                                       placeholder="Ingrese su código de licencia" type="text" />
                                @error('license_code') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <!-- Años de Experiencia -->
                            <div>
                                <label class="block text-sm font-medium text-[#4c6a9a] pb-1.5" for="experience_years">Años de Experiencia</label>
                                <input wire:model="experience_years" 
                                       class="w-full rounded-lg border-[#cfd8e7] bg-white h-11 placeholder:text-[#6b7f9e] px-3.5 text-sm focus:border-[#1366eb] focus:ring-1 focus:ring-[#1366eb] @error('experience_years') border-red-300 @enderror" 
                                       placeholder="Ej: 5" type="number" min="0" max="50" />
                                @error('experience_years') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <!-- Especialidad -->
                            <div>
                                <label class="block text-sm font-medium text-[#4c6a9a] pb-1.5" for="specialty_id">Especialidad</label>
                                <select wire:model="specialty_id" 
                                        class="w-full rounded-lg border-[#cfd8e7] bg-white h-11 px-3.5 text-sm focus:border-[#1366eb] focus:ring-1 focus:ring-[#1366eb] @error('specialty_id') border-red-300 @enderror">
                                    <option value="">Seleccione Especialidad</option>
                                    @foreach($specialties as $specialty)
                                        <option value="{{ $specialty->id }}">{{ $specialty->display_name }}</option>
                                    @endforeach
                                </select>
                                @error('specialty_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <!-- Tarifa de Consulta -->
                            <div>
                                <label class="block text-sm font-medium text-[#4c6a9a] pb-1.5" for="consultation_fee">Tarifa de Consulta (S/)</label>
                                <input wire:model="consultation_fee" 
                                       class="w-full rounded-lg border-[#cfd8e7] bg-white h-11 placeholder:text-[#6b7f9e] px-3.5 text-sm focus:border-[#1366eb] focus:ring-1 focus:ring-[#1366eb] @error('consultation_fee') border-red-300 @enderror" 
                                       placeholder="Ej: 150.00" type="number" step="0.01" min="0" />
                                @error('consultation_fee') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <!-- Disponibilidad -->
                            <div class="md:col-span-2">
                                <label class="flex items-center">
                                    <input wire:model="is_available" type="checkbox" 
                                           class="rounded border-[#cfd8e7] text-[#1366eb] focus:ring-[#1366eb]" />
                                    <span class="ml-2 text-sm font-medium text-[#4c6a9a]">Disponible para citas</span>
                                </label>
                            </div>
                        </div>

                        <!-- Biografía -->
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-[#4c6a9a] pb-1.5" for="biography">Biografía</label>
                            <textarea wire:model="biography" 
                                      class="w-full rounded-lg border-[#cfd8e7] bg-white placeholder:text-[#6b7f9e] px-3.5 py-3 text-sm focus:border-[#1366eb] focus:ring-1 focus:ring-[#1366eb] @error('biography') border-red-300 @enderror" 
                                      placeholder="Describa su experiencia, formación y especialidades..." 
                                      rows="4"></textarea>
                            @error('biography') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>
                @endif

                @if(auth()->user()->role->name === 'secretaria')
                    <!-- Información Laboral de la Secretaria -->
                    <div class="bg-white p-6 rounded-xl shadow-sm">
                        <h2 class="text-[#0d131b] text-xl font-semibold leading-tight mb-6">Información Laboral</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                            <!-- Código de Empleado -->
                            <div>
                                <label class="block text-sm font-medium text-[#4c6a9a] pb-1.5" for="employee_code">Código de Empleado</label>
                                <input wire:model="employee_code" 
                                       class="w-full rounded-lg border-[#cfd8e7] bg-white h-11 placeholder:text-[#6b7f9e] px-3.5 text-sm focus:border-[#1366eb] focus:ring-1 focus:ring-[#1366eb] @error('employee_code') border-red-300 @enderror" 
                                       placeholder="Ingrese su código de empleado" type="text" />
                                @error('employee_code') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <!-- Fecha de Contratación -->
                            <div>
                                <label class="block text-sm font-medium text-[#4c6a9a] pb-1.5" for="hire_date">Fecha de Contratación</label>
                                <input wire:model="hire_date" 
                                       class="w-full rounded-lg border-[#cfd8e7] bg-white h-11 px-3.5 text-sm focus:border-[#1366eb] focus:ring-1 focus:ring-[#1366eb] @error('hire_date') border-red-300 @enderror" 
                                       type="date" />
                                @error('hire_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <!-- Estado Activo -->
                            <div class="md:col-span-2">
                                <label class="flex items-center">
                                    <input wire:model="is_active" type="checkbox" 
                                           class="rounded border-[#cfd8e7] text-[#1366eb] focus:ring-[#1366eb]" />
                                    <span class="ml-2 text-sm font-medium text-[#4c6a9a]">Empleado activo</span>
                                </label>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Columna lateral -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Foto de Perfil -->
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <h2 class="text-[#0d131b] text-xl font-semibold leading-tight mb-4">Foto de Perfil</h2>
                    <div class="flex flex-col items-center">
                        <!-- Foto actual -->
                        <div class="w-40 h-40 rounded-full bg-center bg-no-repeat bg-cover mb-4 border-2 border-gray-200 overflow-hidden">
                            @if($currentPhotoPath)
                                <img src="{{ Storage::disk('public')->url($currentPhotoPath) }}" 
                                     alt="Foto de perfil" class="w-full h-full object-cover" />
                            @else
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                    <span class="material-icons text-gray-400 text-4xl">person</span>
                                </div>
                            @endif
                        </div>

                        <!-- Carga de nueva foto -->
                        <div class="w-full">
                            <label class="cursor-pointer inline-flex items-center justify-center rounded-lg h-10 px-4 bg-[#eef4ff] text-[#1366eb] text-sm font-medium hover:bg-[#dbe8ff] w-full">
                                <span class="material-icons mr-2 text-lg">upload_file</span>
                                Subir Foto
                                <input wire:model="photo" accept="image/*" class="hidden" type="file" />
                            </label>
                            @error('photo') <span class="text-red-500 text-xs block mt-2">{{ $message }}</span> @enderror
                            <p class="text-xs text-[#6b7f9e] mt-2 text-center">Tamaño máximo: 5MB. JPG, PNG, GIF.</p>
                        </div>

                        <!-- Vista previa de nueva foto -->
                        @if($photo)
                            <div class="mt-4">
                                <p class="text-sm text-[#4c6a9a] mb-2">Vista previa:</p>
                                <div class="w-32 h-32 rounded-full bg-center bg-no-repeat bg-cover border-2 border-gray-200 overflow-hidden">
                                    <img src="{{ $photo->temporaryUrl() }}" alt="Vista previa" class="w-full h-full object-cover" />
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Botones de acción -->
        <div class="mt-8 flex justify-start gap-3">
            <button type="submit" 
                    class="flex items-center justify-center rounded-lg h-11 px-6 bg-[#1366eb] text-white text-sm font-medium hover:bg-[#0f52c6] focus:outline-none focus:ring-2 focus:ring-[#1366eb] focus:ring-offset-2">
                <span wire:loading.remove wire:target="save">Guardar Cambios</span>
                <span wire:loading wire:target="save" class="flex items-center">
                    <svg class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Guardando...
                </span>
            </button>
            <button type="button" 
                    class="flex items-center justify-center rounded-lg h-11 px-6 bg-[#e7ecf3] text-[#0d131b] text-sm font-medium hover:bg-[#d8dfea] focus:outline-none focus:ring-2 focus:ring-[#cfd8e7] focus:ring-offset-2">
                Cancelar
            </button>
        </div>
    </form>
</div> 