        document.addEventListener('DOMContentLoaded', function () {
            // Obtén referencias a los elementos relevantes
            const passwordSection = document.getElementById('change-password-section');
            const toggleButton = document.getElementById('toggle-password-section');

            // Agrega un evento de clic al botón para mostrar/ocultar la sección de cambiar contraseña
            toggleButton.addEventListener('click', function () {
                if (passwordSection.style.display === 'none') {
                    passwordSection.style.display = 'block';
                    toggleButton.textContent = 'Ocultar';
                } else {
                    passwordSection.style.display = 'none';
                    toggleButton.textContent = 'Cambiar Contraseña';
                }
            });
        });
