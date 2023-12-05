<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-3xl lg:text-4xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Perfil') }}
        </h1>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Actualizar perfil -->  
            <div class="p-4 sm:p-2 dark:bg-gray-800 ">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
            
            <!-- Actualizar contraseña -->  
            <div class="py-0 p-0 sm:p-2 dark:bg-gray-800" id="change-password-section" style="display: none;">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Botón para mostrar/ocultar la sección de cambiar contraseña -->
            <x-primary-button id="toggle-password-section">{{ __('Cambiar contraseña') }}</x-primary-button>


            <!-- <button id="toggle-password-section" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Mostrar Cambiar Contraseña</button> -->
        </div>
    </div>

    
</x-app-layout>
