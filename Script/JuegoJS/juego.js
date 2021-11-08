var datosJuego;

function jugarJS(juego) {
    datosJuego = JSON.parse(juego);
    var llaves = document.getElementById("llaves");
    llaves.value = datosJuego.llaves;

    var frase = document.getElementById("frase");
    frase.value = datosJuego.enigma.pregunta;


    var respuestas = datosJuego.enigma.respuestas;
    //Recorremos las respuestas con el forEach:
    respuestas.forEach(function(respuesta) {
        var opciones = document.getElementById("opciones");
        var i = 1;
        opciones.innerHTML += '<div class="row"><div class="col-e-10"><input type="radio" class="col-e-1" name="respuestaElegida" value="' + respuesta.id_opcion + '"><input type="text" class="col-e-9" id="respuesta' + i + '" value="' + respuesta.descripcion + '" required></div></div>';
        i++;
    });


    /*En un eventListener vamos a coger los datos del juego y los vamos a poner en input hidden para volver a mandar 
    los datos a PHP en texto plano y asi poder operar con ellos y guardarlos en la BBDD:*/
    const aceptar = document.getElementById("aceptar");
    aceptar.addEventListener('click', function(event) {
        //Con esta funcion lo convertimos a texto plano cuando pulsemos el botón Responder:
        var textoPlano = JSON.stringify(datosJuego);
        document.getElementById("datosJuego").value = textoPlano;
    });

    var mostrarPanelJugadores = false;
    //En el panelJugadores pintaremos los jugadores de la partida solo al almirante:
    var panelJugadores = document.getElementById("eresAlmirante");
    var jugadorActual = datosJuego.jugadorActual;
    var jugadores = datosJuego.jugadores;
    jugadores.forEach(function(jugador) {
        if (jugadorActual.correo == jugador.correo) {
            if (jugadorActual.almirante == 1) {
                mostrarPanelJugadores = true;
            }
        }
    });

    if (mostrarPanelJugadores) {
        jugadores.forEach(function(jugador) {
            panelJugadores.innerHTML += '<div class="row"><div class="col-e-8"><div class="row"><form action="../../Controlador/controlador_juego.php" method="POST"><input type="text" name="correo" id="" value="' + jugador.correo + '" readonly><input type="submit" value="Responder" name="jugadorResponde" onsubmit="responder(\'' + jugador.correo + '\')"></form></div></div></div>';
        });
    }
    habilitarBotonResponder();

    recargar();
}

function habilitarBotonResponder() {
    var primeraRonda = datosJuego.primeraRonda;
    var jugadorActual = datosJuego.jugadorActual;
    var puedeResponder = jugadorActual.puede_responder;
    /*Si no es la primera ronda, el boton aceptar no se va a ver porque es el almirante el que elige
    un jugador para que responda.*/
    if (primeraRonda != 1) {
        document.getElementById('aceptar').style.visibility = 'hidden';
        if (jugadorActual.almirante == 1) {
            document.getElementById('aceptar').style.visibility = 'visible';
        } else {
            //Si el jugador puede responder
            console.log(puedeResponder);
            if (puedeResponder == 1) {
                document.getElementById('aceptar').style.visibility = 'visible';
            }
        }
    }
}


function responder(correo) {
    var arrayJugadores = datosJuego.jugadores;
    arrayJugadores.forEach(function(jugador) {
        if (correo == jugador.correo) {
            //Busco el correo del jugador en la que he pulsado el boton dentro del array,
            //y cuando la encuentre, entonces ese jugador puede responder:
            jugador.puede_responder = 1;
        }
    });
}

function recargar() {
    var primeraRonda = datosJuego.primeraRonda;
    var llaves = datosJuego.llaves;
    if (primeraRonda == 0) {
        if (llaves >= 5) {
            window.location.replace("../../Controlador/controlador_juego.php?terminada=1");
        } else {
            setTimeout(function() {
                window.location.reload();
            }, 4000);
        }
    }
}