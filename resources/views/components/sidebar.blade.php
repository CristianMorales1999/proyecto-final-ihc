<aside class="hidden md:flex w-64 flex-col bg-white p-4 border-r border-solid border-r-[#e7ecf3] sticky top-[69px] h-[calc(100vh-69px)]">
    <nav class="flex flex-col gap-2 flex-grow">
        <!-- Inicio - Común para todos los roles -->
        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-[#4c6a9a] hover:bg-[#eef4ff] hover:text-[#1366eb] {{ request()->routeIs('dashboard') ? 'active-nav-link' : '' }}"
           href="{{ route('dashboard') }}">
            <span class="material-symbols-outlined text-2xl">home</span>
            <span class="text-sm font-medium">Inicio</span>
        </a>

        <!-- Mi Perfil - Común para todos los roles -->
        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-[#4c6a9a] hover:bg-[#eef4ff] hover:text-[#1366eb] {{ request()->routeIs('settings.profile') ? 'active-nav-link' : '' }}"
           href="{{ route('settings.profile') }}">
            <span class="material-symbols-outlined text-2xl">person</span>
            <span class="text-sm font-medium">Mi Perfil</span>
        </a>

        @if(auth()->user()->role->name === 'paciente')
            <!-- Opciones específicas para Paciente -->
            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-[#4c6a9a] hover:bg-[#eef4ff] hover:text-[#1366eb] {{ request()->routeIs('paciente.agendarCita.*') ? 'active-nav-link' : '' }}"
               href="{{ route('paciente.agendarCita.create') }}">
                <span class="material-symbols-outlined text-2xl">calendar_add_on</span>
                <span class="text-sm font-medium">Reservar Cita</span>
            </a>
            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-[#4c6a9a] hover:bg-[#eef4ff] hover:text-[#1366eb] {{ request()->routeIs('paciente.misCitas.*') ? 'active-nav-link' : '' }}"
               href="#">
                <span class="material-symbols-outlined text-2xl">event_available</span>
                <span class="text-sm font-medium">Mis Citas</span>
            </a>
            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-[#4c6a9a] hover:bg-[#eef4ff] hover:text-[#1366eb] {{ request()->routeIs('paciente.historial.*') ? 'active-nav-link' : '' }}"
               href="#">
                <span class="material-symbols-outlined text-2xl">medical_information</span>
                <span class="text-sm font-medium">Historial Médico</span>
            </a>
        @endif

        @if(auth()->user()->role->name === 'doctor')
            <!-- Opciones específicas para Doctor -->
            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-[#4c6a9a] hover:bg-[#eef4ff] hover:text-[#1366eb] {{ request()->routeIs('doctor.agenda.*') ? 'active-nav-link' : '' }}"
               href="#">
                <span class="material-symbols-outlined text-2xl">calendar_month</span>
                <span class="text-sm font-medium">Mi Agenda</span>
            </a>
        @endif

        @if(auth()->user()->role->name === 'secretaria')
            <!-- Opciones específicas para Secretaria -->
            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-[#4c6a9a] hover:bg-[#eef4ff] hover:text-[#1366eb] {{ request()->routeIs('secretaria.pagos.*') ? 'active-nav-link' : '' }}"
               href="#">
                <span class="material-symbols-outlined text-2xl">payments</span>
                <span class="text-sm font-medium">Validar Pagos</span>
            </a>
            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-[#4c6a9a] hover:bg-[#eef4ff] hover:text-[#1366eb] {{ request()->routeIs('secretaria.reportes.*') ? 'active-nav-link' : '' }}"
               href="#">
                <span class="material-symbols-outlined text-2xl">assessment</span>
                <span class="text-sm font-medium">Generar Reportes</span>
            </a>
        @endif

        @if(auth()->user()->role->name === 'admin')
            <!-- Opciones específicas para Administrador -->
            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-[#4c6a9a] hover:bg-[#eef4ff] hover:text-[#1366eb] {{ request()->routeIs('admin.personal.*') ? 'active-nav-link' : '' }}"
               href="#">
                <span class="material-symbols-outlined text-2xl">group</span>
                <span class="text-sm font-medium">Gestión de Cuentas</span>
            </a>
            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-[#4c6a9a] hover:bg-[#eef4ff] hover:text-[#1366eb] {{ request()->routeIs('admin.horarios.*') ? 'active-nav-link' : '' }}"
               href="#">
                <span class="material-symbols-outlined text-2xl">schedule</span>
                <span class="text-sm font-medium">Gestión de Horarios</span>
            </a>
            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-[#4c6a9a] hover:bg-[#eef4ff] hover:text-[#1366eb] {{ request()->routeIs('admin.especialidades.*') ? 'active-nav-link' : '' }}"
               href="#">
                <span class="material-symbols-outlined text-2xl">medical_services</span>
                <span class="text-sm font-medium">Gestión de Especialidades</span>
            </a>
        @endif

        <!-- Notificaciones - Común para todos los roles -->
        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-[#4c6a9a] hover:bg-[#eef4ff] hover:text-[#1366eb] {{ request()->routeIs('notificaciones.*') ? 'active-nav-link' : '' }}"
           href="#">
            <span class="material-symbols-outlined text-2xl">notifications</span>
            <span class="text-sm font-medium">Notificaciones</span>
        </a>
    </nav>

    <!-- Cerrar Sesión - Común para todos los roles -->
    <div class="mt-auto">
        <form method="POST" action="{{ route('logout') }}" class="block">
            @csrf
            <button type="submit" 
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-[#4c6a9a] hover:bg-[#eef4ff] hover:text-red-600 group w-full text-left">
                <span class="material-symbols-outlined text-2xl group-hover:text-red-600">logout</span>
                <span class="text-sm font-medium">Cerrar Sesión</span>
            </button>
        </form>
    </div>
</aside> 