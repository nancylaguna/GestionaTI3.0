<!-- Vista para recuperar contraseña olvidada (forgot-password.blade.php) -->
<x-guest-layout>
    <!-- Encabezado -->
    <div class="w-4/5">
        <div class="mt-4 block font-medium text-2xl text-gray-500">
            {{ __('¿Olvidaste tu contraseña?') }}
        </div>
        <br>
        <!-- Instrucciones para recuperar contraseña -->
        <x-input-label :value="__('Ingresa tu correo electrónico y te enviaremos instrucciones para recuperar tu contraseña')" class="text-md"/>
        <br>
        <!-- Estatus de la sesión -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Formulario para enviar correo de recuperación -->
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Campo para el correo electrónico -->
            <div>
                <!-- Etiqueta para el campo de correo -->
                <x-input-label for="email" :value="__('Email')" class="text-md"/>

                <!-- Entrada de texto para el correo -->
                <x-text-input id="email" class="block pr-10 mt-1 w-full h-10 border border-teal-700 rounded-md" type="email" name="email" :value="old('email')" required autofocus />
                
                <!-- Mostrar errores relacionados con el correo -->
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Botón para enviar link de recuperación -->
            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="mt-4 w-full justify-center text-sm">
                    {{ __('Enviar link de recuperación') }}
                </x-primary-button>
            </div>
        </form>

        <!-- Enlace para regresar al inicio de sesión -->
        @if (Route::has('login'))
        <a style="text-decoration: none; " class="block mt-3 text-md text-teal-700 hover:text-teal-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 text-center"  href="{{ route('login') }}">
            {{ __('< Regresar') }}
        </a>
        @endif
    </div>
</x-guest-layout>
