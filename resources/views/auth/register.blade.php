<!-- Vista de registro (register.blade.php) -->

<x-guest-layout>
    <!-- Formulario de registro -->
    <form method="POST" action="{{ route('register') }}">
        @csrf
        
        <!-- Título de bienvenida -->
        <div class="mt-6 block font-medium text-xl text-gray-500">
            {{ __('Bienvenido a ') }}
            <br>
            {{ __('GestionaTI') }}
        </div>

        <!-- Mensaje de inicio de sesión -->
        <x-input-label :value="__('Ingresa tus datos para crear una cuenta')" class="text-md mb-2"/>
        
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

            <!-- Entrada de texto para la nueva contraseña -->
            <div class="relative">
                <x-text-input id="password" class="block mt-1 w-full h-10 border border-teal-700 rounded-md"
                    type="password"
                    name="password"
                    required autocomplete="new-password" />                
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
                    />
                </button>
            </div>

            <!-- Mostrar errores relacionados con la contraseña -->
            <x-input-error :messages="$errors->get('password')" />
            <div class="mt-2">
                <p id="password-length-message" class="text-red-500"></p>
                <p id="password-uppercase-message" class="text-red-500"></p>
                <p id="password-special-char-message" class="text-red-500"></p>
                <p id="password-number-message" class="text-red-500"></p>
            </div>
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
