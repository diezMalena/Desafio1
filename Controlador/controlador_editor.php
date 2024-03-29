<?php

    require_once (dirname(__DIR__).'/BBDD/conexion.php');

    session_start();
    $conex = new Conexion();

    if(isset($_REQUEST["añadirEnigma"])){
        
        $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify'; 
        $recaptcha_secret = '6Lc2AAodAAAAALMOAuh9yvcqfLj1Ez1vNGM87LIX'; 
        $recaptcha_response = $_REQUEST['recaptcha_response']; 
        $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response); 
        $recaptcha = json_decode($recaptcha);

        if($recaptcha->score >= 0.7){
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
        }else{
            // KO. ERES ROBOT, EJECUTA ESTE CÓDIGO
            $mensajeCaptcha = 'Este enigma es un robot.';
            $_SESSION["mensajeCaptcha"] = $mensajeCaptcha;
            header("Location: ../Vistas/Editor/añadirEnigmas.php");
        }
    }

    if(isset($_REQUEST["editarEditor"])){
        //Cojo todos los campos de la ventana crud.php y los meto en una sesion para irme a la ventana editar.php:
        $id_pregunta = $_REQUEST["id_pregunta"];
        $enigma = $conex->cogerEnigma($id_pregunta);
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
        //Vuelvo a seleccionar los enigmas porque ahora estan actualizados:
        $vectorEnigmas = $conex->seleccionarEnigmas();
        $_SESSION["vectorEnigmas"] = $vectorEnigmas;
        header("Location: ../Vistas/Editor/crudEditor.php");
    }

    if(isset($_REQUEST["borrarEnigma"])){
        $id_pregunta = $_REQUEST["id_pregunta"];
        $conex->deleteEnigma($id_pregunta);
        //Vuelvo a seleccionar los enigmas porque ahora estan actualizados:
        $vectorEnigmas = $conex->seleccionarEnigmas();
        $_SESSION["vectorEnigmas"] = $vectorEnigmas;
        header("Location: ../Vistas/Editor/crudEditor.php");
    }