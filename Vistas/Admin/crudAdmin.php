<html>
    <head>
        <title>Escape Web</title>
        <script src="Script/validacion.js"></script>
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

                <div class="col-e-6 col-m-6 edicionTitulo">
                    <h1>ESCAPE WEB</h1>
                </div>
            </header>
            

            <section class="row">
                <div class="col-e-12">
                    <?php
                        foreach($vectorUsuarios as $usuario){
                            $cad = '<form action="../../Controlador/controlador_crud.php" method="POST">
                                        Correo <input type="text" name="correo" value="'.$usuario->getCorreo().'" readonly>
                                        Nombre <input type="text" name="nombre" value="'. $usuario->getNombre() .'" readonly>
                                        Apellidos <input type="text" name="apellidos" value="'. $usuario->getApellidos().'" readonly>
                                        Victorias <input type="text" name="victorias" value="'. $usuario->getVictorias().'" readonly>
                                        Estado <input type="text" name="estado" value="'. $usuario->getEstado().'" readonly>
                                        Activado <input type="text" name="activado" value="'. $usuario->getActivado().'" readonly>
                                        Puntuacion <input type="text" name="puntuacion" value="'. $usuario->getPuntuacion().'" readonly>
                                        Rol <input type="text" name="rol" value="'. $usuario->getRol().'" readonly>
                                        <input type="submit" name="borrar" value="Borrar">
                                        <input type="submit" name="editarAdmin" value="Editar">
                                    </form>';
                            echo $cad;
                        }
                    ?>
                    <a href="../elegirRol.php">Volver</a>
                    <button><a href="añadirGestores.php">Añadir otros gestores</a></button>
                    <input type="button" value="Cerrar sesion" name="cerrarSesion">
                </div>
                                    
            </section>

            <footer class="row">
                <p class=" col-e-4 col-m-8 izquierda">Creado por Malena Diez</p>
                <p class=" col-e-8 col-m-4 derecha">@Copyright</p>
            </footer>
        </div>        
    </body>
</html>