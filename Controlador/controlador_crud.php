<?php

    require_once (dirname(__DIR__).'/BBDD/conexion.php');

    session_start();
    $conex = new Conexion();
    $conex->conectarBBDD();

    if(isset($_REQUEST["borrar"])){
        
    }