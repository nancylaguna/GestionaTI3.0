<x-app-layout>
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
                    @foreach ($candidatos as $candidatoId => $infoCandidato)
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap">{{ $candidatoId }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap">{{ $infoCandidato['nombre'] }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap">
                                @foreach ($infoCandidato['requerimientos'] as $requerimiento)
                                    {{ $requerimiento }}
                                    @if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap">
                                @foreach ($infoCandidato['idiomas'] as $idioma)
                                    {{ $idioma }}
                                    @if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap">
    @if (strpos($infoCandidato['cv_url'], 'userFiles/') !== 0)
        <a href="{{ $infoCandidato['cv_url'] }}" target="_blank">
            <img src="{{ asset('storage/img/ojo.ico') }}" alt="Ver CV" class="w-8 h-8 cursor-pointer">
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



