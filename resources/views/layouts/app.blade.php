<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'GestionaTI') }}</title>

    <!-- Font Awesome (via CDN) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" rel="stylesheet">

    <!-- Font Awesome (via Kit) -->
    <script src="https://kit.fontawesome.com/646c794df3.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- CDN para Charts -->
    <script src="https://www.gstatic.com/charts/loader.js"></script>

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <!-- Tailwind CSS Link -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Bunny.net Fonts -->        
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Archivo CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <!-- Archivo JavaScript -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/candidatosfiltros.js') }}"></script>
    <script src="{{ asset('js/desp_pass.js') }}"></script>
    <script src="{{ asset('js/graficas.js') }}"></script>

</head>

    <body class="font-sans antialiased"> 
        <!-- Primer contenedor --> 
        <div class="div1">
            <div style="display: flex; align-items: center;">
                <!-- Logo de la página -->
                <img src="{{ asset('storage/img/th3codelogo.ico') }}" alt="GestionaTI" style="width: 20%; margin-right: 3%; margin-left:10%;" class="mx-8 mt-16">
                <!-- Nombre de la página -->
                <p class="font-bold text-3xl text-teal-600 mt-16">GestionaTI</p>
            </div>
            <!-- Espacio -->
            <div class="my-12"></div>
    
            <!-- Botones para cambiar de ventana -->

            <!-- Boton para Candidatos -->
            <a href="{{ route('candidatos.index') }}" 
                @class([
                    'inline-flex items-center px-4 py-2 rounded-md text-xl uppercase tracking-widest mt-4 w-56 mx-4 justify-center bg-teal-600 h-20',
                    'bg-teal-700 text-white dark:bg-teal-700' => request()->routeIs('candidatos.index'),
                    'inline-flex items-center px-4 py-2 bg-transparent rounded-md text-xl text-white uppercase tracking-widest mt-4 w-56 mx-4 justify-center bg-teal-600 h-20 hover:bg-teal-700' => !request()->routeIs('candidatos.index'),
                ])>
                <i class="fa-solid fa-users"></i> &nbsp;{{ __(' Candidatos') }}
            </a>

            <!-- Espacio -->
            <div class="my-2"></div>

            <!-- Boton para Graficas -->
            <a href="{{ route('graficas.index') }}" 
                @class([
                    'inline-flex items-center px-4 py-2 rounded-md text-xl uppercase tracking-widest mt-4 w-56 mx-4 justify-center bg-teal-600 h-20',
                    'bg-teal-700 text-white dark:bg-teal-700' => request()->routeIs('graficas.index'),
                    'inline-flex items-center px-4 py-2 bg-transparent rounded-md text-xl text-white uppercase tracking-widest mt-4 w-56 mx-4 justify-center bg-teal-600 h-20 hover:bg-teal-700' => !request()->routeIs('graficas.index'),
                ])>
                <i class="fas fa-chart-bar"></i>
                &nbsp;{{ __(' Graficas') }}
            </a>

            <!-- Espacio -->
            <div class="my-2"></div>

            <!-- Boton para Vacantes -->
            <a href="{{ route('vacantes.index') }}" 
                @class([
                    'inline-flex items-center px-4 py-2 rounded-md text-xl uppercase tracking-widest mt-4 w-56 mx-4 justify-center bg-teal-600 h-20',
                    'bg-teal-700 text-white dark:bg-teal-700' => request()->routeIs('vacantes.index'),
                    'inline-flex items-center px-4 py-2 bg-transparent rounded-md text-xl text-white uppercase tracking-widest mt-4 w-56 mx-4 justify-center bg-teal-600 h-20 hover:bg-teal-700' => !request()->routeIs('vacantes.index'),
                ])>
                <i class="far fa-file-alt"></i>
                &nbsp;{{ __(' Vacantes') }}
            </a>
        </div>

        <!-- Segundo contenedor -->
        <div class="div2">
            <div class="bg-white h-20 mt-4 mx-8 rounded-lg border border-gray-500 justify-end" style="text-align: right; display: flex; align-items: center;">
                <!-- Contenedor para el nombre de usuario -->
                <div>
                    <!-- Opciones de Perfil y Cerrar Sesión Menú desplegable -->
                    <div class="container mx-auto p-1 space-x-8 sm:-my-px sm:flex">
                        <div class="relative inline-block text-left">
                            <button 
                                class="inline-flex items-center px-2 py-2 border border-transparent text-md leading-4 font-medium rounded-md text-black dark:text-black bg-white dark:bg-black hover:text-black dark:hover:text-black focus:outline-none transition ease-in-out duration-150"
                                title="Ver menú"
                            >
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>

                            <!-- Contenido del menú -->
                            <div class="hidden absolute right-0 mt-2 w-56 bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg">
                                <a href="{{ route('profile.edit') }}" class="h-10 flex items-center px-4">
                                    <i class="fas fa-user"></i> &nbsp; Cuenta
                                </a>
                                <!-- Autenticación -->
                                <form method="POST" action="{{ route('logout') }}" class="h-10 flex items-center px-4">
                                    @csrf
                                    <button type="submit" class="flex items-center">
                                        <i class="fas fa-sign-out-alt"></i> &nbsp; Cerrar Sesión
                                    </button>
                                </form>            
                            </div>
                        </div>
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

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var button = document.querySelector('.relative button');
                var menu = document.querySelector('.relative .hidden');

                button.addEventListener('click', function () {
                    menu.classList.toggle('hidden');
                });
            });
        </script>
    </body>
</html>                                                                                                                                                                                                  
