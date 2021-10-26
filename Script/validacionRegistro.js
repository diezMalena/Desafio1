function validacion(){
    const registrarse=document.getElementById('registrarse');
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

 
    email.addEventListener('onblur', function (event) {
        if (email.validity.valid) {
            emailError.innerHTML = '';
            emailError.className = 'error';
        } else {
            showError();
        }
    });

    nombre.addEventListener('onblur', function (event) {
        if (nombre.validity.valid) {
            nombreError.innerHTML = '';
            nombreError.className = 'error';
        } else {
            showError();
        }
    });

    apellidos.addEventListener('onblur', function (event) {
        if (apellidos.validity.valid) {
            apellidosError.innerHTML = '';
            apellidosError.className = 'error';
        } else {
            showError();
        }
    });

    contraseña.addEventListener('onblur', function (event) {
        if (contraseña.validity.valid) {
            contraseñaError.innerHTML = '';
            contraseñaError.className = 'error';
        } else {
            showError();
        }
    });

    contraseña2.addEventListener('onblur', function (event) {
        if (contraseña2.validity.valid) {
            contraseñaError2.innerHTML = '';
            contraseñaError2.className = 'error';
        } else {
            showError();
        }
    });

    registrarse.addEventListener('click', function (event) {
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
        } else if (email.validity.tooShort) {
            emailError.textContent = 'El correo electrónico debe tener al menos ${ email.minLength } caracteres; ha introducido ${ email.value.length }.';
        }
        emailError.className = 'error active';
    }

    function showErrorNombre(){
        if (nombre.validity.valueMissing) {
            nombreError.textContent = 'Debe introducir un nombre para iniciar sesión.';
        } 
        nombreError.className = 'error active';
    }

    function showErrorApellidos(){
        if (apellidos.validity.valueMissing) {
            apellidosError.textContent = 'Debe introducir minimo un apellido para iniciar sesión.';
        } 
        apellidosError.className = 'error active';
    }

    function showErrorContraseña(){
        if (contraseña.validity.valueMissing) {
            contraseñaError.textContent = 'Debe introducir una  contraseña para iniciar sesión.';
        } 
        contraseñaError.className = 'error active';
    }

    function showErrorContraseña2(){
        if (contraseña2.validity.valueMissing) {
            contraseñaError2.textContent = 'Debe repetir la contraseña.';
        } 
        contraseñaError2.className = 'error active';
    }

}





