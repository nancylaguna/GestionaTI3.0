document.addEventListener('DOMContentLoaded', function () {
    updateChart(); // Llamar a la función al cargar la página
});

function updateChart() {
    var languageName = document.getElementById('language').value;

    // Enviar la solicitud AJAX al controlador para obtener los datos del gráfico
    axios.post('/get-chart-data', { language_name: languageName })
        .then(function (response) {
            var count = response.data.count;

            // Crear el gráfico de pastel con los datos obtenidos
            createPieChart(count);
        })
        .catch(function (error) {
            console.error('Error al obtener los datos del gráfico: ' + error);
        });
}

function createPieChart(count) {
    // Configuración del gráfico de pastel
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Candidatos'],
            datasets: [{
                data: [count],
                backgroundColor: ['rgba(255, 99, 132, 0.2)'], // Puedes personalizar los colores
                borderColor: ['rgba(255, 99, 132, 1)'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
}
