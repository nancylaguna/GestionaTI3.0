<x-app-layout>
    <style>
        /* Estilo para ajustar el ancho del select2 */
        .js-example-basic-multiple {
            width: 20%;
        }
    </style>

    <!-- Título de la página -->
    <h1 class="flex text-black dark:text-black ml-10 text-2xl mt-1">Gráficas</h1>

    <!-- Contenedor ancho máximo y espaciado horizontal para los elementos principales -->
    <div class="py-2 max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <!-- Formulario para el filtro de idioma -->
        <form id="filtroForm" action="{{ route('graficas.index') }}" method="GET" class="mb-4 form-container">
            <!-- Etiqueta del formulario -->
            <label for="idiomas">Idiomas:</label>
            <!-- Selección múltiple para idiomas -->
            <select id="idiomas" name="idiomas[]" class="js-example-basic-multiple" multiple="multiple">
                <!-- Opción para Español -->
                <option value="espanol" {{ in_array('espanol', $selectedLanguages) ? 'selected' : '' }}>Español</option>
                <!-- Opción para Inglés -->
                <option value="english" {{ in_array('english', $selectedLanguages) ? 'selected' : '' }}>Inglés</option>
            </select>

            
            <!-- Botón de envío del formulario -->
            <button type="submit" class="inline-flex items-center px-2 py-1 rounded-md text-sm text-white dark:text-white uppercase tracking-widest hover:bg-teal-700 dark:hover:bg-teal-700 bg-teal-700">
                Filtrar
            </button>
        </form>

        <!-- Script para inicializar Select2 -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Tu código de inicialización de Select2 aquí
                $('.js-example-basic-multiple').select2();
            });
        </script>

        <!-- Sección para mostrar la gráfica -->
        @if(!empty($selectedLanguages))
            <!-- Contenedor para la gráfica -->
            <div id="chart_div"></div>

            <!-- Script para cargar la API de visualización y dibujar la gráfica -->
            <script>
                // Cargar la API de visualización y los paquetes necesarios
                google.charts.load('current', {'packages':['corechart']});

                // Llamar a la función de dibujo cuando se cargue la API
                google.charts.setOnLoadCallback(drawChart);

                // Función para dibujar la gráfica
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
                        width: 400,
                        height: 300,
                        // Puedes ajustar otras opciones según tus preferencias
                    };

                    // Crear un objeto de gráfico de pastel y pasar los datos y opciones
                    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                    chart.draw(data, options);
                }
            </script>
        @endif
    </div>
</x-app-layout>
