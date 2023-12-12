<!-- Vista para actualizar la información del perfil (update-profile-information-form.blade.php) -->

<section id="profile-section">
    <header>
        <!-- Sección para actualizar el nombre -->
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Perfil') }}
        </h2>

        <p class="mt-1 text-md text-gray-600 dark:text-gray-400">
            {{ __('Actualiza tu nombre') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Campo para el nombre -->
        <div>
            <label for="name" class="text-slate-600	">Nombre:</label>
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-2/3 h-10" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2 ml-2" :messages="$errors->get('name')" />
        </div>

        <!-- Campo para mostrar el correo electrónico sin posibilidad de modificación -->
        <div>
            <label for="email" class="text-slate-600	">Correo:</label>
            <x-text-input 
                id="email" 
                name="email" 
                type="email" 
                class="mt-1 block w-2/3 bg-stone-300 h-10" 
                :value="$user->email" 
                disabled
                title="No se puede modificar el email"
            />
            <!-- El atributo "disabled" deshabilita el campo de correo electrónico -->
        </div>

        <!-- Botón para actualizar el nombre -->
        <div class="flex items-center gap-4">
            <x-primary-button title="Actualizar nombre">{{ __('Actualizar') }}</x-primary-button>

            <!-- Mensaje de éxito después de actualizar el nombre -->
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

        <!-- Botón para cambiar la contraseña (comentado) -->
        <!-- <x-primary-button  class="block mt-3 text-md text-teal-700 dark:text-teal-800 hover:text-teal-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 text-center mr-20" >
                {{ __('Cambiar contraseña') }}
        </x-primary-button> -->
    </form>
</section>
