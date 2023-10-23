<x-guest-layout>
    <!-- Estado de la sesión -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="w-4/5">
        @csrf
        
        <div class="mt-6 block font-medium text-4xl text-gray-500 dark:text-gray-700">
            {{ __('Bienvenido a ') }}
            <br>
            {{ __('GestionaTI') }}
        </div>
<br>
        <x-input-label :value="__('¡Inicia sesion para comenzar!')" class="text-xl"/>
<br>
        <!-- Email -->
        <div>
            <x-input-label class="text-md" for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div class="my-8"></div>

        <!-- Contraseña -->
        <div class="mt-4">
            <!-- Etiqueta para la entrada de contraseña con clase de texto grande -->
            <x-input-label class="text-md" for="password" :value="__('Contraseña')" />

            <div class="relative">
                <!-- Campo de entrada de contraseña con margen derecho para hacer espacio al botón -->
                <x-text-input id="password" class="block pr-10 mt-1 w-full" type="password" name="password" required autocomplete="current-password" />

                <!-- Botón para mostrar/ocultar la contraseña -->
                <button
                    type="button"
                    id="toggle-password"
                    class="absolute top-0 right-0 mt-3 mr-3 p-2 text-gray-500 cursor-pointer"
                    style="z-index: 2;" 
                >
                <!-- Icono de ojo para mostrar/ocultar la contraseña -->
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        class="w-6 h-6"
                        style="width: 1.5rem; height: 1.5rem;" 
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                        />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4.293 7.293a1 1 0 011.414-1.414L12 14.586l6.293-6.293a1 1 0 111.414 1.414L12 17.414l-7.707-7.707a1 1 0 010-1.414z"
                        />
                    </svg>
                </button>
            </div>

            <!-- Mensaje de error para la entrada de contraseña -->
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <script>
            // Agregar un evento de clic al botón para mostrar/ocultar la contraseña
            document.getElementById('toggle-password').addEventListener('click', function () {
                // Obtener el campo de entrada de contraseña
                var passwordInput = document.getElementById('password');
                if (passwordInput.type === 'password') {
                    // Cambiar el tipo de entrada a "text" para mostrar la contraseña
                    passwordInput.type = 'text';
                } else {
                    // Cambiar el tipo de entrada a "password" para ocultar la contraseña
                    passwordInput.type = 'password';
                }
            });
        </script>


        <div class="my-6"></div>

                
        <!--  Botón para iniciar sesión-->
        <x-primary-button class="mt-4 w-full justify-center text-xl">
            {{ __('Iniciar sesión') }}
        </x-primary-button>
        @if (Route::has('password.request'))
        <!-- Boton direccionar a vista olvide la contraseña -->
        <div class="my-4"></div>

            <a style="text-decoration: none; " class="block mt-3 text-md text-teal-700 dark:text-teal-800 hover:text-teal-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 text-center" href="{{ route('password.request') }}">
                {{ __('¿Olvidaste tu contraseña?') }}
            </a>
            @endif
    </form>
</x-guest-layout>