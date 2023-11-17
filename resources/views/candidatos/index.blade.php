<x-app-layout>
    <h1 class="hidden sm:flex text-black dark:text-black ml-10 text-2xl mt-1">Candidatos</h1>
   
    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            ID
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Nombre
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Requerimientos
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Idiomas
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Acción
                        </th>
                    </tr>                
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($candidatos as $candidato)
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap">{{ $candidato['id'] }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap">{{ $candidato['nombre'] }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap">
                                @foreach ($candidato['requerimientos'] as $requerimiento)
                                    {{ $requerimiento }}
                                    @if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap">
                                @foreach ($candidato['idiomas'] as $idioma)
                                    {{ $idioma }}
                                    @if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap">
                                @if (!str_starts_with($candidato['cv_url'], 'userFiles/'))
                                    <a href="{{ $candidato['cv_url'] }}" target="_blank">
                                        <img src="{{ asset('storage/img/ver.ico') }}" alt="Ver CV" class="w-8 h-8 cursor-pointer">
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>