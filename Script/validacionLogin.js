function validacion() {
    const iniciarS = document.getElementById('iniciarSesion');

    const email = document.getElementById('mail');
    const passw = document.getElementById('password');

    const emailError = document.querySelector('#mail + span.error');
    const passError = document.getElementById('passE');

    email.addEventListener('blur', function(event) {
        if (email.validity.valid) {
            emailError.innerHTML = '';
            emailError.classList.remove('active');
        } else {
            emailError.classList.add('active');
            showError();
        }
    });

    passw.addEventListener('blur', function(event) {
        if (passw.validity.valid) {
            passError.innerHTML = '';
            passError.classList.remove('active');
        } else {
            passError.classList.add('active');
            showErrorPass();
        }
    });

    iniciarS.addEventListener('click', function(event) {
        if (!email.validity.valid) {
            showError();
            event.preventDefault();
        }


        if (!passw.validity.valid) {
            showErrorPass();
            event.preventDefault();
        }
    });

    function showError() {
        if (email.validity.valueMissing) {
            emailError.textContent = 'Debe introducir una dirección de correo electrónico.';
        } else if (email.validity.typeMismatch) {
            emailError.textContent = 'El valor introducido debe ser una dirección de correo electrónico.';
        }
    }


    function showErrorPass() {
        if (passw.validity.valueMissing) {
            passError.textContent = 'Debe introducir una  contraseña para iniciar sesión.';
        } else if (passw.validity.tooShort) {
            passError.textContent = 'La contraseña debe tener al menos 5 caracteres.';
        }
    }
}