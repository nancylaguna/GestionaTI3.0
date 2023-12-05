<x-app-layout>
    <h1 class="flex text-black dark:text-black ml-10 text-2xl mt-1">Candidatos</h1>
   
    <div class="py-2">
        <!-- Contenedor ancho máximo y espaciado horizontal para los elementos principales -->
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">
      <!-- Formulario para el filtro de idioma -->
            <form id="filtroForm" action="{{ route('candidatos.index') }}" method="GET" class="mb-4 form-container">
            <label for="idioma">Idioma:</label>
                <select id="idioma" name="idioma" >
                    <option value="">Todos</option>
                    <option value="espanol" @if(request('idioma') === 'espanol') selected @endif>Español</option>
                    <option value="english" @if(request('idioma') === 'english') selected @endif>Inglés</option>
                </select>
                

                <!-- Botón para eliminar el filtro de idioma -->
                @if(request('idioma'))
    <button type="button" id="eliminarFiltroIdioma" class="inline-flex items-center px-2 py-3 rounded-md text-sm text-white dark:text-white uppercase tracking-widest hover:bg-teal-700 dark:hover:bg-teal-700 bg-teal-700">
    <i class="fa-solid fa-filter-circle-xmark fa-lg"></i>
   </button>
@endif


                <!-- Segundo filtro -->
                <label for="vacante">Vacante:</label>
                <select id="vacante" name="vacante" class="w-48"> <!-- Utiliza la clase w-XX para ajustar el ancho según tus necesidades -->
                    <option value="">Todas</option>
                    @foreach($vacantes as $vacante)
                        <option value="{{ $vacante->id }}" @if(request('vacante') == $vacante->id) selected @endif>
                            {{ $vacante->title }}
                        </option>
                    @endforeach
                </select>

                <!-- Botón para eliminar el filtro de vacante -->
                @if(request('vacante'))
                    <button type="button" id="eliminarFiltroVacante" class="inline-flex items-center px-2 py-3 rounded-md text-sm text-white dark:text-white uppercase tracking-widest hover:bg-teal-700 dark:hover:bg-teal-700 bg-teal-700 ">    <i class="fa-solid fa-filter-circle-xmark fa-lg"></i>
   </button>
</button>
                @endif
            </form>


            <table class="min-w-full divide-y divide-gray-200">
                <thead>
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
                    @foreach ($candidatos as $candidato)
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap text-sm">{{ $candidato['id'] }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap text-sm">{{ $candidato['nombre'] }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap text-sm">
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
    
    <!-- Paginación -->
    <section class="pagination">
        <!-- Contenedor ancho máximo y espaciado horizontal para la paginación -->
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-center">
            <!-- Enlaces de paginación con la información del filtro -->
            {{ $candidatos->links() }}
        </div>
    </section>

</x-app-layout>