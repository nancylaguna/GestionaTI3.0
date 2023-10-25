<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-2 dark:bg-gray-800 ">
                Mis candidatos son las siguientes
            </div>
            <p>Nombre| Correo</p>
            @forelse ($candidatos as $candidato)
            <p>{{$candidato->id . " " . $candidato->name . " " }}</p>
            @empty
            <p class="p-3 text-center text-gray-500 text-sm my-5">No hay registros</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
