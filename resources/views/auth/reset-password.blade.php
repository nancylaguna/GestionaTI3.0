<!-- Vista para restablecer la contraseña (reset-password.blade.php) -->

<x-guest-layout>
    <!-- Formulario para restablecer la contraseña -->
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Token de restablecimiento de contraseña -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Título de bienvenida -->
        <div class="mt-6 block font-medium text-4xl text-gray-500">
            {{ __('Bienvenido a ') }}
            <br>
            {{ __('GestionaTI') }}
        </div>

        <br>
        <!-- Mensaje de inicio de sesión -->
        <x-input-label :value="__('Restablece tu contraseña')" class="text-xl"/>
        <br>

        <!-- Campo para la dirección de correo electrónico -->
        <div>
            <!-- Etiqueta para el campo de correo electrónico -->
            <x-input-label for="email" :value="__('Correo electrónico')" />

            <!-- Entrada de texto para el correo electrónico -->
            <x-text-input id="email" class="block pr-10 mt-1 w-full h-10 border border-teal-700 rounded-md" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />

            <!-- Mostrar errores relacionados con el correo electrónico -->
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Campo para la nueva contraseña -->
        <div class="mt-4">
            <!-- Etiqueta para el campo de contraseña -->
            <x-input-label for="password" :value="__('Contraseña')" />

            <!-- Entrada de texto para la nueva contraseña -->
            <div class="relative">
                <x-text-input id="password" class="block pr-10 mt-1 w-full h-10 border border-teal-700 rounded-md" type="password" name="password" required autocomplete="new-password" />
                <!-- Boton para ver la contraseña -->                
                <button
                    type="button"
                    id="toggle-new-password"
                    class="absolute top-1/2 right-0 mt-2  p-2 text-gray-500 cursor-pointer transform -translate-y-1/2"
                    style="z-index: 2;"
                    onclick="togglePassword('password')"
                >
                    <img
                        src="{{ asset('storage/img/ver.ico') }}"
                        alt="Icono Ver"
                        class="w-1 h-2 mb-5"
                        style="width: 2rem; height: 2rem;"
                        title="Ver Contraseña"
                    />
                </button>
            </div>

            <!-- Mostrar errores relacionados con la contraseña -->
            <x-input-error :messages="$errors->get('password')" class="mt-2" />

            <div class="mt-2">
                <p id="password-length-message" class="text-red-500"></p>
                <p id="password-uppercase-message" class="text-red-500"></p>
                <p id="password-special-char-message" class="text-red-500"></p>
                <p id="password-number-message" class="text-red-500"></p>
            </div>
        </div>

        <!-- Campo para confirmar la nueva contraseña -->
        <div class="mt-4">
            <!-- Etiqueta para el campo de confirmación de contraseña -->
            <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" />

            <!-- Entrada de texto para confirmar la nueva contraseña -->
            <x-text-input id="password_confirmation" class="block pr-10 mt-1 w-full h-10 border border-teal-700 rounded-md"
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

    <!-- Script para mostrar/ocultar la contraseña -->
    <script>
        function togglePassword(inputId) {
            var passwordInput = document.getElementById(inputId);
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var passwordInput = document.getElementById('password');
            var lengthMessage = document.getElementById('password-length-message');
            var uppercaseMessage = document.getElementById('password-uppercase-message');
            var specialCharMessage = document.getElementById('password-special-char-message');
            var numberMessage = document.getElementById('password-number-message');

            passwordInput.addEventListener('input', function () {
                var password = passwordInput.value;

                // Validación de longitud mínima
                lengthMessage.textContent = password.length >= 8 ? '' : 'La contraseña debe tener al menos 8 caracteres.';

                // Validación de mayúscula
                uppercaseMessage.textContent = /[A-Z]/.test(password) ? '' : 'La contraseña debe contener al menos una mayúscula.';

                // Validación de carácter especial
                specialCharMessage.textContent = /[\W_]/.test(password) ? '' : 'La contraseña debe contener al menos un carácter especial.';

                // Validación de número
                numberMessage.textContent = /\d/.test(password) ? '' : 'La contraseña debe contener al menos un número.';
            });
        });
    </script>
</x-guest-layout>
