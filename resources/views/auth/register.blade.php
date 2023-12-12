<!-- Vista de registro (register.blade.php) -->

<x-guest-layout>
    <!-- Formulario de registro -->
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Campo para el nombre -->
        <div>
            <!-- Etiqueta para el campo de nombre -->
            <x-input-label for="name" :value="__('Nombre')" />

            <!-- Entrada de texto para el nombre -->
            <x-text-input id="name" class="block mt-1 w-full h-10 border border-teal-700 rounded-md" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />

            <!-- Mostrar errores relacionados con el nombre -->
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Campo para la dirección de correo electrónico -->
        <div class="mt-4">
            <!-- Etiqueta para el campo de correo electrónico -->
            <x-input-label for="email" :value="__('Correo electrónico')" />

            <!-- Entrada de texto para el correo electrónico -->
            <x-text-input id="email" class="block mt-1 w-full h-10 border border-teal-700 rounded-md" type="email" name="email" :value="old('email')" required autocomplete="username" />

            <!-- Mostrar errores relacionados con el correo electrónico -->
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Campo para la contraseña -->
        <div class="mt-4">
            <!-- Etiqueta para el campo de contraseña -->
            <x-input-label for="password" :value="__('Contraseña')" />

            <!-- Entrada de texto para la contraseña -->
            <x-text-input id="password" "block mt-1 w-full h-10 border border-teal-700 rounded-md"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <!-- Mostrar errores relacionados con la contraseña -->
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Campo para confirmar la contraseña -->
        <div class="mt-4">
            <!-- Etiqueta para el campo de confirmación de contraseña -->
            <x-input-label for="password_confirmation" :value="__('Confirma tu contraseña')" />

            <!-- Entrada de texto para confirmar la contraseña -->
            <x-text-input id="password_confirmation" class="block mt-1 w-full h-10 border border-teal-700 rounded-md"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <!-- Mostrar errores relacionados con la confirmación de la contraseña -->
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Enlaces para iniciar sesión o registrarse -->
        <div class="flex items-center justify-end mt-4">
            <!-- Enlace para iniciar sesión -->
            <a class="underline text-sm text-gray-600  hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('¿Ya tienes una cuenta?') }}
            </a>

            <!-- Botón para realizar el registro -->
            <x-primary-button class="ml-4">
                {{ __('Registrarse') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
