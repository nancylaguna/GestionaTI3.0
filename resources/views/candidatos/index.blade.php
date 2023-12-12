<!-- Vista principal de candidatos (candidatos.blade.php) -->

<x-app-layout>
    <!-- Título de la página -->
    <h1 class="flex text-black dark:text-black ml-10 text-2xl mt-1">Candidatos</h1>

    <!-- Contenedor ancho máximo y espaciado horizontal para los elementos principales -->
    <div class="py-2 max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <!-- Formulario para el filtro de idioma y vacante -->
        <form id="filtroForm" action="{{ route('candidatos.index') }}" method="GET" class="mb-4 form-container ">
            <!-- Filtro de idioma -->
            <label for="idioma">Idioma:</label>
            <select id="idioma" name="idioma" class="w-24 h-10 border border-teal-700">
                <option value="">Todos</option>
                <option value="espanol" @if(request('idioma') === 'espanol') selected @endif>Español</option>
                <option value="english" @if(request('idioma') === 'english') selected @endif>Inglés</option>
            </select>

            <!-- Botón para eliminar el filtro de idioma -->
            @if(request('idioma'))
               <button 
                    type="button" 
                    id="eliminarFiltroIdioma" 
                    class="inline-flex items-center px-2 py-3 rounded-md text-sm text-white dark:text-white uppercase tracking-widest hover:bg-teal-700 dark:hover:bg-teal-700 bg-teal-700"
                    title="Eliminar filtro"
                >
                    <i class="fa-solid fa-filter-circle-xmark fa-lg"></i>
                </button>
            @endif

            <!-- Filtro de vacante -->
            <label for="vacante">Vacante:</label>
            <select id="vacante" name="vacante" class="w-48 h-10 border border-teal-700">
                <option value="">Todas</option>
                @foreach($vacantes as $vacante)
                    <option value="{{ $vacante->id }}" @if(request('vacante') == $vacante->id) selected @endif>
                        {{ $vacante->title }}
                    </option>
                @endforeach
            </select>

            <!-- Botón para eliminar el filtro de vacante -->
            @if(request('vacante'))
                <button 
                    type="button" 
                    id="eliminarFiltroVacante" 
                    class="inline-flex items-center px-2 py-3 rounded-md text-sm text-white dark:text-white uppercase tracking-widest hover:bg-teal-700 dark:hover:bg-teal-700 bg-teal-700"
                    title="Eliminar filtro"
                >
                    <i class="fa-solid fa-filter-circle-xmark fa-lg"></i>
                </button>
            @endif
        </form>

        <!-- Tabla de candidatos -->
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <!-- Encabezados de la tabla -->
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        #
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

            <tbody class="bg-white divide-y divide-gray-200 text-sm">
                <!-- Filas de datos de candidatos -->
                @foreach ($candidatos as $candidato)
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm">{{ $candidato['id'] }}</td>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm">{{ $candidato['nombre'] }}</td>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm">
                            <!-- Requerimientos -->
                            @if ($candidato['requerimientos'])
                                @foreach ($candidato['requerimientos'] as $requerimiento)
                                    {{ $requerimiento }}
                                    @if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm">
                            <!-- Idiomas -->
                            @if ($candidato['idiomas'])
                                @foreach ($candidato['idiomas'] as $idioma)
                                    {{ $idioma }}
                                    @if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm">
                            <!-- Acción - Ver CV -->
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

    <!-- Paginación -->
    <section class="pagination">
        <!-- Contenedor ancho máximo y espaciado horizontal para la paginación -->
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-center">
            <!-- Enlaces de paginación con la información del filtro -->
            {{ $candidatos->links() }}
        </div>
    </section>
</x-app-layout>
