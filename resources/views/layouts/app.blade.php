<!DOCTYPE html> 
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> 
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'GestionaTI') }}</title>
        <link rel="stylesheet" 
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <!-- Fonts -->
        <script src="https://kit.fontawesome.com/646c794df3.js"></script>
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
        
        <!-- Charts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js "></script> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

<!-- Incluye la biblioteca Select2 desde un CDN -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Incluye Font Awesome en tu proyecto -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-pz5yBUJzJLAe8N0pkDlb8GpP1Nj+JQ8SU3DE/2xaBIp6L0TSvZKXqfD1et+zmDsMv2HXaflOHKeu0uPgeWJtwQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Fonts -->



        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/css/styles.css','resources/js/app.js','resources/js/desp_pass.js','resources/js/graficas.js','resources/js/candidatosfiltros.js','resources/js/candidatosidioma.js','resources/js/candidatosvacantes.js'])
        <!-- <link rel="{{ asset('build/assets/app-c0a89d41.css') }}" href="style.css"> -->z
    </head>

    <body class="font-sans antialiased"> <!-- Primer contenedor --> 
        <div class="div1">
            <div style="display: flex; align-items: center;">
                <!-- Logo de la página -->
                <img src="{{ asset('storage/img/th3codelogo.ico') }}" alt="GestionaTI"
                    style="width: 20%; margin-right: 3%; margin-left:10%;" class="mx-8 mt-16">
                <!-- Nombre de la página -->
                <p class="font-bold text-3xl text-teal-600 dark:text-teal-600 mt-16">GestionaTI</p>
            </div>
            <!-- Espacio -->
            <div class="my-16"></div>

            <!-- Botones para cambiar de ventana -->
            <a href="{{ route('candidatos.index') }}" style="display: flex; align-items: center;" class="inline-flex items-center px-4 py-2 bg-transparent rounded-md text-xl text-white dark:text-white uppercase tracking-widest hover:bg-teal-700 dark:hover:bg-teal-700 focus:bg-teal-700 dark:focus:bg-teal-950 active:bg-teal-700 dark:active:bg-teal-950 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 hover:shadow-xl mt-8 w-56 mx-auto justify-center bg-teal-600 h-20" ><i class="fas fa-users"></i>
            &nbsp;{{ __(' Candidatos') }}
            </a>

        <!-- Espacio -->
        <div class="my-6"></div>

        <a href="{{ route('graficas.index') }}" style="display: flex; align-items: center;" class="inline-flex items-center px-4 py-2 bg-transparent rounded-md text-xl text-white dark:text-white uppercase tracking-widest hover:bg-teal-700 dark:hover:bg-teal-700 focus:bg-teal-700 dark:focus:bg-teal-950 active:bg-teal-700 dark:active:bg-teal-950 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 hover:shadow-xl mt-4 w-56 mx-auto justify-center bg-teal-600 h-20" ><i class="fas fa-chart-bar"></i>
        &nbsp;{{ __(' Gráficas') }}
        </a>

            <!-- Espacio -->
        <div class="my-6"></div>

        <a href="{{ route('vacantes.index') }}" style="display: flex; align-items: center;"
            class="inline-flex items-center px-4 py-2 bg-transparent rounded-md text-xl text-white dark:text-white uppercase tracking-widest hover:bg-teal-700 dark:hover:bg-teal-700 focus:bg-teal-700 dark:focus:bg-teal-950 active:bg-teal-700 dark:active:bg-teal-950 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 hover:shadow-xl mt-4 w-56 mx-auto justify-center bg-teal-600 h-20"><i class="far fa-file-alt"></i>
            &nbsp;{{ __(' Vacantes') }}
        </a>
    </div>
            <!-- Segundo contenedor -->
            <div class="div2">
                <div class="bg-white h-20 mt-4 mx-8 rounded-lg border border-gray-500 justify-end"
                    style="text-align: right; display: flex; align-items: center;">
                    <!-- Contenedor para el nombre de usuario -->
                    <div>
                        <!-- Opciones de Perfil y Cerrar Sesión Menú desplegable -->
                        <div class="hidden space-x-8 sm:-my-px sm:flex">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="inline-flex items-center px-2 py-2 border border-transparent text-md leading-4 font-medium rounded-md text-black dark:text-black bg-white dark:bg-black hover:text-black dark:hover:text-black focus:outline-none transition ease-in-out duration-150">
                                        <div>{{ Auth::user()->name }}</div>

                                        <div class="ml-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <!-- Contenido del menú -->
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile.edit')"><i class="fas fa-user"></i>
                                        &nbsp;{{ __('Cuenta') }}
                                    </x-dropdown-link>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();"><i class="fas fa-sign-out-alt"></i> 
                                            &nbsp;{{ __('Cerrar Sesión') }}
                                        </x-dropdown-link>

                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>

                        <p class="hidden sm:flex text-black dark:text-black ml-10">Admin</p>
                    </div>
                    <!-- Imagen del perfil -->
                    <img src="{{ asset('storage/img/perfil.png') }}" alt="Perfil" class="w-26 h-16 ml-4 mr-4">
                </div>
            </div>
            <!-- Contenedor para vista -->
            <div class="div3">
                {{ $slot }}
            </div>
    </body>
</html>                                                                                                                                                                                                  