<?php

    require_once (dirname(__DIR__).'/BBDD/conexion.php');
    require_once (dirname(__DIR__).'/Modelo/Persona.php');
    session_start();
    $conex = new Conexion();

    if(isset($_REQUEST["unirme"])){
        $id_partida = $_REQUEST["id_partida"];
        //Meto el id_partida en una sesion para llevarmelo a la sala de espera:
        $_SESSION["id_partida"] = $id_partida;

        $persona = $_SESSION["persona"];
        $correo = $persona->getCorreo();
        //Primero comprobamos que no haya mas de 5 jugadores en la partida:
        $cuantosJugadores = $conex->cuantosJugadores($id_partida);
        //Si entra aqui, me lleva a una sala de espera para completar el equipo y jugar:
        if($cuantosJugadores < 5){
            $conex->addJugadorPartida($id_partida, $correo);
            $cuantosJugadores = $conex->cuantosJugadores($id_partida);
            //Metemos cuantosJugadores en una sesion para llevarnoslo a la sala de espera.
            $_SESSION["cuantosJugadores"] = $cuantosJugadores;
            header("Location: ../Vistas/Jugador/salaEspera.php");
        }else{
            //Me lleva de nuevo a la pagina jugar mostrandome el mensaje y tambien las partidas que hay disponibles:
            $mensajeError = "No puedes unirte a esta partida porque ya hay 5 jugadores.";
            $_SESSION["mensajeError"] = $mensajeError;
            //Metemos cuantosJugadores en una sesion para llevarnoslo a la sala de espera.
            $_SESSION["cuantosJugadores"] = $cuantosJugadores;
            $vectorPartida = $conex->recogerPartidas();
            $_SESSION["vectorPartida"] = $vectorPartida;
            header("Location: ../Vistas/Jugador/jugar.php");
        }
       
    }
    
    if(isset($_REQUEST["salir"])){
        //El jugador tiene que quitarse de la partida, con lo cual tambien de la BBDD:
        $persona = $_SESSION["persona"];
        $id_partida = $_SESSION["id_partida"];
        $conex->salirPartida($persona->getCorreo(), $id_partida);
        //Vuelvo a recoger las partidas para actualizarlas:
        $vectorPartida = $conex->recogerPartidas();
        $_SESSION["vectorPartida"] = $vectorPartida;
        header("Location: ../Vistas/Jugador/jugar.php");
    }

    if(isset($_REQUEST["comienzaJuego"])){
        $persona = $_SESSION["persona"];
        //A partir de aqui vamos a mandar a la pantalla desarrolloJuego lo necesario:
        $id_partida = $_SESSION["id_partida"];
        $arrayJugadores = $conex->cogerJugadoresPartida($id_partida);
        $_SESSION["arrayJugadores"] = $arrayJugadores;
        //Recorrer el arrayJugadores y lo comparo con el correo de la persona en sesion para coger al almirante: 
        foreach($arrayJugadores as $jugador){
            if($persona->getCorreo() == $jugador["correo"]){
                $_SESSION["jugadorActual"] = $jugador;
            }
        }
        $enigma = $conex->seleccionarEnigmaAlea();
        $_SESSION["enigma"] = $enigma;
        //Las llaves nos las llevamos a 0 porque acaba de empezar el juego.
        $_SESSION["llaves"] = $conex->cuantasLlaves($id_partida);

        /*En la primera ronda van a poder responder todos, pero solo 1 conseguirá ser almirante.
        primeraRonda = 1 (SI es la primera ronda).
        */
        $_SESSION["primeraRonda"] = 1;
        header("Location: ../Vistas/Jugador/desarrolloJuego.php");
    }

    if(isset($_REQUEST["crearPartida"])){
        $privada = 0;
        //Primero la ponemos a 0 para que no salga a null, y despues comprobamos si el check ha sido marcado:
        if(isset($_REQUEST["privada"])){
            $privada = 1;
        }
        $persona = $_SESSION["persona"];
        $id_partida = $_REQUEST["id_partida"];
        $existePartida = $conex->existePartida($id_partida);
        if(!$existePartida){
            //Si no hay una partida con ese id, la creo
            $conex->crearPartida($id_partida,$privada);
            //Ahora metemos al usuario que crea la partida en la partida:
            $conex->addJugadorPartida($id_partida, $persona->getCorreo());
            $cuantosJugadores = $conex->cuantosJugadores($id_partida);
            //Metemos cuantosJugadores en una sesion para llevarnoslo a la sala de espera.
            $_SESSION["cuantosJugadores"] = $cuantosJugadores;
            $_SESSION["id_partida"] = $id_partida;
            header("Location: ../Vistas/Jugador/salaEspera.php");
        }else{
            //Si ya existe una partida con ese id, se muestra un mensaje avisando de ello.
        }
    }

    if(isset($_REQUEST["aceptar"])){
        $respuestaElegida = $_REQUEST["respuestaElegida"];
        $persona = $_SESSION["persona"];
        $id_partida = intval($_SESSION["id_partida"]);
        //Recogemos los datos del juego del campo HIDDEN
        $datosJuego = $_REQUEST["datosJuego"];
        //Pasamos el texto plano a json, ya es un objeto de php:
        $datosJuego = json_decode($datosJuego, true);
        $vectorRespuestas = $datosJuego["enigma"]["respuestas"];
        $acertada = false;
        foreach($vectorRespuestas as $respuesta){
            if($respuestaElegida == $respuesta["id_opcion"]){
                if($respuesta["opcion_correcta"] == 1){
                    $acertada = true;
                }
            }
        }

        //Si se ha acertado...
        $llave = $datosJuego["llaves"];
        $hayAlmirante = $conex->hayAlmirantes($id_partida);
        if($acertada){
            //Aqui modificamos las llaves:
            $llave++;
            $conex->sumarLlave($id_partida,$llave);
            $persona->setPuntuacion($persona->getPuntuacion() + 1);
            $conex->sumarPunto($persona->getCorreo(), $persona->getPuntuacion());
            //Tenemos que ver que jugador ha acertado y ponerlo almirante:
            if(!$hayAlmirante){
                //Si no hay almirante, se hace almirante ese jugador:
                $conex->hacerAlmirante($persona->getCorreo());
            }
        }else{
            //Aqui modificamos los errores:
            $fallosJugador = $conex->cuantosFallosPersona($persona->getCorreo(), $id_partida);
            $fallosJugador++;
            $conex->sumarFallo($persona->getCorreo(), $id_partida, $fallosJugador);
        }



        //Ahora vamos a actualizar en la BBDD qué jugador puede responder:
        /*$arrayJugadores = $datosJuego["jugadores"];
        foreach($arrayJugadores as $jugador){
            $correo = $jugador["correo"];
            $puedeResponder = $jugador["puede_responder"];
            $conex->cambiarPuedeResponder($correo, $puedeResponder,$id_partida);
        }*/


        //Si está establecido el Almirante...
        if($hayAlmirante){
            $jugador = $_SESSION["jugadorActual"];
            /*Si un jugador que no es almirante, responde correctamente una pregunta,
            este jugador no podrá responder la siguiente pregunta,
            salvo que el mismo almirante lo permita*/
            if($acertada && $jugador["almirante"] == 0){
                $correo = $jugador["correo"];
                $puedeResponder = 0;
                $conex->cambiarPuedeResponder($correo, $puedeResponder, $id_partida);
            }
        }
        


        //Vamos a traer de nuevo los datos(una pregunta nueva, y los jugadores ya actualizados):
        $arrayJugadores = $conex->cogerJugadoresPartida($id_partida);


        //Recorrer el arrayJugadores y lo comparo con el correo de la persona en sesion: 
        foreach($arrayJugadores as $jugador){
            if($persona->getCorreo() == $jugador["correo"]){
                $_SESSION["jugadorActual"] = $jugador;
            }
        }

        $jugador = $_SESSION["jugadorActual"];

        if($jugador["almirante"] == 1){
            $enigma = $conex->seleccionarEnigmaAlea();
            //Borramos la anterior pregunta para que solo haya una:
            $conex->borrarPregunta($id_partida);
            //Insertamos la nueva pregunta en la tabla Aux:
            $conex->insertarPreguntaAux($id_partida, $enigma["id_pregunta"]);
        }else{
            //Si se ha acertado la pregunta:
            if($acertada){
                $enigma = $conex->seleccionarEnigmaAlea();
                //Borramos la anterior pregunta para que solo haya una:
                $conex->borrarPregunta($id_partida);
                //Insertamos la nueva pregunta en la tabla Aux:
                $conex->insertarPreguntaAux($id_partida, $enigma["id_pregunta"]);
            }else{
                //Si no puedes responder, entonces se cogerá la pregunta de la tabla aux para que a todos se les muestre la misma: 
                $enigma = $conex->cogerPreguntaAux($id_partida);
            }


            
        }
        $_SESSION["llaves"] = $conex->cuantasLlaves($id_partida);
        $_SESSION["enigma"] = $enigma;
        $_SESSION["arrayJugadores"] = $arrayJugadores;

        //primeraRonda = 0, ya NO es la primera ronda.
        $_SESSION["primeraRonda"] = 0;
        
        header("Location: ../Vistas/Jugador/desarrolloJuego.php");
    }

    if(isset($_REQUEST["jugadorResponde"])){
        $correo = $_REQUEST["correo"];
        $puedeResponder = 1;
        $id_partida = $_SESSION["id_partida"];
        $conex->cambiarPuedeResponder($correo, $puedeResponder,$id_partida);
        $enigma = $conex->cogerPreguntaAux($id_partida);

        //Vamos a traer de nuevo los datos(una pregunta nueva, y los jugadores ya actualizados):
        $arrayJugadores = $conex->cogerJugadoresPartida($id_partida);
        $_SESSION["llaves"] = $conex->cuantasLlaves($id_partida);
        $_SESSION["enigma"] = $enigma;
        $_SESSION["arrayJugadores"] = $arrayJugadores;
        header("Location: ../Vistas/Jugador/desarrolloJuego.php");
    }

    if(isset($_REQUEST["terminada"])){
        $id_partida = $_SESSION["id_partida"];
        $conex->actualizarFechaFinPartida($id_partida);

        //vamos a recoger los datos necesarios para ponerlos en un historial: 
        $llaves = $_SESSION["llaves"];
        $horaInicio = $conex->seleccionarFechaInicio($id_partida);
        $horaFin = $conex->seleccionarFechaFin($id_partida);
        $arrayJugadores = $_SESSION["arrayJugadores"];
        $cadJugadores = "";
        foreach($arrayJugadores as $jugador){
            $cadJugadores .= $jugador["correo"] .', ';
        }
        $conex->crearHistorial($id_partida,$llaves,$horaInicio,$horaFin,$cadJugadores);
        header("Location: ../Vistas/Jugador/finJuego.php");
    }

    if(isset($_REQUEST["verHistorial"])){
        $id_partida = $_SESSION["id_partida"];
        $historial = $conex->cogerHistorial($id_partida);
        $_SESSION["historial"] = $historial;
        header("Location: ../Vistas/Jugador/verHistorial.php");
    }