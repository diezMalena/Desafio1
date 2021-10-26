<?php
    require_once (dirname(__DIR__).'/BBDD/conexion.php');
    require_once (dirname(__DIR__).'/Modelo/Persona.php');
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

    require_once 'phpmailer/src/Exception.php';
    require_once 'phpmailer/src/PHPMailer.php';
    require_once 'phpmailer/src/SMTP.php';

    session_start();
    $conex = new Conexion();

    //Cuando pulsamos el botón de INICIAR SESIÓN:
    if(isset($_REQUEST["iniciarSesion"])){
        $correo = $_REQUEST["correo"];
        $contraseña = $_REQUEST["contraseña"];

        $persona = $conex->iniciarSesion($correo, $contraseña);
        

        //Si la persona está logueada...
        if(isset($persona)){
            if($persona->getActivado() == 1){
                $_SESSION["persona"] = $persona;
                //Si es jugador...
                if($persona->getRol() == 0){
                    header("Location: juego.php");
                }//Si es administrador o editor...
                else{
                    //En este vector metemos los roles a los que puede acceder este gestor
                    $vectorRoles = $conex->seleccionarRoles($persona->getRol());
                    //Lo metemos en una sesión para llevarnoslo a elegirRol.php.
                    $_SESSION["vectorRoles"] = $vectorRoles;
                    header("Location: ../Vistas/elegirRol.php");
                }
            }else{
                $mensajeError = 'El usuario no está verificado.';
                $_SESSION["mensajeError"] = $mensajeError;
                header("Location: ../index.php");
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
        //Vamos a coger todos los emails de la BBDD:
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
                    //Cojo el correo con el que nos registramos:
                    $correoDestino = $_REQUEST["correo"];
                    //verificarCorreo es como pulsar un boton submit del formulario, y le pasamos el correo para verificar a ese usuario y poner en la BBDD un 1.
                    $enlace = "http://localhost/dashboard/ServidorLocalhost/DESAFIO1/Repositorio/Desafio1/Vistas/registro_IS.php?verificarCorreo='".$correoDestino."'";
            
                    $mail = new PHPMailer();
                    try {
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';  
                        $mail->SMTPAuth = true;
                        $mail->Username = 'auxiliardaw2@gmail.com';                 
                        $mail->Password = 'Chubaca20';                           
                        $mail->SMTPSecure = 'tls';                                  
                        $mail->Port = 587;                                    
                        

                        $mail->setFrom('AuxiliarDAW2@gmail.com'); 
                        $mail->addAddress($correoDestino);     

                        $mail->isHTML(true);
                        $mail->Subject = 'Verificación de cuenta.'; 
                        $mail->Body = 'Accede a este enlace para poder verificar tu cuenta: <a href="'.$enlace.'">Verificar cuenta</a>';    

                        $mail->send();
                    } catch (Exception $e) {
                    }
                    //Si se ha registrado correctamente, lo mando a index.php para poder iniciar sesión:
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

    if(isset($_REQUEST["verificarCorreo"])){
        $correo = $_REQUEST["verificarCorreo"];
        $conex->verificarCorreo($correo);
        header("location: ../index.php");
    }


    if(isset($_REQUEST["aceptarRol"])){
        $rolSeleccionado = $_REQUEST["rol"];

        if($rolSeleccionado == 0){ //Usuario estandar
            header("Location: ../Vistas/Jugador/juego.php");
        }

        if($rolSeleccionado == 1){ //Editor
            $vectorEnigmas = $conex->seleccionarEnigmas();
            $_SESSION["vectorEnigmas"] = $vectorEnigmas;
            header("Location: ../Vistas/Editor/crudEditor.php");
        }

        if($rolSeleccionado == 2){ //Admin
            $vectorUsuarios = $conex->seleccionarUsuarios();
            $_SESSION["vectorUsuarios"] = $vectorUsuarios;
            header("Location: ../Vistas/Admin/crudAdmin.php");
        }
    }

    if(isset($_REQUEST["cerrarSesion"])){
        //Vamos a borrar la sesion de la persona que inició sesion:
        unset($_SESSION["persona"]);
        header("Location: ../index.php");
    }

    if(isset($_REQUEST["olvideContraseña"])){
        $correoDestino = $_REQUEST["correo"];
        //Si existe el correo en la BBDD es porque esta registrado y podra restaurar su contraseña:
        if($correoDestino == $conex->cogerCorreo($correoDestino)){
            $enlace = "http://localhost/dashboard/ServidorLocalhost/DESAFIO1/Repositorio/Desafio1/Vistas/restaurarContraseña.php?correo='".$correoDestino."'";
            
            $mail = new PHPMailer();
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';  
                $mail->SMTPAuth = true;
                $mail->Username = 'auxiliardaw2@gmail.com';                 
                $mail->Password = 'Chubaca20';                           
                $mail->SMTPSecure = 'tls';                                  
                $mail->Port = 587;                                    
                

                $mail->setFrom('AuxiliarDAW2@gmail.com'); 
                $mail->addAddress($correoDestino);     

                $mail->isHTML(true);
                $mail->Subject = 'Restauracion de password.'; 
                $mail->Body = 'Accede a este enlace para poder cambiar tu contraseña: <a href="'.$enlace.'">Cambiar contraseña</a>';    

                $mail->send();
                //echo 'Mensaje enviado';
                $mensajeLlegada = 'El email ha sido enviado.';
                $_SESSION["mensajeLlegada"] = $mensajeLlegada;
                header("Location: ../Vistas/olvideContraseña.php");
            } catch (Exception $e) {
            }
        }else{
            $mensajeError = 'El email introducido no es correcto.';
            $_SESSION["mensajeError"] = $mensajeError; 
            header("location: ../Vistas/restaurarContraseña.php");
        }
    }

    if(isset($_REQUEST["cambiarContraseña"])){
        $correo = $_REQUEST["correo"];
        $contraseña = $_REQUEST["contraseña"];
        $contraseña2 = $_REQUEST["contraseña2"];
        if($contraseña == $contraseña2){
            $conex->updateContraseña($correo, $contraseña);
            $mensajeRecibido = 'La contraseña ha sido actualizada.';
            $_SESSION["mensajeRecibido"] = $mensajeRecibido; 
            header("Location: ../index.php");
        }else{
            $mensajeError = 'Las contraseñas no coinciden, vuelve a intentarlo.';
            $_SESSION["mensajeError"] = $mensajeError; 
            header("location: ../Vistas/restaurarContraseña.php");
        }
    }

    
?>