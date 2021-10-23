<?php

    require_once (dirname(__DIR__).'/BBDD/conexion.php');

    session_start();
    $conex = new Conexion();

    if(isset($_REQUEST["borrar"])){
        $correo = $_REQUEST["correo"];
        $conex->deleteUsuario($correo);
        //Vuelvo a coger el vectorPersona porque ya no tiene el que acabamos de borrar
        $vectorUsuarios = $conex->seleccionarUsuarios();
        //Lo metemos en la sesión para llevarlo al crud sin la persona que hemos borrado:
        $_SESSION["vectorUsuarios"] = $vectorUsuarios;
        header("Location: ../Vistas/Admin/crudAdmin.php");
    }

    if(isset($_REQUEST["editarAdmin"])){
        //Cojo todos los campos de la ventana crud.php y los meto en una sesion para irme a la ventana editar.php:
        $correo = $_REQUEST["correo"];
        $usuario = $conex->cogerUsuario($correo);
        $_SESSION["usuario"] = $usuario;
        header("Location: ../Vistas/Admin/editarAdmin.php");
    }

    if(isset($_REQUEST["aceptarCambios"])){
        $persona = null;
        $correo = $_REQUEST["correo"];
        $nombre = $_REQUEST["nombre"];
        $apellidos = $_REQUEST["apellidos"];
        $foto = $_REQUEST["foto"];
        $victorias = $_REQUEST["victorias"];
        $estado = $_REQUEST["estado"];
        $activado = $_REQUEST["activado"];
        $puntuacion = $_REQUEST["puntuacion"];
        $rol = $_REQUEST["rol"];
        $persona = new Persona($correo, $nombre, $apellidos, null, $foto, $victorias, $estado, $activado, $puntuacion, $rol);
        $conex->updatePersonaSinContra($persona);
        //Vuelvo a coger el vectorPersona para meter a la persona que acabamos de editar:
        $vectorUsuarios = $conex->seleccionarUsuarios();
        //Lo metemos en la sesión para llevarlo al crud con la persona editada:
        $_SESSION["vectorUsuarios"] = $vectorUsuarios;
        header("Location: ../Vistas/Admin/crudAdmin.php");
    } 


    if(isset($_REQUEST["añadirGestor"])){
        $vectorCorreos = $conex->seleccionarCorreos();
        $persona = new Persona($_REQUEST["correo"], $_REQUEST["nombre"], $_REQUEST["apellidos"], $_REQUEST["foto"], $_REQUEST["contraseña"]);
    
        //Vamos a comprobar si las dos contraseñas son iguales:
        if($_REQUEST["contraseña"] == $_REQUEST["contraseña2"]){
            $encontrado = false;
            for($i = 0; $i < count($vectorCorreos); $i++){
                //Si encontramos a una persona con un email ya registrado:
                if($vectorCorreos[$i] == $persona->getCorreo()){
                    $encontrado = true;
                }
            }

             //Cuando no hay personas registradas con ese correo, la añadimos a la bbdd:
            if(!$encontrado){
                //Recojo el rol elegido en la pagina añadirGestores.php:
                $rol = $_REQUEST["rol"];
                $conseguido = $conex->insertarGestor($rol,$persona);
                if(!$conseguido){
                    $mensajeError = 'La persona que intentas registrar ya está registrada.';
                    $_SESSION["mensajeError"] = $mensajeError; 
                    header("location: ../Vistas/Admin/añadirGestores.php");
                }else{
                    //Recargo la lista de los usuarios porque ahora tendremos otro editor o administrador:
                    $vectorUsuarios = $conex->seleccionarUsuarios();
                $_SESSION["vectorUsuarios"] = $vectorUsuarios;
                    header("location: ../Vistas/Admin/crudAdmin.php");
                }
            }
    
        }else{
            //Si las contraseñas no coinciden, recargo la página mostrando un mensaje diciendolo.
            //Tengo que mostrar el mensaje en la página de registro, con lo cual allí hago un isset y la muestro.
            $mensajeError = 'Las contraseñas no coinciden. Registro fallido.';
            $_SESSION["mensajeError"] = $mensajeError; 
            header("location: ../Vistas/Admin/añadirGestores.php");
        }
    }