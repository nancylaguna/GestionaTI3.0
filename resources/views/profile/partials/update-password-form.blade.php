<!-- update-password-from.blade.php -->
<section id="change-password-section">
    <header>
        <!-- Apartado para actualizar contraseña -->
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

        <!-- Apartado para la contraseña antigua -->
        <div>
            <label for="current_password" class="text-slate-600	">Contraseña antigua:</label>
            <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-2/3 h-8" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>
        <!-- Apartado para la contraseña nueva -->
        <div>
            <label for="password" class="text-slate-600	">Nueva contraseña:</label>
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-2/3 h-8" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>
        <!-- Apartado para repetir la contraseña -->
        <div>
        <label for="password_confirmation" class="text-slate-600	">Confirma la contraseña:</label>

            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-2/3 h-8" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>
        <!-- Boton para actualizar la contraseña -->
        <div class="flex items-center ">
            <x-primary-button title="Actualizar contraseña">{{ __('Actualizar') }}</x-primary-button>
            <!-- Actualizar la contraseña -->

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
</section>



