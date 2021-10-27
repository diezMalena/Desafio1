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
