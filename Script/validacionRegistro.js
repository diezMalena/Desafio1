function validacion() {
    const registrarse = document.getElementById('registrarse');
    const email = document.getElementById('mail');
    const nombre = document.getElementById('nombre');
    const apellidos = document.getElementById('apellidos');
    const contraseña = document.getElementById('contraseña');
    const contraseña2 = document.getElementById('contraseña2');
    const emailError = document.querySelector('#mail + span.error');
    const nombreError = document.getElementById('nombreError');
    const apellidosError = document.getElementById('apellidosError');
    const contraseñaError = document.getElementById('contraseñaError');
    const contraseñaError2 = document.getElementById('contraseñaError2');


    email.addEventListener('blur', function(event) {
        if (email.validity.valid) {
            emailError.innerHTML = '';
            emailError.classList.remove('active');
        } else {
            emailError.classList.add('active');
            showErrorEmail();
        }
    });

    nombre.addEventListener('blur', function(event) {
        if (nombre.validity.valid) {
            nombreError.innerHTML = '';
            nombreError.classList.remove('active');
        } else {
            nombreError.classList.add('active');
            showErrorNombre();
        }
    });

    apellidos.addEventListener('blur', function(event) {
        if (apellidos.validity.valid) {
            apellidosError.innerHTML = '';
            apellidosError.classList.remove('active');
        } else {
            apellidosError.classList.add('active');
            showErrorApellidos();
        }
    });

    contraseña.addEventListener('blur', function(event) {
        if (contraseña.validity.valid) {
            contraseñaError.innerHTML = '';
            contraseñaError.classList.remove('active');
        } else {
            contraseñaError.classList.add('active');
            showErrorContraseña();
        }
    });

    contraseña2.addEventListener('blur', function(event) {
        if (contraseña2.validity.valid) {
            contraseñaError2.innerHTML = '';
            contraseñaError2.classList.remove('active');
        } else {
            contraseñaError2.classList.add('active');
            showErrorContraseña2();
        }
    });

    registrarse.addEventListener('click', function(event) {
        if (!email.validity.valid) {
            showErrorEmail();
            event.preventDefault();
        }

        if (!nombre.validity.valid) {
            showErrorNombre();
            event.preventDefault();
        }

        if (!apellidos.validity.valid) {
            showErrorApellidos();
            event.preventDefault();
        }

        if (!contraseña.validity.valid) {
            showErrorContraseña();
            event.preventDefault();
        }

        if (!contraseña2.validity.valid) {
            showErrorContraseña2();
            event.preventDefault();
        }
    });

    function showErrorEmail() {
        if (email.validity.valueMissing) {
            emailError.textContent = 'Debe introducir una dirección de correo electrónico.';
        } else if (email.validity.typeMismatch) {
            emailError.textContent = 'El valor introducido debe ser una dirección de correo electrónico.';
        }
    }

    function showErrorNombre() {
        if (nombre.validity.valueMissing) {
            nombreError.textContent = 'Debe introducir un nombre para iniciar sesión.';
        }
    }

    function showErrorApellidos() {
        if (apellidos.validity.valueMissing) {
            apellidosError.textContent = 'Debe introducir minimo un apellido para iniciar sesión.';
        }
    }

    function showErrorContraseña() {
        if (contraseña.validity.valueMissing) {
            contraseñaError.textContent = 'Debe introducir una  contraseña para iniciar sesión.';
        } else if (contraseña.validity.tooShort) {
            contraseñaError.textContent = 'La contraseña debe tener al menos 5 caracteres.';
        }
    }

    function showErrorContraseña2() {
        if (contraseña2.validity.valueMissing) {
            contraseñaError2.textContent = 'Debe repetir la contraseña.';
        } else if (contraseña2.validity.tooShort) {
            contraseñaError2.textContent = 'La contraseña debe tener al menos 5 caracteres.';
        }
    }

}