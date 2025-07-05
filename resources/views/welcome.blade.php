@extends('layouts.welcome')

@section('title', 'HealthPlus - Gestión Hospitalaria')

@section('content')
    <section class="relative" id="inicio">
        <div class="min-h-[500px] md:min-h-[600px] bg-cover bg-center flex items-center justify-center text-center"
             style='background-image: linear-gradient(rgba(0, 0, 0, 0.5) 0%, rgba(0, 0, 0, 0.2) 100%), url("https://lh3.googleusercontent.com/aida-public/AB6AXuByo1NDMlFuCTvtKmqwBa6uKKHLqlR814nuAnnehvX1kFkDOW2qudBhOlSPjZAXCNYbd80KUWbpxDtVSeM79LGJw7ViUZC_VUXIXZyIJ4J9H9TIjbQyG-bLNXmiLgvlOugbaqbgvDphzFckHBbGHEqaHrEMy7fWbQm1XApLp2SzVw2pVFzGx_PGdTKr4VsHEtV26CIc5Q0jdqlAlq5DtswF5Qws9Bu8niI28J2VcfX08C1sf8FmYac_SaTxk1Jzd1l5S4Ar_nJTaOx4");'>
            <div class="px-4 py-16 md:py-24 max-w-3xl mx-auto">
                <h1 class="text-white text-4xl md:text-6xl font-black leading-tight tracking-tighter mb-6">
                    Tu Salud, Nuestra Prioridad
                </h1>
                <h2 class="text-slate-200 text-lg md:text-xl font-normal leading-relaxed mb-10">
                    Brindando atención excepcional con compasión y experiencia. Accede a servicios médicos de clase mundial y profesionales experimentados.
                </h2>
                @guest
                    <a href="{{ route('register') }}" class="flex min-w-[180px] max-w-[480px] mx-auto cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-6 md:h-14 md:px-8 bg-blue-600 text-white text-base md:text-lg font-bold leading-normal tracking-wide shadow-lg hover:bg-blue-700 transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-500">
                        <span class="truncate">Reservar una Cita</span>
                    </a>
                @else
                    <a href="{{ route('dashboard') }}" class="flex min-w-[180px] max-w-[480px] mx-auto cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-6 md:h-14 md:px-8 bg-blue-600 text-white text-base md:text-lg font-bold leading-normal tracking-wide shadow-lg hover:bg-blue-700 transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-500">
                        <span class="truncate">Ir al Dashboard</span>
                    </a>
                @endguest
            </div>
        </div>
    </section>

    <section class="py-16 md:py-24 bg-white" id="nosotros">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl md:text-4xl font-bold text-slate-800 text-center mb-4 leading-tight tracking-tight">Servicios Destacados</h2>
            <p class="text-center text-slate-600 mb-12 md:mb-16 max-w-2xl mx-auto">
                Ofrecemos una amplia gama de servicios médicos especializados para satisfacer tus necesidades de salud.
            </p>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="group flex flex-col bg-slate-50 rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300">
                    <div class="w-full h-48 bg-center bg-no-repeat bg-cover"
                         style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBgY0MP6ZlOKPFpUu87kVEsO6uUNZLUBvHLo5uSp2DrZ-JyP60u4WmvnB78QjOeaf_a7Pb6nFBlkr9KRptvdliYe5AW7In6_NtIlCbnZraobeoyXe9tcL4YGYbgkowZb8gzxTsTgXCduIqkswQxjgPZqhztzD8raT88Wr7xQZybCBpDbziPHHdhCbBJKD-eIH7Tjg2lqRYPV9sp7SeJOj1K3RtweWj13BaqY1l5RFOrdPghGdvTNheUt0qJh-scCHL8Bf8n0_j6NsGQ");'></div>
                    <div class="p-6 flex-grow">
                        <h3 class="text-xl font-semibold text-slate-800 mb-2">Cardiología</h3>
                        <p class="text-slate-600 text-sm leading-relaxed">Atención experta para afecciones cardíacas, diagnósticos y planes de tratamiento.</p>
                    </div>
                    <a class="block bg-blue-50 text-blue-600 p-4 text-center font-medium hover:bg-blue-100 transition-colors" href="#">Saber Más</a>
                </div>
                <div class="group flex flex-col bg-slate-50 rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300">
                    <div class="w-full h-48 bg-center bg-no-repeat bg-cover"
                         style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCCpGKz3j9RxBb_S_-fI_dTmfv-xHRte6BH2RBmcEKHPXHhoDrNT4YS5GZVc0l1Jo4RvogW53FXulPMEK13134rbCb3Jr-qIxeUvCOHdPBJUEaLQcNvBHc4yDvc3yXxooG8Tpj-ufg-UwPvoSZWvEFcZjpfkae8yBAw6ZQiY-MqQ9WAqwOyV0VVr0NfVqFBeYOWvnvd32itWbwAKE12gEbT9ccQaxB8B6buESiEppMBZr4a-dFJnUrjyLLxBPegROaPIuQYbUZdts0d");'></div>
                    <div class="p-6 flex-grow">
                        <h3 class="text-xl font-semibold text-slate-800 mb-2">Neurología</h3>
                        <p class="text-slate-600 text-sm leading-relaxed">Tratamiento especializado para trastornos y afecciones neurológicas.</p>
                    </div>
                    <a class="block bg-blue-50 text-blue-600 p-4 text-center font-medium hover:bg-blue-100 transition-colors" href="#">Saber Más</a>
                </div>
                <div class="group flex flex-col bg-slate-50 rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300">
                    <div class="w-full h-48 bg-center bg-no-repeat bg-cover"
                         style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCf3IwSwCMjrYHB1zrLXW_p-gNpP0Fog3JION4_8ZCp3oYSet6Y7-5lzSRk7P6dPpzs3EUasYKlNT8Pao7mJvpExdx2Y6ZfshmpWbGiKLhmY9bOiH7wNuH0XKlgPAHxkfmdIO95a16yk4iKczgreHWQ7WYEiObw8ZP450NE9YZJ_wILDCukHgS_82dIZZqqe_ghSYkEMpyV7e9mGAhJW9nicy-FMaRvp_e6kwK-8LMn0TiMbrw8j6w0lIOZ8GmRi6WntBPyh921HLZl");'></div>
                    <div class="p-6 flex-grow">
                        <h3 class="text-xl font-semibold text-slate-800 mb-2">Oncología</h3>
                        <p class="text-slate-600 text-sm leading-relaxed">Atención integral del cáncer, apoyo y terapias avanzadas.</p>
                    </div>
                    <a class="block bg-blue-50 text-blue-600 p-4 text-center font-medium hover:bg-blue-100 transition-colors" href="#">Saber Más</a>
                </div>
                <div class="group flex flex-col bg-slate-50 rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300">
                    <div class="w-full h-48 bg-center bg-no-repeat bg-cover"
                         style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDkInaXcU6WdRft6VChRIRez285ZUfu6d46PrycdN7k_c6wxnts4MNYhdY8Dio39FwPimiFhuEwkQfUa_f1Ww7g2FvSvHIXNzSrbM8VIIV6UglQhKiVEnJbBy_FZ6x5b7eWWj9Mhm82dqJgPBDQRTYTem703GJnN--_xkz-6vlNwA47YriIJA4Pc2cGOcEW2d8HYUSiz6IAJOCBEiezt0KR-oGgNSsuSnsHThM3mZs8I6xZ56WtcBIOL1Gw0r4jEbe-V7PW17UB3-ha");'></div>
                    <div class="p-6 flex-grow">
                        <h3 class="text-xl font-semibold text-slate-800 mb-2">Pediatría</h3>
                        <p class="text-slate-600 text-sm leading-relaxed">Atención dedicada y compasiva para la salud y el bienestar de los niños.</p>
                    </div>
                    <a class="block bg-blue-50 text-blue-600 p-4 text-center font-medium hover:bg-blue-100 transition-colors" href="#">Saber Más</a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 md:py-24 bg-slate-100" id="especialidades">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl md:text-4xl font-bold text-slate-800 text-center mb-4 leading-tight tracking-tight">Explore Nuestras Especialidades</h2>
            <p class="text-center text-slate-600 mb-12 md:mb-16 max-w-2xl mx-auto">
                Descubra la amplitud de nuestra experiencia médica en diversos campos especializados.
            </p>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="group flex flex-col bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300">
                    <div class="w-full h-48 bg-center bg-no-repeat bg-cover"
                         style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBUqJfXKiMvkyqpu1i39hAO2QQ0Fr9Nzap83_Eznv_7VIWdWRVhfddN6PAWuETBGclSVLy_sC8WUeIywBw5VzhYHap6RZFzawWETP9iGzfR3gTnsiCfZpjom_XdLL2sHUI4umC0JC-h1SPCo77kL4_ewmWRhG1g4VtN3j7MhKLMdebGStauZt2ALaWA338eeUMhVEda8rUPZjdYmarhy_Krl6wXPtAiHXGSSxzDEkTubcGZ8qzBJTp8uMQ5pvW6frt2HUPkagbeEXOP");'></div>
                    <div class="p-6 flex-grow">
                        <h3 class="text-xl font-semibold text-slate-800 mb-2">Ortopedia</h3>
                        <p class="text-slate-600 text-sm leading-relaxed">Tratamientos ortopédicos avanzados, cirugía y rehabilitación.</p>
                    </div>
                    <a class="block bg-blue-50 text-blue-600 p-4 text-center font-medium hover:bg-blue-100 transition-colors" href="#">Saber Más</a>
                </div>
                <div class="group flex flex-col bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300">
                    <div class="w-full h-48 bg-center bg-no-repeat bg-cover"
                         style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuD5rOmzXxUlYqLlGbVJSEzZS03cYQ4qhlbDD0th0D8eChmG27RnfDwWtfyuSOCM0y4khDcf7ttQcxJ1EPE1MiJW3xmyCZ3Nfx8OBvDXRRwTAnjbnKe_IMbfveuPjEHXtUILFyrcKMnjwSqrJfVMyu7YMabk6l2hYszpMkOKicEFcjG9vOznfMFUYyRlSte3K4bJ6A0hJ2JOG4P4mhriQTgyRkJvX_yJox8l2Ynq1lWYQZsiDZjY23cjJgsw7EDl4mXDqp4mHGlPQuV7");'></div>
                    <div class="p-6 flex-grow">
                        <h3 class="text-xl font-semibold text-slate-800 mb-2">Dermatología</h3>
                        <p class="text-slate-600 text-sm leading-relaxed">Cuidado integral de la piel, diagnóstico y tratamientos avanzados.</p>
                    </div>
                    <a class="block bg-blue-50 text-blue-600 p-4 text-center font-medium hover:bg-blue-100 transition-colors" href="#">Saber Más</a>
                </div>
                <div class="group flex flex-col bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300">
                    <div class="w-full h-48 bg-center bg-no-repeat bg-cover"
                         style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAqV8_qZNLg1MsKrDQPuS3DUtX057JHCVWdaM26-0JrYdx61Z9MlrJAIu9_PBOiIlfHALjBGT8MsnxJzVIf__EbfYwVy_rCTZ1C0PVZ5yzCPsAPrq-tLj0uh2zjJyKHf2p_scTXHwCx4wC_iJHaEt5XEkvaw4ezQUQ6kzPWmNjvt09jE_oM6g1ag6oi4wZ0v4O_hnNWRJ_KIkrXSyC6udfAdG6kw7bppO2cSTuTQ7wHsHWpSg52nmHChYFLhuOcb-ghSqHsCMc1pUax");'></div>
                    <div class="p-6 flex-grow">
                        <h3 class="text-xl font-semibold text-slate-800 mb-2">Gastroenterología</h3>
                        <p class="text-slate-600 text-sm leading-relaxed">Atención experta para trastornos y afecciones del sistema digestivo.</p>
                    </div>
                    <a class="block bg-blue-50 text-blue-600 p-4 text-center font-medium hover:bg-blue-100 transition-colors" href="#">Saber Más</a>
                </div>
                <div class="group flex flex-col bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300">
                    <div class="w-full h-48 bg-center bg-no-repeat bg-cover"
                         style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAPOcPibX0mdbbDnWtdGeL_DYCkOBII0_q50AkmuZFRg6NhxMGZ7vC5_Vqb9pfKwrFYJd5LnZ7D3k6VrbgA2RE8fyliBKgj8ngr06c0r20nv7jts-kqZ55tJHhBeR_kH1vO0xqZZOrEVsSVg8EbUna_IT-TW2iwhLCxTtPIIUwL4G5f1_Mb0jSWTbpP4lUk4QpxrDDdiz8VBV_t7Y7K2aZHV7ofWQEsf7h0tTfmxA8XAEV-75mihDqWpHeufPRJw6r0ljtZpvtqhKwa");'></div>
                    <div class="p-6 flex-grow">
                        <h3 class="text-xl font-semibold text-slate-800 mb-2">Neumología</h3>
                        <p class="text-slate-600 text-sm leading-relaxed">Atención especializada para afecciones respiratorias y salud pulmonar.</p>
                    </div>
                    <a class="block bg-blue-50 text-blue-600 p-4 text-center font-medium hover:bg-blue-100 transition-colors" href="#">Saber Más</a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 md:py-24 bg-white" id="equipo-medico">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl md:text-4xl font-bold text-slate-800 text-center mb-4 leading-tight tracking-tight">Nuestro Equipo Médico</h2>
            <p class="text-center text-slate-600 mb-12 md:mb-16 max-w-2xl mx-auto">
                Conozca a nuestros profesionales de la salud dedicados a brindarle la mejor atención.
            </p>
        </div>
    </section>
@endsection 