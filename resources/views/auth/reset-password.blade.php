<!-- Vista para restablecer la contraseña (reset-password.blade.php) -->

<x-guest-layout>
    <!-- Formulario para restablecer la contraseña -->
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Token de restablecimiento de contraseña -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Campo para la dirección de correo electrónico -->
        <div>
            <!-- Etiqueta para el campo de correo electrónico -->
            <x-input-label for="email" :value="__('Correo electrónico')" />

            <!-- Entrada de texto para el correo electrónico -->
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />

            <!-- Mostrar errores relacionados con el correo electrónico -->
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Campo para la nueva contraseña -->
        <div class="mt-4">
            <!-- Etiqueta para el campo de contraseña -->
            <x-input-label for="password" :value="__('Contraseña')" />

            <!-- Entrada de texto para la nueva contraseña -->
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />

            <!-- Mostrar errores relacionados con la contraseña -->
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Campo para confirmar la nueva contraseña -->
        <div class="mt-4">
            <!-- Etiqueta para el campo de confirmación de contraseña -->
            <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" />

            <!-- Entrada de texto para confirmar la nueva contraseña -->
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <!-- Mostrar errores relacionados con la confirmación de la contraseña -->
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Botón para restablecer la contraseña -->
        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Restablecer contraseña') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
