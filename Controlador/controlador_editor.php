<?php

    require_once (dirname(__DIR__).'/BBDD/conexion.php');

    session_start();
    $conex = new Conexion();

    if(isset($_REQUEST["añadirEnigma"])){
        $frase = $_REQUEST["frase"];
        $vectorOpciones = $_REQUEST["op"];
        //var_dump($vectorOpciones);
        $opcionCorrecta = $_REQUEST["opCorrecta"];
        //Lo añado a la BBDD:  
        $conex->añadirEnigma($frase, $vectorOpciones, $opcionCorrecta);
        //Metemos los enigmas en una sesión:
        $vectorEnigmas = $conex->seleccionarEnigmas();
        $_SESSION["vectorEnigmas"] = $vectorEnigmas;
        
        header("Location: ../Vistas/Editor/crudEditor.php");
    }

    if(isset($_REQUEST["editarEditor"])){
        //Cojo todos los campos de la ventana crud.php y los meto en una sesion para irme a la ventana editar.php:
        $enigma = $_REQUEST["id_pregunta"];
        $enigma = $conex->cogerEnigma($enigma);
        $_SESSION["enigma"] = $enigma;
        header("Location: ../Vistas/Editor/editarEditor.php");
    }

    if(isset($_REQUEST["aceptarCambios"])){
        $id = $_REQUEST["id_pregunta"];
        $frase = $_REQUEST["frase"];
        $vectorId_opciones = $_REQUEST["id_op"];
        $vectorOpciones = $_REQUEST["op"];
        $opcionCorrecta = $_REQUEST["opCorrecta"];
        $conex->editarEnigma($id, $frase,$vectorId_opciones, $vectorOpciones, $opcionCorrecta);
    }