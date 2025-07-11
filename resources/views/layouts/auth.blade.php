<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link crossorigin href="https://fonts.gstatic.com/" rel="preconnect" />
    <link as="style"
        href="https://fonts.googleapis.com/css2?display=swap&amp;family=Noto+Sans%3Awght%40400%3B500%3B700%3B900&amp;family=Public+Sans%3Awght%40400%3B500%3B600%3B700%3B900"
        onload="this.rel='stylesheet'" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
        rel="stylesheet" />
    <title>HealthPlus - @yield('title', 'Autenticación')</title>
    <link href="data:image/x-icon;base64," rel="icon" type="image/x-icon" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0c7ff2',
                        'primary-hover': '#0069d9',
                        secondary: '#6c757d',
                        light: '#f8f9fa',
                        dark: '#343a40',
                        danger: '#dc3545',
                        'input-border': '#cedbe8',
                        'input-focus-border': '#80bdff',
                        'placeholder-text': '#6c757d',
                        'heading-text': '#212529',
                        'body-text': '#495057',
                        'link-text': '#0c7ff2',
                    },
                    boxShadow: {
                        'card': '0 4px 8px rgba(0, 0, 0, 0.1), 0 6px 20px rgba(0, 0, 0, 0.1)',
                    }
                }
            }
        }
    </script>
    <style>
        .form-input:focus {
            outline: 2px solid #0c7ff2 !important;
            outline-offset: 1px !important;
            border-color: transparent !important;
        }
    </style>
</head>
<body class="bg-light font-['Public_Sans'] text-body-text">
    <div class="flex flex-col min-h-screen">
        <!-- Header -->
        <header class="bg-white shadow-sm">
            <nav class="container mx-auto px-6 py-4 flex items-center justify-between">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <div class="text-primary w-10 h-10">
                        <span class="material-icons text-4xl">local_hospital</span>
                    </div>
                    <h1 class="text-heading-text text-xl font-semibold">HealthPlus</h1>
                </a>
                @if(request()->routeIs('login'))
                    <a class="px-4 py-2 text-sm font-medium text-white bg-primary hover:bg-primary-hover rounded-lg transition-colors" href="{{ route('register') }}">
                        Registrarse
                    </a>
                @else
                    <a class="px-4 py-2 text-sm font-medium text-white bg-primary hover:bg-primary-hover rounded-lg transition-colors" href="{{ route('login') }}">
                        Iniciar Sesión
                    </a>
                @endif
            </nav>
        </header>

        <!-- Main Content -->
        <main class="flex-grow">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-slate-800 text-slate-300">
            <div class="container mx-auto px-6 py-12 md:py-16">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                    <div>
                        <a href="{{ route('home') }}" class="flex items-center gap-3 text-blue-400 mb-4">
                            <span class="material-icons text-3xl">local_hospital</span>
                            <h2 class="text-xl font-bold">HealthPlus</h2>
                        </a>
                        <p class="text-sm leading-relaxed">123 Health St, Wellness City, HC 45678</p>
                        <p class="text-sm leading-relaxed">Teléfono: (123) 456-7890</p>
                        <p class="text-sm leading-relaxed">Correo electrónico: info@healthplus.com</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-4">Enlaces Rápidos</h3>
                        <ul class="space-y-2">
                            <li><a class="hover:text-blue-400 transition-colors text-sm" href="{{ route('home') }}">Inicio</a></li>
                            <li><a class="hover:text-blue-400 transition-colors text-sm" href="{{ route('home') }}#especialidades">Especialidades</a></li>
                            <li><a class="hover:text-blue-400 transition-colors text-sm" href="{{ route('home') }}#equipo-medico">Equipo Médico</a></li>
                            <li><a class="hover:text-blue-400 transition-colors text-sm" href="{{ route('home') }}#contacto">Contacto</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-4">Conéctate con Nosotros</h3>
                        <div class="flex space-x-4">
                            <a class="text-slate-400 hover:text-blue-400 transition-colors" href="#">
                                <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path clip-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" fill-rule="evenodd"></path>
                                </svg>
                                <span class="sr-only">Facebook</span>
                            </a>
                            <a class="text-slate-400 hover:text-blue-400 transition-colors" href="#">
                                <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                                </svg>
                                <span class="sr-only">Twitter</span>
                            </a>
                            <a class="text-slate-400 hover:text-blue-400 transition-colors" href="#">
                                <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path clip-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.024.06 1.378.06 3.808s-.012 2.784-.06 3.808c-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.024.048-1.378.06-3.808.06s-2.784-.013-3.808-.06c-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.048-1.024-.06-1.378-.06-3.808s.012-2.784.06-3.808c.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.023.047 1.351.058 3.807.058h.468c2.456 0 2.784-.011 3.807-.058.975-.045 1.504-.207 1.857-.344.467-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.047-1.023.058-1.351-.058-3.807v-.468c0-2.456-.011-2.784-.058-3.807-.045-.975-.207-1.504-.344-1.857a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" fill-rule="evenodd"></path>
                                </svg>
                                <span class="sr-only">Instagram</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="border-t border-slate-700 pt-8 mt-8 flex flex-col md:flex-row justify-between items-center text-sm">
                    <p class="text-slate-400 mb-4 md:mb-0">© 2024 HealthPlus. Todos los derechos reservados.</p>
                    <div class="flex space-x-4">
                        <a class="text-slate-400 hover:text-blue-400 transition-colors" href="#">Términos de Servicio</a>
                        <a class="text-slate-400 hover:text-blue-400 transition-colors" href="#">Política de Privacidad</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    @stack('scripts')
</body>
</html> 