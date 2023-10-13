<x-guest-layout>
    <!-- Estado de la sesión -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        
        <div class="mt-4 block font-medium text-3xl text-gray-500 dark:text-gray-700">
            {{ __('Bienvenido a ') }}
            <br>
            {{ __('GestionaTI') }}
        </div>
<br>
        <x-input-label :value="__('¡Inicia sesion para comenzar!')" />
<br>
        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Contraseña -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />

        </div>

        
        <!--  Botón para iniciar sesión-->
        <x-primary-button class="mt-4 w-full justify-center">
            {{ __('Iniciar sesión') }}
        </x-primary-button>
        @if (Route::has('password.request'))
        <!-- Boton direccionar a vista olvide la contraseña -->
            <a style="text-decoration: none; " class="block mt-3 text-sm text-teal-700 dark:text-teal-800 hover:text-teal-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 text-center " href="{{ route('password.request') }}">
                {{ __('¿Olvidaste tu contraseña?') }}
            </a>
            @endif
    </form>
</x-guest-layout>