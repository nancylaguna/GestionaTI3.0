<x-app-layout>
    <!-- ... (tu código existente) ... -->

    <!-- Gráfico de pastel -->
    <canvas id="myChart" width="400" height="200"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            updateChart(); // Llamar a la función al cargar la página
        });

        function updateChart() {
            // Obtener datos desde el controlador
            axios.get('/get-chart-data')
                .then(function (response) {
                    var data = response.data;

                    // Crear el gráfico de pastel con los datos obtenidos
                    createPieChart(data);
                })
                .catch(function (error) {
                    console.error('Error al obtener los datos del gráfico: ' + error);
                });
        }

        function createPieChart(data) {
            // Configuración del gráfico de pastel
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: data.map(item => item.idioma),
                    datasets: [{
                        data: data.map(item => item.total),
                        backgroundColor: getColors(data.length), // Función para obtener colores
                        borderColor: 'rgba(255, 255, 255, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        }

        function getColors(length) {
            // Función para generar colores de forma dinámica
            var colors = [];
            for (var i = 0; i < length; i++) {
                colors.push('rgba(' + getRandomInt(0, 255) + ',' + getRandomInt(0, 255) + ',' + getRandomInt(0, 255) + ', 0.2)');
            }
            return colors;
        }

        function getRandomInt(min, max) {
            // Función para generar números aleatorios enteros
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }
    </script>
</x-app-layout>



