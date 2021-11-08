<?php

    require_once (dirname(__DIR__).'/BBDD/conexion.php');
    require_once (dirname(__DIR__).'/Modelo/Persona.php');
    session_start();
    $conex = new Conexion();

    if(isset($_REQUEST["ranking"])){
        $vectorUsuarios = $conex->seleccionarUsuariosRanking();
        $_SESSION["vectorUsuarios"] = $vectorUsuarios;
        header("Location: ../Vistas/Jugador/ranking.php");
    }


    if(isset($_REQUEST["jugadoresOnline"])){
        $vectorUsuarios = $conex->seleccionarUsuariosEstado();
        $_SESSION["vectorUsuarios"] = $vectorUsuarios;
        header("Location: ../Vistas/Jugador/jugadoresOnline.php");
    }

    if(isset($_REQUEST["editarPerfil"])){
        header("Location: ../Vistas/Jugador/editarJugador.php");
    }

    if(isset($_REQUEST["aceptarCambiosJugador"])){
        $persona = null;
        $correo = $_REQUEST["correo"];
        $nombre = $_REQUEST["nombre"];
        $apellidos = $_REQUEST["apellidos"];
        $foto = $_REQUEST["foto"];
        $contraseña = md5($_REQUEST["contraseña"]);
        $persona = $_SESSION["persona"];
        $persona->setCorreo($correo);
        $persona->setNombre($nombre);
        $persona->setApellidos($apellidos);
        $persona->setFoto($foto);
        $persona->setContraseña($contraseña);
        //$persona = new Persona($correo, $nombre, $apellidos, $contraseña, $foto);
        $conex->updatePersona($persona);
        //Ahora actualizo al objeto Persona para volver a guardarlo en una session:
        $conex->cogerUsuario($persona);
        $_SESSION["persona"] = $persona;        
        //Vuelvo a coger el vectorPersona para meter a la persona que acabamos de editar:
        $vectorUsuarios = $conex->seleccionarUsuarios();
        //Lo metemos en la sesión para llevarlo al crud con la persona editada:
        $_SESSION["vectorUsuarios"] = $vectorUsuarios;
        header("Location: ../Vistas/Jugador/PerfilJugador.php");
    }

    if(isset($_REQUEST["jugar"])){
        $vectorPartida = $conex->recogerPartidas();
        $_SESSION["vectorPartida"] = $vectorPartida;
        header("Location: ../Vistas/Jugador/jugar.php");
    }

    if(isset($_REQUEST["cambiarRol"])){
        $persona = $_SESSION["persona"];
        //En este vector metemos los roles a los que puede acceder este gestor
        $vectorRoles = $conex->seleccionarRoles($persona->getRol());
        //Lo metemos en una sesión para llevarnoslo a elegirRol.php.
        $_SESSION["vectorRoles"] = $vectorRoles;
        header("Location: ../Vistas/elegirRol.php");
    }