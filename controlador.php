<?php
    require_once 'Persona.php';
    require_once 'Bitacora.php';

    session_start();
    $conex = new Conexion();
    $conex->conectarBBDD();

    
    //Cuando pulsamos el botón de INICIAR SESIÓN:
    if(isset($_REQUEST["iniciarSesion"])){
        $correo = $_REQUEST["usuario"];
        $contraseña = $_REQUEST["contraseña"];

        $persona = $conex->iniciarSesion($correo, $contraseña);
        

        //Si la persona está logueada...
        if(isset($persona)){
            $_SESSION["persona"] = $persona;
        
            //Si es jugador...
            if($persona->getRol() == 0){
                header("Location: juego.php");
            }

            //Si es editor...
            if($persona->getRol() == 1){
                header("Location: editor.php");
            }

            //Si es administrador...
            if($persona->getRol() == 2){
                header("Location: admin.php");
            }

        //Si la persona no existe...    
        }else{
            //Mostramos un mensaje al recargar la pagina que nos diga que el usuario o la contraseña son incorrectas:
            $mensajeError = 'El usuario y/o la contraseña son incorrectos, inténtelo de nuevo.';
            $_SESSION["mensajeError"] = $mensajeError;
            header("Location: index.php");
        }
    }




    //Si el usuario se quiere registrar...
    if(isset($_REQUEST["registrar"])){

    }
?>