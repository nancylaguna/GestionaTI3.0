document.addEventListener('DOMContentLoaded', function () {
    // Obtener referencia a los campos de selección
    var idiomaSelect = document.getElementById('idioma');
    var vacanteSelect = document.getElementById('vacante');

    // Agregar un evento de cambio a los campos de selección
    [idiomaSelect, vacanteSelect].forEach(function (select) {
        if (select) {
            select.addEventListener('change', function () {
                // Llamar a la función para manejar la lógica del formulario y limpiar filtros
                manejarFiltros();
            });
        }
    });

    // Función para limpiar filtros
    function limpiarFiltros(tipo) {
        var url = new URL(window.location.href);

        // Eliminar el parámetro específico si existe
        if (tipo === 'idioma' || tipo === 'vacante') {
            url.searchParams.delete(tipo);
        }

        window.location.href = url.toString();
    }

    // Agregar eventos de clic a los botones para limpiar filtros
    ['vacante', 'idioma'].forEach(function (filtro) {
        var eliminarFiltroButton = document.getElementById('eliminarFiltro' + filtro.charAt(0).toUpperCase() + filtro.slice(1));
        if (eliminarFiltroButton) {
            eliminarFiltroButton.addEventListener('click', function () {
                // Llamar a la función para limpiar filtros
                limpiarFiltros(filtro);
            });
        }
    });

    // Función para manejar la lógica del formulario y limpiar filtros
    function manejarFiltros() {
        // Obtener referencia al formulario
        var form = document.getElementById('filtroForm');
        // Enviar automáticamente el formulario
        form.submit();
    }
});
