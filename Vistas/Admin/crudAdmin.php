<html>

<head>
    <title>Escape Web</title>
    <link rel="stylesheet" href="../../CSS/general.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Vollkorn:ital,wght@1,500&display=swap">
</head>

<body>
    <?php
            require_once '../../BBDD/conexion.php';
            
            session_start();

            if(isset($_SESSION["vectorUsuarios"])){
                $vectorUsuarios = $_SESSION["vectorUsuarios"];
            }
        ?>
    <div class="container">
        <header class="row">
            <div class="col-e-4 col-m-5">
                <img src="../../Img/Generales/barco.png" class="imgResponsive">
            </div>

            <div class="col-e-8 col-m-6 edicionTitulo">
                <h1>ESCAPE WEB</h1>
            </div>
        </header>


        <div class="row sectionAdmin alturaDiv">
            <div class="col-e-12">
                <nav class="row">
                    <div class="col-e-6 col-o-8 col-m-12 col-t-12 offset-e-3 offset-o-2 offset-m-0 offset-t-0">
                        <div class="row">
                            <div class="col-e-4 col-o-4 col-m-12 col-t-12">
                                <div class="row">
                                    <a href="añadirGestores.php" class="col-e-12 button buttonPrimario">Añadir otros
                                        gestores</a>
                                </div>
                            </div>

                            <div class="col-e-4 col-o-4 col-m-12 col-t-12">
                                <div class="row">
                                    <a href="../elegirRol.php" class="col-e-12 button buttonPrimario">Volver</a>
                                </div>
                            </div>

                            <div class="col-e-4 col-o-4 col-m-12 col-t-12">
                                <form action="../../Controlador/registro_IS.php" method="post">
                                    <div class="row">
                                        <input type="submit" value="Cerrar sesion"
                                            class="col-e-12 button buttonPrimario" name="cerrarSesion">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </nav>

                <section class="row">
                    <div class="col-e-12">
                        <?php
                        foreach($vectorUsuarios as $usuario){
                            $cad = '<div class="row padBottom15">
                                        <div class="etiquetaAdmin col-e-4 col-o-8 col-m-12 col-t-12 offset-e-4 offset-o-2 offset-m-0 offset-t-0 padTarjeta">
                                            <form action="../../Controlador/controlador_crud.php" method="POST">
                                                <div class="row padBottom15">
                                                    <div class="col-e-3 col-m-4 col-t-4">
                                                        Correo:
                                                    </div>
                                    
                                                    <div class="col-e-9 col-m-8 col-t-8">
                                                        <div class="row">
                                                            <input type="text" class="col-e-12 col-m-12" name="correo" value="'.$usuario->getCorreo().'" readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row padBottom15">
                                                    <div class="col-e-3 col-m-4 col-t-4">
                                                        Nombre:
                                                    </div>
                                                    <div class="col-e-9 col-m-8 col-t-8">
                                                        <div class="row">
                                                            <input type="text" class="col-e-12 col-m-12" name="nombre" value="'. $usuario->getNombre() .'" readonly>     
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row padBottom15">
                                                    <div class="col-e-3 col-m-4 col-t-4">
                                                        Apellidos:
                                                    </div>
                                                    <div class="col-e-9 col-m-8 col-t-8">
                                                        <div class="row">
                                                            <input type="text" class="col-e-12 col-m-12" name="apellidos" value="'. $usuario->getApellidos().'" readonly>
                                                        </div>        
                                                    </div>
                                                </div>

                                                <div class="row padBottom15">
                                                    <div class="col-e-3 col-m-4 col-t-4">
                                                        Victorias:
                                                    </div>
                                                    <div class="col-e-9 col-m-8 col-t-8">
                                                        <div class="row">
                                                            <input type="text" class="col-e-12 col-m-12" name="victorias" value="'. $usuario->getVictorias().'" readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row padBottom15">
                                                    <div class="col-e-3 col-m-4 col-t-4">
                                                        Estado:
                                                    </div>
                                                    <div class="col-e-9 col-m-8 col-t-8">
                                                        <div class="row">
                                                            <select name="estado" class="col-e-12 col-m-12" disabled>';
                                                            if($usuario->getEstado() == 0){
                                                                $cad .= '<option value="0" selected>Desconectado</option>
                                                                        <option value="1">Conectado</option>';
                                                            }else{
                                                                $cad .= '<option value="0">Desconectado</option>
                                                                        <option value="1" selected>Conectado</option>';
                                                            }    
                                                            $cad .= '</select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row padBottom15">
                                                    <div class="col-e-3 col-m-4 col-t-4">
                                                        Activado:
                                                    </div>
                                                    <div class="col-e-9 col-m-8 col-t-8">
                                                        <div class="row">
                                                            <select name="activado" class="col-e-12 col-m-12" disabled>';
                                                                if($usuario->getActivado() == 0){
                                                                    $cad .= '<option value="0" selected>Desactivado</option>
                                                                            <option value="1">Activado</option>';
                                                                }else{
                                                                    $cad .= '<option value="0">Desactivado</option>
                                                                            <option value="1" selected>Activado</option>';
                                                                }    
                                                    $cad .= '</select>
                                                        </div>        
                                                    </div>
                                                </div>

                                                <div class="row padBottom15">
                                                    <div class="col-e-3 col-m-4 col-t-4">
                                                        Puntuacion:
                                                    </div>
                                                    <div class="col-e-9 col-m-8 col-t-8">
                                                        <div class="row">
                                                            <input type="text" class="col-e-12 col-m-12" name="puntuacion" value="'. $usuario->getPuntuacion().'" readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row padBottom15">
                                                    <div class="col-e-3 col-m-4 col-t-4">
                                                        Rol:
                                                    </div>
                                                    <div class="col-e-9 col-m-8 col-t-8">
                                                        <div class="row">
                                                            <input type="text" class="col-e-12 col-m-12" name="rol" value="'. $usuario->getRol().'" readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-e-2 col-m-5 floatIzq">
                                                        <div class="row">
                                                            <input type="submit" class="col-e-12 col-m-12 buttonMini buttonPrimario" name="borrar" value="Borrar">
                                                        </div>     
                                                    </div>

                                                    <div class="col-e-2 col-m-5 floatDer">
                                                        <div class="row">
                                                            <input type="submit" class="col-e-12 col-m-12 buttonMini buttonPrimario" name="editarAdmin" value="Editar">
                                                        </div>    
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>'
                                    ;
                            echo $cad;
                        }
                    ?>

                    </div>
                </section>
            </div>
        </div>


        <footer class="row">
            <p class=" col-e-4 col-m-8 col-t-12 izquierda">Creado por Malena Diez</p>
            <p class=" col-e-8 col-m-4 col-t-12 derecha">@Copyright</p>
        </footer>
    </div>
</body>

</html>