// Esperar a que el DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', function () {
    // Obtener referencias a los botones de filtro de idiomas y vacantes
    var filtroIdiomasBtn = document.getElementById('filtroIdiomasBtn');
    var filtroVacanteBtn = document.getElementById('filtroVacanteBtn');

    // Verificar si los botones existen
    [filtroIdiomasBtn, filtroVacanteBtn].forEach(function (btn) {
        if (btn) {
            // Agregar un evento de clic a cada botón
            btn.addEventListener('click', function () {
                // Deshabilitar el botón temporalmente para evitar envíos múltiples
                btn.setAttribute('disabled', 'disabled');

                // Obtener referencia al formulario
                var form = document.getElementById('filtroForm');
                
                // Enviar automáticamente el formulario
                form.submit();
            });
        }
    });
});
