<!-- Botón para la interfaz de cambio de vistas -->
<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'inline-flex items-center px-4 py-2 bg-transparent rounded-md text-2xl text-white dark:text-white uppercase tracking-widest hover:bg-teal-700 dark:hover:bg-teal-700 focus:bg-teal-700 dark:focus:bg-teal-950 active:bg-teal-700 dark:active:bg-teal-950 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 hover:shadow-xl',
]) }}>
    {{ $slot }}
</button>
