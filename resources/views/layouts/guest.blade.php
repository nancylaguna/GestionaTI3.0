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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- <link rel="{{ asset('build/assets/app-c0a89d41.css') }}" href="style.css"> -->
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:flex-row justify-between items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            <!-- Contenedor para logo e imagen -->  
            <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
                <a href="login" class="w-full "> 
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500 mx-auto" />
                </a>
                <div>
                    <a>
                        <img src="{{ asset('storage/img/programador.png') }}" alt="GestionaTI" style="width: 100%">
                    </a>
                </div>
            </div>
            <!-- Contenedor para campos de login -->  
            <div class="h-screen w-full sm:max-w-md flex flex-col justify-center items-center ml-auto px-10 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>

