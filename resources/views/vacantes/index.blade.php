<x-app-layout>
    <!-- Título de la página -->
    <h1 class="hidden sm:flex text-black dark:text-black ml-10 text-2xl mt-1">Vacantes</h1>

    <!-- Contenedor principal con espaciado en la parte superior -->
    <div class="py-2">
        <!-- Contenedor ancho máximo y espaciado horizontal para los elementos principales -->
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Formulario de filtro -->
            <form method="GET" action="{{ route('vacantes.index', ['filtro_estatus' => $filtroEstatus]) }}" class="mb-4 form-container ">
                <!-- Etiqueta del filtro -->
                <label for="filtro_estatus">Estatus:</label>
                <!-- Menú desplegable de opciones de filtro -->
                <select name="filtro_estatus" id="filtro_estatus" onchange="this.form.submit()"  class="w-32 h-10 border border-teal-700">
                    <option value="" {{ $filtroEstatus == '' ? 'selected' : '' }}>Todos</option>
                    <option value="1" {{ $filtroEstatus == '1' ? 'selected' : '' }}>Abierto</option>
                    <option value="2" {{ $filtroEstatus == '2' ? 'selected' : '' }}>Pendiente</option>
                    <option value="3" {{ $filtroEstatus == '3' ? 'selected' : '' }}>Cerrado</option>
                </select>
                <!-- Botón para eliminar el filtro si está presente -->
                @if ($filtroEstatus)
                    <button 
                        type="button" 
                        onclick="window.location='{{ route('vacantes.index') }}'" 
                        class="inline-flex items-center px-2 py-3 rounded-md text-sm text-white dark:text-white uppercase tracking-widest hover:bg-teal-700 dark:hover:bg-teal-700 bg-teal-700"
                        title="Eliminar filtro"
                    >
                        <i class="fa-solid fa-filter-circle-xmark fa-lg"></i>
                    </button>
                @endif
            </form>

            <!-- Tabla de vacantes -->
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <!-- Encabezados de la tabla -->
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">#</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Título de la vacante</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Presupuesto</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Estatus</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Sugeridos</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Registros</th>
                    </tr>                
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Datos de la tabla -->
                    @foreach ($vacantes as $vacante)
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap">{{ $vacante->id }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap">{{ $vacante->title }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap">{{ $vacante->detail ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap">
                                <!-- Condición para mostrar el texto de estatus -->
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
                            <td class="px-6 py-4 whitespace-no-wrap">{{ $vacante->candidatos_cumplen_req }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap">{{ $vacante->num_candidatos }}</td>
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
            {{ $vacantes->appends(['filtro_estatus' => $filtroEstatus])->onEachSide(1)->links() }}
        </div>
    </section>
</x-app-layout>
