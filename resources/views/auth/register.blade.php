@extends('layouts.auth')

@section('title', 'SaludIntegra - Registro')

@section('header-action')
    <a class="flex items-center justify-center rounded-lg bg-primary px-4 py-2 text-sm font-semibold text-white transition-colors hover:bg-primary-hover focus:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 focus-visible:ring-offset-slate-50"
        href="{{ route('login') }}">
        <span>Iniciar Sesión</span>
    </a>
@endsection

@push('styles')
<style type="text/tailwindcss">
    :root {
        --checkbox-tick-svg: url('data:image/svg+xml,%3csvg viewBox=%270 0 16 16%27 fill=%27rgb(248,250,252)%27 xmlns=%27http://www.w3.org/2000/svg%27%3e%3cpath d=%27M12.207 4.793a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0l-2-2a1 1 0 011.414-1.414L6.5 9.086l4.293-4.293a1 1 0 011.414 0z%27/%3e%3c/svg%3e');
    }
    .form-input:focus {
        outline: 2px solid #0c7ff2 !important;
        outline-offset: 1px !important;
        border-color: transparent !important;
    }
</style>
@endpush

@section('content')
<div class="flex flex-1 justify-center py-10 sm:py-16">
    <div class="w-full max-w-md rounded-xl bg-white p-6 shadow-xl sm:p-8">
        <div class="mb-6 flex flex-col items-center">
            <div class="mb-4 flex items-center gap-3 text-primary">
                <span class="material-icons text-5xl">local_hospital</span>
                <h1 class="text-3xl font-bold tracking-tight">HealthPlus</h1>
            </div>
            <h2 class="mb-2 text-center text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Crear nueva Cuenta</h2>
        </div>
        <form class="space-y-6" action="{{ route('register.store') }}" method="POST">
            @csrf
            <div>
                <label class="block pb-1.5 text-sm font-medium text-slate-700" for="dni">DNI</label>
                <input
                    class="form-input block w-full rounded-lg border-slate-300 bg-slate-50 p-3 text-sm text-slate-900 placeholder-slate-400 shadow-sm focus:border-[#0c7ff2] focus:ring-[#0c7ff2] @error('dni') border-red-500 @enderror"
                    id="dni" name="dni" placeholder="Ingrese su número de DNI" type="text" value="{{ old('dni') }}" />
                @error('dni')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="relative">
                <label class="block pb-1.5 text-sm font-medium text-slate-700" for="password">Crear Contraseña</label>
                <input
                    class="form-input block w-full rounded-lg border-slate-300 bg-slate-50 p-3 pr-10 text-sm text-slate-900 placeholder-slate-400 shadow-sm focus:border-[#0c7ff2] focus:ring-[#0c7ff2] @error('password') border-red-500 @enderror"
                    id="password" name="password" placeholder="Mínimo 8 caracteres" type="password" />
                <button
                    class="absolute inset-y-0 right-0 top-7 flex items-center pr-3 text-slate-400 hover:text-slate-600"
                    type="button">
                    <span class="material-icons text-xl">visibility_off</span>
                </button>
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="relative">
                <label class="block pb-1.5 text-sm font-medium text-slate-700" for="confirm-password">Confirmar Contraseña</label>
                <input
                    class="form-input block w-full rounded-lg border-slate-300 bg-slate-50 p-3 pr-10 text-sm text-slate-900 placeholder-slate-400 shadow-sm focus:border-[#0c7ff2] focus:ring-[#0c7ff2] @error('password_confirmation') border-red-500 @enderror"
                    id="confirm-password" name="password_confirmation" placeholder="Repita su contraseña" type="password" />
                <button
                    class="absolute inset-y-0 right-0 top-7 flex items-center pr-3 text-slate-400 hover:text-slate-600"
                    type="button">
                    <span class="material-icons text-xl">visibility_off</span>
                </button>
                @error('password_confirmation')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex items-start">
                <div class="flex h-5 items-center">
                    <input
                        class="h-4 w-4 rounded border-slate-300 bg-slate-50 text-[#0c7ff2] checked:border-[#0c7ff2] checked:bg-[#0c7ff2] checked:bg-[image:var(--checkbox-tick-svg)] focus:ring-2 focus:ring-[#0c7ff2] focus:ring-offset-2 focus:ring-offset-white @error('terms') border-red-500 @enderror"
                        id="terms" name="terms" type="checkbox" {{ old('terms') ? 'checked' : '' }} />
                </div>
                <div class="ml-3 text-sm">
                    <label class="font-normal text-slate-600" for="terms">
                        He leído y acepto los
                        <a class="font-medium text-[#0c7ff2] hover:underline" href="#">Términos y Condiciones</a>
                        y la
                        <a class="font-medium text-[#0c7ff2] hover:underline" href="#">Política de Privacidad</a>.
                    </label>
                </div>
            </div>
            @error('terms')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror

            @if ($errors->any())
                <div class="rounded-md bg-red-50 p-3 text-sm text-red-600">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <button
                class="flex w-full cursor-pointer items-center justify-center rounded-lg bg-[#0c7ff2] px-5 py-3 text-base font-semibold text-white shadow-md transition-colors hover:bg-blue-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#0c7ff2] focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                type="submit">
                <span>Registrarme</span>
            </button>
            <div class="mt-6 text-center text-sm text-slate-600">
                ¿Ya tiene una cuenta?
                <a class="font-medium text-[#0c7ff2] hover:underline" href="{{ route('login') }}">Inicie Sesión</a>
            </div>
        </form>
    </div>
</div>

<script>
    // Basic form validation and button enable/disable
    const form = document.querySelector('form');
    const dniInput = document.getElementById('dni');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm-password');
    const termsCheckbox = document.getElementById('terms');
    const registerButton = form.querySelector('button[type="submit"]');

    function validateForm() {
        const dniFilled = dniInput.value.trim() !== '';
        const passwordFilled = passwordInput.value.trim() !== '';
        const confirmPasswordFilled = confirmPasswordInput.value.trim() !== '';
        const passwordsMatch = passwordInput.value === confirmPasswordInput.value;
        const termsAccepted = termsCheckbox.checked;
        let isValid = dniFilled && passwordFilled && confirmPasswordFilled && passwordsMatch && termsAccepted;
        registerButton.disabled = !isValid;
        return isValid;
    }

    [dniInput, passwordInput, confirmPasswordInput, termsCheckbox].forEach(input => {
        input.addEventListener('input', validateForm);
        input.addEventListener('change', validateForm); // For checkbox
    });

    // Password visibility toggle
    const passwordToggleButtons = document.querySelectorAll('.relative button[type="button"]');
    passwordToggleButtons.forEach(button => {
        button.addEventListener('click', () => {
            const input = button.previousElementSibling;
            const icon = button.querySelector('.material-icons');
            if (input.type === 'password') {
                input.type = 'text';
                icon.textContent = 'visibility';
            } else {
                input.type = 'password';
                icon.textContent = 'visibility_off';
            }
        });
    });
</script>
@endsection 