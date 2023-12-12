<!-- Vista principal de gráficas (graficas.blade.php) -->

<x-app-layout>
    <!-- Título de la página -->
    <h1 class="flex text-black dark:text-black ml-10 text-2xl mt-1">Gráficas</h1>

    <!-- Contenedor ancho máximo y espaciado horizontal para los elementos principales -->
    <div class="py-2 max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <!-- Formulario para el filtro de idioma -->
        <form id="filtroForm" action="{{ route('graficas.index') }}" method="GET" class="mb-4 form-container">
            <label for="idiomas">Idiomas:</label>
            <select id="idiomas" name="idiomas[]" class="w-24 h-10 border border-teal-700 select2" multiple>
                <option value="espanol" @if(in_array('espanol', $selectedLanguages)) selected @endif>Español</option>
                <option value="english" @if(in_array('english', $selectedLanguages)) selected @endif>Inglés</option>
            </select>

            <!-- Botón para eliminar el filtro de idioma -->
            @if(!empty($selectedLanguages))
                <button 
                    type="button" 
                    id="eliminarFiltroIdioma" 
                    class="inline-flex items-center px-2 py-3 rounded-md text-sm text-white dark:text-white uppercase tracking-widest hover:bg-teal-700 dark:hover:bg-teal-700 bg-teal-700"
                    title="Eliminar filtro"
                >
                    <i class="fa-solid fa-filter-circle-xmark fa-lg"></i>
                </button>
            @endif

            <!-- Botón de envío del formulario -->
            <button type="submit" class="inline-flex items-center px-2 py-3 rounded-md text-sm text-white dark:text-white uppercase tracking-widest hover:bg-teal-700 dark:hover:bg-teal-700 bg-teal-700">
                Filtrar
            </button>
        </form>

        <!-- Sección para mostrar la gráfica -->
        @if(!empty($selectedLanguages))
            <div id="chart-container" style="height: 300px;"></div>

            <!-- Script para cargar la API de visualización y dibujar la gráfica -->
            <script>
                // Cargar la API de visualización y los paquetes necesarios
                google.charts.load('current', {'packages':['corechart']});

                // Llamar a la función de dibujo cuando se cargue la API
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    // Crear un array de datos con la información disponible
                    var data = google.visualization.arrayToDataTable([
                        ['Idioma', 'Cantidad'],
                        @foreach ($selectedLanguages as $language)
                            ['{{ ucfirst($language) }}', {{ $data[$language] }}],
                        @endforeach
                    ]);

                    // Configurar las opciones del gráfico
                    var options = {
                        title: 'Proporción de Candidatos por Idioma',
                        // Puedes ajustar otras opciones según tus preferencias
                    };

                    // Crear un objeto de gráfico de pastel y pasar los datos y opciones
                    var chart = new google.visualization.PieChart(document.getElementById('chart-container'));
                    chart.draw(data, options);
                }
            </script>
        @endif

        <!-- Script para inicializar Select2 -->
        <script>
            $(document).ready(function() {
                $('.select2').select2();
            });
        </script>
    </div>
</x-app-layout>
