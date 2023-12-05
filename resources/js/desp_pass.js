document.addEventListener('DOMContentLoaded', function () {
    const passwordSection = document.getElementById('change-password-section');
    const profileSection = document.querySelector('section');

    const toggleButton = document.getElementById('toggle-password-section');
    const updatePasswordButton = document.getElementById('update-password-btn');
    const passwordForm = document.getElementById('password-update-form');

    toggleButton.addEventListener('click', function () {
        if (passwordSection.style.display === 'none' || passwordSection.style.display === '') {
            // Mostrar la sección de cambiar contraseña y ocultar la sección de perfil
            passwordSection.style.display = 'block';
            toggleButton.textContent = 'Cancelar';
            profileSection.style.display = 'none';
        } else {
            // Ocultar la sección de cambiar contraseña y mostrar la sección de perfil
            passwordSection.style.display = 'none';
            toggleButton.textContent = 'Cambiar Contraseña';
            profileSection.style.display = 'block';
        }
    });

    updatePasswordButton.addEventListener('click', function (event) {
        // Validar la contraseña aquí
        const newPassword = passwordForm.querySelector('#password').value;
        const confirmPassword = passwordForm.querySelector('#password_confirmation').value;

        if (newPassword.length < 8) {
            alert('La contraseña debe tener al menos 8 caracteres.');
            event.preventDefault(); // Evitar que se envíe el formulario si no cumple con los requisitos
        } else if (newPassword !== confirmPassword) {
            alert('Las contraseñas no coinciden.');
            event.preventDefault(); // Evitar que se envíe el formulario si no cumple con los requisitos
        } else {
            // Si cumple con los requisitos, cambiar al div de perfil
            passwordSection.style.display = 'none';
            profileSection.style.display = 'block';
            toggleButton.textContent = 'Cambiar Contraseña';
        }
    });
});


