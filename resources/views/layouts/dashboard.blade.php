<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'HealthPlus') }} - @yield('title', 'Dashboard')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .material-icons {
            font-family: 'Material Icons';
            font-weight: normal;
            font-style: normal;
            font-size: 24px;
            display: inline-block;
            line-height: 1;
            text-transform: none;
            letter-spacing: normal;
            word-wrap: normal;
            white-space: nowrap;
            direction: ltr;
            -webkit-font-smoothing: antialiased;
            text-rendering: optimizeLegibility;
            -moz-osx-font-smoothing: grayscale;
            font-feature-settings: 'liga';
        }
        
        .active-nav-link {
            @apply bg-[#eef4ff] text-[#1366eb] font-semibold shadow-sm;
        }
        .active-nav-link .material-symbols-outlined {
            @apply text-[#1366eb];
        }
        
        .nav-link {
            @apply transition-all duration-200 ease-in-out;
        }
        
        .nav-link:hover {
            @apply transform translate-x-1;
        }
    </style>
</head>
<body class="bg-[#f8f9fc] font-sans antialiased">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="sticky top-0 z-50 flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#e7ecf3] bg-white px-6 py-3 shadow-sm md:px-10">
            <div class="flex items-center gap-4 text-[#0d131b]">
                <button class="md:hidden text-[#0d131b]">
                    <span class="material-icons text-2xl">menu</span>
                </button>
                <div class="flex items-center gap-2">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 hover:opacity-80 transition-opacity">
                        <span class="material-icons text-3xl text-blue-600">local_hospital</span>
                        <h2 class="hidden text-[#0d131b] text-xl font-bold leading-tight tracking-[-0.015em] md:block">HealthPlus</h2>
                    </a>
                </div>
                <h2 class="md:hidden text-[#0d131b] text-lg font-semibold leading-tight tracking-[-0.015em] absolute left-1/2 -translate-x-1/2">
                    @yield('page-title', 'Dashboard')
                </h2>
            </div>
            
            <div class="flex items-center gap-4">
                <button aria-label="Notificaciones" class="flex cursor-pointer items-center justify-center overflow-hidden rounded-full h-10 w-10 hover:bg-[#e7ecf3] text-[#0d131b]">
                    <span class="material-icons text-2xl">notifications</span>
                </button>
                
                <div class="relative group">
                    <button class="flex items-center gap-2 cursor-pointer">
                        <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10 border-2 border-white shadow" 
                             style="background-image: url('{{ auth()->user()->profile?->photo_path ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->full_name) . '&color=1366eb&background=eef4ff' }}')">
                        </div>
                        <span class="hidden md:inline text-sm font-medium text-[#0d131b]">{{ auth()->user()->full_name }}</span>
                        <span class="material-icons hidden md:inline text-lg text-[#4c6a9a]">expand_more</span>
                    </button>
                    
                    <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-20 hidden group-hover:block">
                        <a class="block px-4 py-2 text-sm text-[#0d131b] hover:bg-[#eef4ff]" href="{{ route('settings.profile') }}">Mi Perfil</a>
                        <a class="block px-4 py-2 text-sm text-[#0d131b] hover:bg-[#eef4ff]" href="{{ route('settings.appearance') }}">Configuración</a>
                        <a class="block px-4 py-2 text-sm {{ request()->routeIs('home') ? 'text-[#1366eb] font-medium' : 'text-[#0d131b]' }} hover:bg-[#eef4ff]" href="{{ route('home') }}">Inicio</a>
                        <a class="block px-4 py-2 text-sm {{ request()->routeIs('dashboard') ? 'text-[#1366eb] font-medium' : 'text-[#0d131b]' }} hover:bg-[#eef4ff]" href="{{ route('dashboard') }}">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}" class="block">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                Cerrar Sesión
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content with Sidebar -->
        <div class="flex flex-1">
            <!-- Sidebar -->
            <aside class="hidden md:flex w-64 flex-col bg-white border-r border-solid border-r-[#e7ecf3] fixed top-[69px] left-0 h-[calc(100vh-69px)]">
                <!-- Contenido del sidebar con scroll -->
                <div class="flex flex-col h-full">
                    <!-- Navegación principal -->
                    <div class="flex-1 overflow-y-auto p-4">
                        <nav class="flex flex-col gap-2">
                            <!-- Dashboard - Común para todos los roles -->
                            <a class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-[#4c6a9a] hover:bg-[#eef4ff] hover:text-[#1366eb] {{ request()->routeIs('dashboard') ? 'active-nav-link' : '' }}"
                               href="{{ route('dashboard') }}">
                                <span class="material-symbols-outlined text-2xl">dashboard</span>
                                <span class="text-sm font-medium">Dashboard</span>
                            </a>

                            <!-- Mi Perfil - Común para todos los roles -->
                            <a class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-[#4c6a9a] hover:bg-[#eef4ff] hover:text-[#1366eb] {{ request()->routeIs('settings.profile') ? 'active-nav-link' : '' }}"
                               href="{{ route('settings.profile') }}">
                                <span class="material-symbols-outlined text-2xl">person</span>
                                <span class="text-sm font-medium">Mi Perfil</span>
                            </a>

                            @if(auth()->user()->role->name === 'paciente')
                                <!-- Opciones específicas para Paciente -->
                                <a class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-[#4c6a9a] hover:bg-[#eef4ff] hover:text-[#1366eb] {{ request()->routeIs('paciente.agendarCita.*') ? 'active-nav-link' : '' }}"
                                   href="{{ route('paciente.agendarCita.create') }}">
                                    <span class="material-symbols-outlined text-2xl">calendar_add_on</span>
                                    <span class="text-sm font-medium">Reservar Cita</span>
                                </a>
                                <a class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-[#4c6a9a] hover:bg-[#eef4ff] hover:text-[#1366eb] {{ request()->routeIs('paciente.misCitas.*') ? 'active-nav-link' : '' }}"
                                   href="{{ route('paciente.misCitas.index') }}">
                                    <span class="material-symbols-outlined text-2xl">event_available</span>
                                    <span class="text-sm font-medium">Mis Citas</span>
                                </a>
                                <a class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-[#4c6a9a] hover:bg-[#eef4ff] hover:text-[#1366eb] {{ request()->routeIs('paciente.historial.*') ? 'active-nav-link' : '' }}"
                                   href="{{ route('paciente.historial.index') }}">
                                    <span class="material-symbols-outlined text-2xl">medical_information</span>
                                    <span class="text-sm font-medium">Historial Médico</span>
                                </a>
                            @endif

                            @if(auth()->user()->role->name === 'doctor')
                                <!-- Opciones específicas para Doctor -->
                                <a class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-[#4c6a9a] hover:bg-[#eef4ff] hover:text-[#1366eb] {{ request()->routeIs('doctor.agenda.*') ? 'active-nav-link' : '' }}"
                                   href="{{ route('doctor.agenda.index') }}">
                                    <span class="material-symbols-outlined text-2xl">calendar_month</span>
                                    <span class="text-sm font-medium">Mi Agenda</span>
                                </a>
                            @endif

                            @if(auth()->user()->role->name === 'secretaria')
                                <!-- Opciones específicas para Secretaria -->
                                <a class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-[#4c6a9a] hover:bg-[#eef4ff] hover:text-[#1366eb] {{ request()->routeIs('secretaria.pagos.*') ? 'active-nav-link' : '' }}"
                                   href="{{ route('secretaria.pagos.index') }}">
                                    <span class="material-symbols-outlined text-2xl">payments</span>
                                    <span class="text-sm font-medium">Validar Pagos</span>
                                </a>
                                <a class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-[#4c6a9a] hover:bg-[#eef4ff] hover:text-[#1366eb] {{ request()->routeIs('secretaria.reportes.*') ? 'active-nav-link' : '' }}"
                                   href="{{ route('secretaria.reportes.index') }}">
                                    <span class="material-symbols-outlined text-2xl">assessment</span>
                                    <span class="text-sm font-medium">Generar Reportes</span>
                                </a>
                            @endif

                            @if(auth()->user()->role->name === 'admin')
                                <!-- Opciones específicas para Administrador -->
                                <a class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-[#4c6a9a] hover:bg-[#eef4ff] hover:text-[#1366eb] {{ request()->routeIs('admin.personal.*') ? 'active-nav-link' : '' }}"
                                   href="{{ route('admin.personal.index') }}">
                                    <span class="material-symbols-outlined text-2xl">group</span>
                                    <span class="text-sm font-medium">Gestión de Cuentas</span>
                                </a>
                                <a class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-[#4c6a9a] hover:bg-[#eef4ff] hover:text-[#1366eb] {{ request()->routeIs('admin.horarios.*') ? 'active-nav-link' : '' }}"
                                   href="{{ route('admin.horarios.index') }}">
                                    <span class="material-symbols-outlined text-2xl">schedule</span>
                                    <span class="text-sm font-medium">Gestión de Horarios</span>
                                </a>
                                <a class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-[#4c6a9a] hover:bg-[#eef4ff] hover:text-[#1366eb] {{ request()->routeIs('admin.especialidades.*') ? 'active-nav-link' : '' }}"
                                   href="{{ route('admin.especialidades.index') }}">
                                    <span class="material-symbols-outlined text-2xl">medical_services</span>
                                    <span class="text-sm font-medium">Gestión de Especialidades</span>
                                </a>
                            @endif

                            <!-- Notificaciones - Común para todos los roles -->
                            <a class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-[#4c6a9a] hover:bg-[#eef4ff] hover:text-[#1366eb] {{ request()->routeIs('notificaciones.*') ? 'active-nav-link' : '' }}"
                               href="{{ route('notificaciones.index') }}">
                                <span class="material-symbols-outlined text-2xl">notifications</span>
                                <span class="text-sm font-medium">Notificaciones</span>
                            </a>
                        </nav>
                    </div>

                    <!-- Cerrar Sesión - Fijo en la parte inferior -->
                    <div class="border-t border-gray-200 p-4 bg-white">
                        <form method="POST" action="{{ route('logout') }}" class="block">
                            @csrf
                            <button type="submit" 
                                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-[#4c6a9a] hover:bg-[#eef4ff] hover:text-red-600 group w-full text-left transition-colors">
                                <span class="material-symbols-outlined text-2xl group-hover:text-red-600">logout</span>
                                <span class="text-sm font-medium">Cerrar Sesión</span>
                            </button>
                        </form>
                    </div>
                </div>
            </aside>
            
            <!-- Main Content -->
            <main class="flex-1 ml-0 md:ml-64 p-6 md:p-10 bg-[#f8f9fc]">
                @if (isset($header))
                    <header class="mb-8">
                        <h1 class="text-[#0d131b] text-2xl md:text-3xl font-bold leading-tight">
                            {{ $header }}
                        </h1>
                        @if (isset($headerDescription))
                            <p class="text-[#4c6a9a] text-base mt-1">{{ $headerDescription }}</p>
                        @endif
                    </header>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html> 