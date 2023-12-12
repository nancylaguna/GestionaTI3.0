<!-- Vista para actualizar la contraseña (update-password-form.blade.php) -->

<section id="change-password-section">
    <header>
        <!-- Sección para actualizar la contraseña -->
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Cambiar contraseña') }}
        </h2>

        <p class="mt-1 text-md text-gray-600 dark:text-gray-400">
            {{ __('Asegúrese de que su cuenta utilice una contraseña larga y aleatoria para mantenerse segura.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-0 space-y-6">
        @csrf
        @method('put')

        <!-- Campo para la contraseña actual -->
        <div>
            <label for="current_password" class="text-slate-600">Contraseña actual:</label>
            <div class="relative">
                <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-2/3 h-8 pr-10" autocomplete="current-password" />
                <!-- Boton para ver la contraseña -->
                <button
                    type="button"
                    id="toggle-current-password"
                    class="absolute top-1/2 right-0 mt-2 mr-48 p-2 text-gray-500 cursor-pointer transform -translate-y-1/2"
                    style="z-index: 2;"
                    onclick="togglePassword('current_password')"
                >
                    <img
                        src="{{ asset('storage/img/ver.ico') }}"
                        alt="Icono Ver"
                        class="w-1 h-2 mb-5"
                        style="width: 2rem; height: 2rem;"
                    />
                </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <!-- Campo para la nueva contraseña -->
        <div>
            <label for="password" class="text-slate-600">Nueva contraseña:</label>
            <div class="relative">
                <x-text-input id="password" name="password" type="password" class="mt-1 block w-2/3 h-8 pr-10" autocomplete="new-password" />
                <!-- Boton para ver la contraseña -->                
                <button
                    type="button"
                    id="toggle-new-password"
                    class="absolute top-1/2 right-0 mt-2 mr-48 p-2 text-gray-500 cursor-pointer transform -translate-y-1/2"
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
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <!-- Campo para repetir la contraseña -->
        <div>
            <label for="password_confirmation" class="text-slate-600">Confirma la contraseña:</label>
            <div class="relative">
                <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-2/3 h-8 pr-10" autocomplete="new-password" />
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Botón para actualizar la contraseña -->
        <div class="flex items-center ">
            <x-primary-button title="Actualizar contraseña">{{ __('Actualizar') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Actualizado') }}</p>
            @endif
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
</section>
