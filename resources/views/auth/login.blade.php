@extends('layouts.auth')

@section('title', 'SaludIntegra - Iniciar Sesión')

@section('header-action')
    <a class="px-4 py-2 text-sm font-medium text-white bg-primary hover:bg-primary-hover rounded-lg transition-colors"
        href="{{ route('register') }}">
        Registrarse
    </a>
@endsection

@section('content')
<div class="flex-grow flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
        <div class="bg-white p-8 shadow-card rounded-xl">
            <div class="flex justify-center mb-6">
                <div class="flex items-center gap-3 text-primary">
                    <span class="material-icons text-5xl">local_hospital</span>
                    <h1 class="text-3xl font-bold tracking-tight">HealthPlus</h1>
                </div>
            </div>
            <form action="{{ route('login') }}" class="space-y-6" method="POST">
                @csrf
                <input name="remember" type="hidden" value="true" />
                <div class="rounded-md -space-y-px">
                    <div>
                        <label class="sr-only" for="dni">DNI</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="material-icons text-gray-400">person</span>
                            </div>
                            <input
                                class="appearance-none rounded-lg relative block w-full px-3 py-3 pl-10 border border-input-border placeholder-placeholder-text text-body-text focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm @error('dni') border-red-500 @enderror"
                                id="dni" name="dni" placeholder="Ingrese su DNI" required
                                type="text" value="{{ old('dni') }}" />
                        </div>
                        @error('dni')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="pt-4">
                        <label class="sr-only" for="password">Contraseña</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="material-icons text-gray-400">lock</span>
                            </div>
                            <input autocomplete="current-password"
                                class="appearance-none rounded-lg relative block w-full px-3 py-3 pl-10 border border-input-border placeholder-placeholder-text text-body-text focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm @error('password') border-red-500 @enderror"
                                id="password" name="password"
                                placeholder="Ingrese su contraseña" required
                                type="password" />
                            <button
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5"
                                id="togglePassword" type="button">
                                <span
                                    class="material-icons text-gray-500 hover:text-gray-700">visibility</span>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="flex items-center justify-end text-sm">
                    <a class="font-medium text-link-text hover:text-primary-hover"
                        href="#">
                        ¿Olvidó su contraseña?
                    </a>
                </div>
                <div>
                    <button
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-primary hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors"
                        type="submit">
                        Iniciar Sesión
                    </button>
                </div>
                <div class="text-center text-sm">
                    <p class="text-body-text">¿No tiene cuenta? <a
                            class="font-semibold text-link-text hover:text-primary-hover"
                            href="{{ route('register') }}">Regístrese aquí</a></p>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');
    const eyeIcon = togglePassword.querySelector('.material-icons');
    togglePassword.addEventListener('click', function(e) {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        eyeIcon.textContent = type === 'password' ? 'visibility' : 'visibility_off';
    });
</script>
@endsection 