<?php
    require_once 'Persona.php';
    require_once 'Bitacora.php';

    session_start();
    $conex = new Conexion();
    $conex->conectarBBDD();

    
    //Cuando queremos registrar un nuevo usuario:
    if(isset($_REQUEST["registrar"])){

    }
    
    
    //Cuando pulsamos el botón de INICIAR SESIÓN:
    if(isset($_REQUEST["iniciarSesion"])){
        $correo = $_REQUEST["usuario"];
        $contraseña = $_REQUEST["contraseña"];

        $persona = $conex->iniciarSesion($correo, $contraseña);
        $_SESSION["persona"] = $persona;
        
    }
?>