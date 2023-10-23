<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'GestionaTI') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Color de fondo de la página -->
        <style>
            body {
                background-color: #E5E7EB;
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- <link rel="{{ asset('build/assets/app-c0a89d41.css') }}" href="style.css"> -->
    </head>
    <body class="font-sans antialiased">
        <!-- Contenido de la página -->
        <div class="flex">
            <!-- Primer contenedor     -->
            <div class="bg-indigo-950 h-screen w-4/5 sm:max-w-xs">
                <div style="text-align: left;">
                    <div style="display: flex; align-items: center;">
                        <!-- Logo de la página -->
                        <img src="{{ asset('storage/img/th3codelogo.png') }}" alt="GestionaTI" style="width: 20%; margin-right: 16px;" class="mx-8 mt-16">
                        <!-- Nombre de la página -->
                        <p class="font-bold text-3xl text-teal-600 dark:text-teal-600 mt-16">GestionaTI</p>
                    </div>
                    <!-- Espacio -->
                    <div class="my-20"></div>
                                    
                    <!-- Botones para cambiar de ventana -->
                    <x-buttonapp style="display: flex; align-items: center;" class="mt-4 w-56 mx-auto justify-center bg-teal-600 h-20">
                        {{ __('Candidatos') }}
                    </x-buttonapp>  
                    <!-- Espacio -->
                    <div class="my-6"></div>
    
                    <x-buttonapp style="display: flex; align-items: center;" class="mt-4 w-56 mx-auto justify-center bg-teal-600 h-20">
                        {{ __('Gráficas') }}
                    </x-buttonapp>  
                    <!-- Espacio -->
                    <div class="my-6"></div>
                        
                    <x-buttonapp style="display: flex; align-items: center;" class="mt-4 w-56 mx-auto justify-center bg-teal-600 h-20">
                        {{ __('Vacantes') }}
                    </x-buttonapp>        
                </div>
                {{ $slot }}
            </div>

            <!-- Segundo contenedor -->
            <div class="bg-white w-screen h-4/5 mt-7 mx-8 my-auto flex rounded-lg border border-gray-500 justify-end">
                <div style="text-align: right;">
                    <div style="display: flex; align-items: center;">
                        <!-- Contenedor para el nombre de usuario -->
                        <div>
                            <!-- Opciones de Perfil y Cerrar Sesión Menú desplegable -->
                            <div class="hidden space-x-8 sm:-my-px sm:flex">
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button class="inline-flex items-center px-2 py-2 border border-transparent text-md leading-4 font-medium rounded-md text-black dark:text-black bg-white dark:bg-black hover:text-black dark:hover:text-black focus:outline-none transition ease-in-out duration-150">
                                            <div>{{ Auth::user()->name }}</div>

                                            <div class="ml-1">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </button>
                                    </x-slot>
                                    
                                    <!-- Contenido del menú -->
                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('profile.edit')">
                                            {{ __('Perfil') }}
                                        </x-dropdown-link>

                                        <!-- Authentication -->
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf

                                            <x-dropdown-link :href="route('logout')"
                                                    onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                                {{ __('Cerrar Sesión') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            </div>

                            <!-- Abrir menú en dispositivos móviles -->
                            <div class="-mr-2 flex items-center sm:hidden">
                                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                                
                            <p class="hidden sm:flex text-black dark:text-black ml-10">Admin</p>                        </div>
                                                
                        <!-- Imagen del perfil -->
                        <img src="{{ asset('storage/img/cara.jpg') }}" alt="Imagen" class="w-32 h-auto ml-4">
                    </div>
                </div>
            </div>
            <!-- Contenedor para vistas de graficas -->
            
        </div>
    </body>
</html>
