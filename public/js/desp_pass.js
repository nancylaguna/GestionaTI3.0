document.addEventListener('DOMContentLoaded', function () {
    const passwordSection = document.getElementById('change-password-section');
    const profileSection = document.querySelector('section');
    const toggleButton = document.getElementById('toggle-password-section');
    const updatePasswordButton = document.getElementById('update-password-btn');
    const passwordForm = document.getElementById('password-update-form');

    function updateUrl(section) {
        const url = new URL(window.location.href);
        url.searchParams.set('section', section);
        window.history.pushState({ section }, '', url);
    }

    function showSectionFromUrl() {
        const url = new URL(window.location.href);
        const sectionParam = url.searchParams.get('section');
        const isPasswordSection = sectionParam === 'password';

        passwordSection.style.display = isPasswordSection ? 'block' : 'none';
        profileSection.style.display = isPasswordSection ? 'none' : 'block';
        toggleButton.textContent = isPasswordSection ? 'Cancelar' : 'Cambiar Contraseña';
    }

    showSectionFromUrl();

    toggleButton.addEventListener('click', function () {
        const isPasswordSection = passwordSection.style.display === 'none' || passwordSection.style.display === '';

        passwordSection.style.display = isPasswordSection ? 'block' : 'none';
        profileSection.style.display = isPasswordSection ? 'none' : 'block';
        toggleButton.textContent = isPasswordSection ? 'Cancelar' : 'Cambiar Contraseña';
        updateUrl(isPasswordSection ? 'password' : 'profile');
    });

    updatePasswordButton.addEventListener('click', async function (event) {
        event.preventDefault(); // Evitar la recarga de la página

        try {
            // Simular una petición asíncrona (reemplazar con la lógica de tu aplicación)
            await new Promise((resolve, reject) => {
                // Lógica de validación y actualización en el servidor
                throw new Error('Error de contraseña'); // Simulando un error
            });

            passwordSection.style.display = 'none';
            profileSection.style.display = 'block';
            toggleButton.textContent = 'Cambiar Contraseña';
            updateUrl('profile');
        } catch (error) {
            alert('Error al actualizar la contraseña. Verifica la información ingresada.');
        }
    });
});
