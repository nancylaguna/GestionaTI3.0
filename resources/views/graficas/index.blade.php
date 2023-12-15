<x-app-layout>
    <!-- Script para gráficas -->
    <script src="{{ asset('js/graficas.js') }}"></script>

    <!-- Título de la página -->
    <h1 class="flex text-black dark:text-black ml-10 text-2xl mt-1">Gráficas</h1>

    <!-- Contenedor ancho máximo y espaciado horizontal para los elementos principales -->
    <div class="py-2 max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <!-- Formulario para el filtro de idioma -->
        <form id="filtroForm" action="{{ route('graficas.index') }}" method="GET" class="mb-4 form-container">
            <!-- Etiqueta del formulario -->
            <label for="idiomas">Idiomas:</label>
            <!-- Selección múltiple para idiomas -->
            <select id="idiomas" name="idiomas[]" class="js-example-basic-multiple w-48" multiple="multiple">
                <!-- Opción para Español -->
                <option value="espanol" {{ in_array('espanol', (array)$selectedLanguages) ? 'selected' : '' }}>Español</option>
                <!-- Opción para Inglés -->
                <option value="english" {{ in_array('english', (array)$selectedLanguages) ? 'selected' : '' }}>Inglés</option>
            </select>
            
            <!-- Botón de envío del formulario de idiomas -->
            <button
                type="submit" id="filtroIdiomasBtn" class="inline-flex items-center px-2 py-3 rounded-md text-sm text-white dark:text-white uppercase tracking-widest hover:bg-teal-700 dark:hover:bg-teal-700 bg-teal-700" title="Graficar idiomas">
                <i class="fa-solid fa-filter"></i>
            </button>

            <!-- Etiqueta del formulario -->
            <label for="vacantes">Vacantes:</label>
            <!-- Selección múltiple para vacantes -->
            <select id="vacantes" name="vacante[]" class="js-example-basic-multiple" multiple="multiple">
                @foreach ($vacantes as $vacante)
                    <option value="{{ $vacante->id }}" {{ in_array($vacante->id, (array)old('vacante', $selectedVacante)) ? 'selected' : '' }}>
                        {{ $vacante->title }}
                    </option>
                @endforeach
            </select>
            
            <!-- Botón de envío del formulario de vacante -->
            <button type="submit" id="filtroVacanteBtn" class="inline-flex items-center px-2 py-3 rounded-md text-sm text-white dark:text-white uppercase tracking-widest hover:bg-teal-700 dark:hover:bg-teal-700 bg-teal-700" title="Graficar vacantes">
                <i class="fa-solid fa-filter"></i>
            </button>
        </form>

        <!-- Script para inicializar Select2 -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                console.log('Select2 initialization started...');
                
                $('.js-example-basic-multiple').select2();

                console.log('Select2 initialization completed.');
            });
        </script>

        <div class="flex">
            <!-- Sección para mostrar la gráfica de Idiomas -->
            @if(!empty($selectedLanguages))
                <!-- Contenedor para la gráfica de Idiomas -->
                <div id="chart_div_idiomas" class="mr-2">
                    <!-- Script para cargar la API de visualización y dibujar la gráfica de Idiomas -->
                    <script>
                        // Cargar la API de visualización y los paquetes necesarios
                        google.charts.load('current', {'packages': ['corechart']});

                        // Llamar a la función de dibujo cuando se cargue la API
                        google.charts.setOnLoadCallback(drawChartIdiomas);

                        // Función para dibujar la gráfica de Idiomas
                        function drawChartIdiomas() {
                            // Crear un array de datos con la información disponible
                            var data = google.visualization.arrayToDataTable([
                                ['Idioma', 'Cantidad'],
                                @foreach ($selectedLanguages as $language)
                                    ['{{ ucfirst($language) }}', {{ $dataIdiomas[$language] }}],
                                @endforeach
                            ]);

                            // Configurar las opciones del gráfico
                            var options = {
                                title: 'Candidatos por Idioma',
                                width: 400,
                                height: 300,
                            };

                            // Crear un objeto de gráfico de pastel y pasar los datos y opciones
                            var chart = new google.visualization.PieChart(document.getElementById('chart_div_idiomas'));
                            chart.draw(data, options);
                        }
                    </script>
                </div>
                <!-- Botón para descargar PDF de la gráfica de Idiomas -->
                <div class="mt-4">
                    <button id="downloadPdfIdiomasBtn" class="inline-flex items-center px-4 py-2 rounded-md text-sm font-medium text-white bg-teal-700 hover:bg-teal-800 focus:outline-none focus:shadow-outline-teal active:bg-teal-800" title="Descargar PDF (Idiomas)">
                        <i class="fa-solid fa-file-arrow-down"></i>
                    </button>
                </div>

                <!-- Script para descargar PDF de la gráfica de Idiomas -->
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
    var downloadPdfIdiomasBtn = document.getElementById('downloadPdfIdiomasBtn');

    if (downloadPdfIdiomasBtn) {
        downloadPdfIdiomasBtn.addEventListener('click', function () {
            var graficasContainer = document.getElementById('chart_div_idiomas'); 

            if (graficasContainer) {
                // Crear un nuevo elemento div para contener tanto la imagen como la gráfica
                var containerDiv = document.createElement('div');

                // Encabezado con la imagen a la izquierda y "Gestionati" a la derecha
                var header = document.createElement('header');
                header.innerHTML = `
                <div style="float: left;">
                                            <img src="{{ asset('storage/img/th3codelogo.ico') }}" alt="Perfil" class="w-20 h-20 mb-8">
                                        </div>
                                        <div style="float: left; margin-top: 20px;">
                                        <p style="font-weight: bold; font-size: larger; color: #008080;">Gestionati</p>
                                        </div>
                                        <div style="clear: both;"></div> <!-- Limpiar el float para que el texto aparezca más abajo -->
                                      `;

                // Agregar el encabezado al contenedor
                containerDiv.appendChild(header);

                // Agregar la gráfica al contenedor
                containerDiv.appendChild(graficasContainer.cloneNode(true));

                // Configurar opciones para la descarga del PDF
                var opt = {
                    margin:       10,
                    filename:     'graficaIdioma.pdf',
                    image:        { type: 'jpeg', quality: 0.98 },
                    html2canvas:  { scale: 2 },
                    jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
                };

                // Generar el PDF desde el contenedor que ahora contiene la imagen y la gráfica
                html2pdf().from(containerDiv).set(opt).save();
            } else {
                console.error('No se encontró el contenedor de la gráfica de Idiomas.');
            }
        });
    }
});

                </script>
            @endif

            <!-- Sección para mostrar la gráfica de Vacantes -->
            @if(!empty($selectedVacante))
                <!-- Contenedor para la gráfica de Vacantes -->
                <div id="chart_div_vacantes" class="mr-2 ml-2">
                    <!-- Script para cargar la API de visualización y dibujar la gráfica de Vacantes -->
                    <script>
                        // Cargar la API de visualización y los paquetes necesarios
                        google.charts.load('current', {'packages': ['corechart']});

                        // Llamar a la función de dibujo cuando se cargue la API
                        google.charts.setOnLoadCallback(drawChartVacantes);

                        // Función para dibujar la gráfica de Vacantes
                        function drawChartVacantes() {
                            // Crear un array de datos con la información disponible
                            var dataVacantes = new google.visualization.DataTable();
                            dataVacantes.addColumn('string', 'Vacante');
                            dataVacantes.addColumn('number', 'Cantidad de Candidatos');

                            @foreach ($dataVacantes['titles'] as $title)
                                dataVacantes.addRow(['{{ $title }}', 0]);
                            @endforeach

                            // Actualizar la cantidad de candidatos por cada vacante seleccionada
                            @foreach ($dataVacantes['data'] as $index => $count)
                                dataVacantes.setValue({{ $index }}, 1, {{ $count }});
                            @endforeach

                            // Configurar las opciones del gráfico de Vacantes (pastel)
                            var optionsVacantes = {
                                title: 'Candidatos por Vacante',
                                width: 450,
                                height: 300,
                            };

                            // Crear un objeto de gráfico de pastel y pasar los datos y opciones
                            var chartVacantes = new google.visualization.PieChart(document.getElementById('chart_div_vacantes'));
                            chartVacantes.draw(dataVacantes, optionsVacantes);
                        }
                    </script>
                </div>
                <!-- Botón para descargar PDF de la gráfica de Vacantes -->
                <div class="mt-4">
                    <button id="downloadPdfVacantesBtn" class="inline-flex items-center px-4 py-2 rounded-md text-sm font-medium text-white bg-teal-700 hover:bg-teal-800 focus:outline-none focus:shadow-outline-teal active:bg-teal-800" title="Descargar PDF (Vacantes)">
                        <i class="fa-solid fa-file-arrow-down"></i>
                    </button>
                </div>

                <!-- Script para descargar PDF de la gráfica de Vacantes -->
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        var downloadPdfVacantesBtn = document.getElementById('downloadPdfVacantesBtn');

                        if (downloadPdfVacantesBtn) {
                            downloadPdfVacantesBtn.addEventListener('click', function () {
                                var graficasContainer = document.getElementById('chart_div_vacantes');

                                if (graficasContainer) {
                                    // Obtener los nombres completos de las vacantes seleccionadas
                                    var selectedVacanteNames = [];
                                    var selectedVacanteOptions = document.querySelectorAll('#vacantes option:checked');
                                    selectedVacanteOptions.forEach(function (option) {
                                        selectedVacanteNames.push(option.text);
                                    });

                                    // Crear una estructura HTML consolidada para el PDF
                                    var pdfContent = document.createElement('div');

                                    // Encabezado con la imagen a la izquierda y "Gestionati" a la derecha
                                    var header = document.createElement('header');
                                    header.innerHTML = `
                                        <div style="float: left;">
                                            <img src="{{ asset('storage/img/th3codelogo.ico') }}" alt="Perfil" class="w-20 h-20 mb-8">
                                        </div>
                                        <div style="float: left; margin-top: 20px;">
                                        <p style="font-weight: bold; font-size: larger; color: #008080;">Gestionati</p>
                                        </div>
                                        <div style="clear: both;"></div> <!-- Limpiar el float para que el texto aparezca más abajo -->
                                    `;
                                    pdfContent.appendChild(header);

                                    // Clonar el contenedor de gráficos y añadirlo al documento
                                    pdfContent.appendChild(graficasContainer.cloneNode(true));

                                    // Contenido de las vacantes
                                    pdfContent.innerHTML += `
                                        <div style="margin-top:20px;">
                                            <p style="font-weight: bold; font-size: larger;">Vacantes seleccionadas:</p>
                                            <ul>
                                                <li>${selectedVacanteNames.join('</li><li>')}</li>
                                            </ul>
                                        </div>
                                    `;

                                    // Esperar 2 segundos antes de generar el PDF (ajusta este tiempo según sea necesario)
                                    setTimeout(function () {
                                        var opt = {
                                            margin: 10,
                                            filename: 'graficaVacante.pdf',
                                            image: { type: 'jpeg', quality: 0.98 },
                                            html2canvas: { scale: 2 },
                                            jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
                                        };

                                        html2pdf().from(pdfContent).set(opt).save();
                                    }, 2000); // Ajusta el tiempo de espera según sea necesario
                                } else {
                                    console.error('No se encontró el contenedor de la gráfica de Vacantes.');
                                }
                            });
                        }
                    });
                </script>
            @endif
        </div>            
    </div>
</x-app-layout>
