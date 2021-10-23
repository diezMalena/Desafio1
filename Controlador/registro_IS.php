<?php
    require_once (dirname(__DIR__).'/BBDD/conexion.php');
    require_once (dirname(__DIR__).'/Modelo/Persona.php');

    session_start();
    $conex = new Conexion();

    //Cuando pulsamos el botón de INICIAR SESIÓN:
    if(isset($_REQUEST["iniciarSesion"])){
        $correo = $_REQUEST["correo"];
        $contraseña = $_REQUEST["contraseña"];

        $persona = $conex->iniciarSesion($correo, $contraseña);
        

        //Si la persona está logueada...
        if(isset($persona)){
            $_SESSION["persona"] = $persona;
        
            //Si es jugador...
            if($persona->getRol() == 0){
                header("Location: juego.php");
            }//Si es administrador...
            else{
                $vectorRoles = $conex->seleccionarRoles($persona->getRol());
                //Lo metemos en una sesión para llevarnoslo a elegirRol.php.
                $_SESSION["vectorRoles"] = $vectorRoles;
                header("Location: ../Vistas/elegirRol.php");
            }

        //Si la persona no existe...    
        }else{
            //Mostramos un mensaje al recargar la pagina que nos diga que el usuario o la contraseña son incorrectas:
            $mensajeError = 'El usuario y/o la contraseña son incorrectos, inténtelo de nuevo.';
            $_SESSION["mensajeError"] = $mensajeError;
            header("Location: ../index.php");
        }
    }




    //Si el usuario se quiere registrar...
    if(isset($_REQUEST["registrar"])){
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
                $conseguido = $conex->insertarPersona($persona);
                if(!$conseguido){
                    $mensajeError = 'La persona que intentas registrar ya está registrada.';
                    $_SESSION["mensajeError"] = $mensajeError; 
                    header("location: ../Vistas/registro.php");
                }else{
                    //Me mando a index.php para poder iniciar sesión:
                    header("location: ../index.php");
                }
            }
    
        }else{
            //Si las contraseñas no coinciden, recargo la página mostrando un mensaje diciendolo.
            //Tengo que mostrar el mensaje en la página de registro, con lo cual allí hago un isset y la muestro.
            $mensajeError = 'Las contraseñas no coinciden. Registro fallido.';
            $_SESSION["mensajeError"] = $mensajeError; 
            header("location: registro.php");
        }
    }

    if(isset($_REQUEST["aceptarRol"])){
        $rolSeleccionado = $_REQUEST["rol"];

        if($rolSeleccionado == 0){
            header("Location: ../Vistas/Jugador/juego.php");
        }

        if($rolSeleccionado == 1){
            $vectorEnigmas = $conex->seleccionarEnigmas();
            $_SESSION["vectorEnigmas"] = $vectorEnigmas;
            header("Location: ../Vistas/Editor/crudEditor.php");
        }

        if($rolSeleccionado == 2){
            $vectorUsuarios = $conex->seleccionarUsuarios();
            $_SESSION["vectorUsuarios"] = $vectorUsuarios;
            header("Location: ../Vistas/Admin/crudAdmin.php");
        }
    }
?>