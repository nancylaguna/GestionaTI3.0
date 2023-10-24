<section>
    <header>
        <!-- Apartado para actualizar nombre -->
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Perfil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Actualiza tu nombre.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Nombre')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-2/3" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Apartado para que aparezca el correo sin que se pueda modificar -->
        <div>
            <x-input-label for="email" :value="__('Correo')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-2/3 bg-stone-300" :value="$user->email" disabled/>
            <!-- El atributo "disabled" deshabilita el campo de correo electrónico -->
        </div>
        <!-- Boton para actualizar el nombre -->
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Actualizar') }}</x-primary-button>
            <!-- Actualizar el nombre -->
            @if (session('status') === 'profile-updated')
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