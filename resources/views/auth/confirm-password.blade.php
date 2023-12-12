<!-- Confirmar la contraseña -->
<x-guest-layout>
    <!-- Mensaje para los usuarios sobre la zona segura -->
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Esta es una área segura de la aplicación. Por favor, confirma tu contraseña antes de continuar.') }}
    </div>

    <!-- Formulario de confirmación de contraseña -->
    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Entrada de contraseña -->
        <div>
            <!-- Etiqueta para la entrada de contraseña -->
            <x-input-label for="password" :value="__('Contraseña')" />

            <!-- Entrada de texto para la contraseña -->
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <!-- Mostrar errores relacionados con la contraseña -->
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Botón de confirmación -->
        <div class="flex justify-end mt-4">
            <x-primary-button>
                {{ __('Confirmar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
