function validarEmail(){
    //Primero recogemos el formulario:
    const form = document.getElementsByTagName('form')[0];
    //Ahora recogemos el email introducido por el usuario:
    const email = document.getElementById('mail');
    //Por ultimo, recogemos el campo en el que vamos a mostrar el error:
    const mensajeError = document.querySelector('#mail span.error');


    //Vamos a comprobar que lo que escribe el usuario es válido:
    email.addEventListener('input', function(event){

        if(email.validity.valid){
            /*Si lo último ha sido un mensaje de error y el email esta vez
            ha sido válido, quitamos el error su estilo css: */
            mensajeError.innerHTML = '';
            //mensajeError.className = 'error';
        }else{
            //Si el email que ha escrito sigue siendo invalido:
            mostrarError();
        }
    });


    //Si el correo es válido, lo vamos a enviar:
    form.addEventListener('submit', function(event){
        //Si el email no es válido, mostramos su correspondiente error:
        if(!email.visibility.valid){
            mostrarError();
            event.preventDefault(); //No enviamos el formulario.
        }
    });

    function mostrarError(){
        //Si el campo email está vacío:
        if(email.validity.valueMissing){
            mensajeError.textContent = "Debe introducir un correo electronico.";
        
        //Si el campo email no tiene estructura email:
        }else if(email.validity.typeMismatch){
            mensajeError.textContent = "Debe ser un correo electronico.";
        
        //Si el campo email es demasiado corto:
        }else if (email.validity.tooShort){
            mensajeError.textContent = "El correo electronico debe ser mas extenso.";
        }

        //mensajeError.className = "error active";
    }
}