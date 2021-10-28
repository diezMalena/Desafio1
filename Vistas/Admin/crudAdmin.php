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

                <div class="col-e-6 col-m-8 offset-e-1 edicionTitulo">
                    <h1>ESCAPE WEB</h1>
                </div>
            </header>
            

            <section class="row sectionAdmin">
                <div class="row offset-e-3 padTop">
                    <div class="col-e-4 col-m-12 col-t-12">
                        <button><a href="añadirGestores.php">Añadir otros gestores</a></button>
                    </div>

                    <div class="col-e-4 col-m-12 col-t-12">
                        <button type="button"><a href="../elegirRol.php">Volver</a></button>
                    </div>

                    <div class="col-e-4 col-m-12 col-t-12">
                        <form action="../../Controlador/registro_IS.php" method="post">
                            <input type="submit" value="Cerrar sesion" name="cerrarSesion">
                        </form>
                    </div>
                </div>

                <div class="col-e-11 offset-e-1 offset-o-1 offset-t-0 offset-m-0">
                    <?php
                        foreach($vectorUsuarios as $usuario){
                            $cad = '<div class="etiquetaAdmin col-e-5 col-m-12 padTarjeta marginTarjeta">
                                        <form action="../../Controlador/controlador_crud.php" method="POST">
                                            <div class="row">
                                                <div class="col-e-3 col-m-12 col-t-12">
                                                    Correo:
                                                </div>
                                                
                                                <div class="col-e-9 col-m-12 col-t-12">
                                                    <input type="text" class="col-e-12 col-m-12" name="correo" value="'.$usuario->getCorreo().'" readonly>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-e-3 col-m-12 col-t-12">
                                                    Nombre:
                                                </div>
                                                <div class="col-e-9 col-m-12 col-t-12">
                                                    <input type="text" class="col-e-12 col-m-12" name="nombre" value="'. $usuario->getNombre() .'" readonly> 
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-e-3 col-m-12 col-t-12">
                                                    Apellidos:
                                                </div>
                                                <div class="col-e-9 col-m-12 col-t-12">
                                                    <input type="text" class="col-e-12 col-m-12" name="apellidos" value="'. $usuario->getApellidos().'" readonly>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-e-3 col-m-12 col-t-12">
                                                    Victorias:
                                                </div>
                                                <div class="col-e-9 col-m-12 col-t-12">
                                                    <input type="text" class="col-e-12 col-m-12" name="victorias" value="'. $usuario->getVictorias().'" readonly>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-e-3 col-m-12 col-t-12">
                                                    Estado:
                                                </div>
                                                <div class="col-e-9 col-m-12 col-t-12">
                                                    <input type="text" class="col-e-12 col-m-12" name="estado" value="'. $usuario->getEstado().'" readonly>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-e-3 col-m-12 col-t-12">
                                                    Activado:
                                                </div>
                                                <div class="col-e-9 col-m-12 col-t-12">
                                                    <input type="text" class="col-e-12 col-m-12" name="activado" value="'. $usuario->getActivado().'" readonly>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-e-3 col-m-12 col-t-12">
                                                    Puntuacion:
                                                </div>
                                                <div class="col-e-9 col-m-12 col-t-12">
                                                    <input type="text" class="col-e-12 col-m-12" name="puntuacion" value="'. $usuario->getPuntuacion().'" readonly>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-e-3 col-m-12 col-t-12">
                                                    Rol:
                                                </div>
                                                <div class="col-e-9 col-m-12 col-t-12">
                                                    <input type="text" class="col-e-12 col-m-12" name="rol" value="'. $usuario->getRol().'" readonly>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class=" col-e-4 col-m-6 izquierda padTop">
                                                    <input type="submit"  name="borrar" value="Borrar">
                                                </div>
                                                <div class=" col-e-4 col-m-6 derecha padTop">
                                                    <input type="submit" name="editarAdmin" value="Editar">
                                                </div>
                                            </div>
                                        </form>
                                    </div>';
                            echo $cad;
                        }
                    ?>
                    
                </div>                     
            </section>

            <footer class="row">
                <p class=" col-e-4 col-m-8 col-t-12 izquierda">Creado por Malena Diez</p>
                <p class=" col-e-8 col-m-4 col-t-12 derecha">@Copyright</p>
            </footer>
        </div>        
    </body>
</html>