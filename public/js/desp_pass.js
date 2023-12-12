//JS para la seccion de perfil para mostrar/ocultar la seccion de contraseña
document.addEventListener('DOMContentLoaded', function () {
    const passwordSection = document.getElementById('change-password-section');
    const profileSection = document.querySelector('section');

    const toggleButton = document.getElementById('toggle-password-section');
    const updatePasswordButton = document.getElementById('update-password-btn');
    const passwordForm = document.getElementById('password-update-form');

    // Función para cambiar la URL y agregar un parámetro indicando la sección actual
    function updateUrl(section) {
        const url = new URL(window.location.href);
        url.searchParams.set('section', section);
        window.history.pushState({ section }, '', url);
    }

    // Función para mostrar la sección según el parámetro de la URL
    function showSectionFromUrl() {
        const url = new URL(window.location.href);
        const sectionParam = url.searchParams.get('section');
        if (sectionParam === 'password') {
            passwordSection.style.display = 'block';
            profileSection.style.display = 'none';
        } else {
            passwordSection.style.display = 'none';
            profileSection.style.display = 'block';
        }
    }

    // Mostrar la sección según el parámetro de la URL al cargar la página
    showSectionFromUrl();

    toggleButton.addEventListener('click', function () {
        if (passwordSection.style.display === 'none' || passwordSection.style.display === '') {
            passwordSection.style.display = 'block';
            profileSection.style.display = 'none';
            toggleButton.textContent = 'Cancelar';
            // Cambiar la URL al hacer clic en "Cambiar Contraseña"
            updateUrl('password');
        } else {
            passwordSection.style.display = 'none';
            profileSection.style.display = 'block';
            toggleButton.textContent = 'Cambiar Contraseña';
            // Cambiar la URL al hacer clic en "Cancelar"
            updateUrl('profile');
        }
    });

    updatePasswordButton.addEventListener('click', function (event) {
        const currentPassword = passwordForm.querySelector('#current_password').value;
        const newPassword = passwordForm.querySelector('#password').value;
        const confirmPassword = passwordForm.querySelector('#password_confirmation').value;

        //Validar que la contraseña nueva cumpla con los requisitos minimos
        const validationMessage = isValidCurrentPassword(currentPassword);
        if (validationMessage !== 'valid') {
            alert(validationMessage);
            event.preventDefault();
            //Que la longitud sea a partir de 8
        } else if (newPassword.length < 8) {
            alert('La nueva contraseña debe tener al menos 8 caracteres.');
            event.preventDefault();
            //Que las contraseñas nueva y la repeticion coincidan
        } else if (newPassword !== confirmPassword) {
            alert('Las contraseñas no coinciden.');
            event.preventDefault();
        } else {
            passwordSection.style.display = 'none';
            profileSection.style.display = 'block';
            toggleButton.textContent = 'Cambiar Contraseña';
            // Cambiar la URL al actualizar la contraseña
            updateUrl('profile');
        }
    });

    // Función para validar la contraseña actual
    function isValidCurrentPassword(password) {
        //Minimo una mayuscula
        if (!/[A-Z]/.test(password)) {
            return 'La contraseña actual debe contener al menos una mayúscula.';
        }
        //Minimo un caracter especial
        if (!/[\W_]/.test(password)) {
            return 'La contraseña actual debe contener al menos un carácter especial.';
        }
        //Minimo 8 caracteres
        if (password.length < 8) {
            return 'La contraseña actual debe tener al menos 8 caracteres.';
        }
        return 'valid';
    }
});
