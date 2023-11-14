<x-app-layout>
    <h1 class="hidden sm:flex text-black dark:text-black ml-10 text-2xl mt-1">Vacantes</h1>
    
    <div class="py-6">

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            ID
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Título de la vacante
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Presupuesto
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Estatus
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Sugeridos
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Registros
                        </th>
                    </tr>                
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($vacantes as $vacante)
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap">{{ $vacante->id }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap">{{ $vacante->title }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap">{{ $vacante->detail ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap">
                                @if ($vacante->status == 1)
                                    Abierto
                                @elseif ($vacante->status == 2)
                                    Pendiente
                                @elseif ($vacante->status == 3)
                                    Cerrado
                                @elseif ($vacante->status == 4)
                                    Abierto
                                @else
                                    Otro estado
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap">{{ $vacante->id }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap">{{ $vacante->id }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>