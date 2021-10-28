<html>
    <head>
        <title>Escape Web</title>
        <link rel="stylesheet" href="../../CSS/general.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Vollkorn:ital,wght@1,500&display=swap">
    </head>

    <body>
        <?php
            require_once '../../Modelo/Persona.php';
            session_start();
            if(isset($_SESSION["usuario"])){
                $usuario = $_SESSION["usuario"];
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
                <div class="col-e-12">
                    <form action="../../Controlador/controlador_crud.php" method="POST" class="col-m-12 col-e-4  padTop padBottom offset-e-4 offset-m-0 ">
                        <fieldset class="padBottom">
                            <legend>Editar usuario: </legend>
                                <div class="row">
                                    <div class="col-e-3 col-m-12 col-t-12">
                                        Correo:
                                    </div>

                                    <div class="col-e-9 col-m-12 col-t-12">
                                        <input type="text" name="correo" value="<?=$usuario->getCorreo() ?>" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-e-3 col-m-12 col-t-12">
                                        Nombre:
                                    </div>

                                    <div class="col-e-9 col-m-12 col-t-12">
                                        <input type="text" name="nombre" value="<?= $usuario->getNombre() ?>">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-e-3 col-m-12 col-t-12">
                                        Apelllidos:
                                    </div>

                                    <div class="col-e-9 col-m-12 col-t-12">
                                        <input type="text" name="apellidos" value="<?= $usuario->getApellidos() ?>">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-e-3 col-m-12 col-t-12">
                                        Foto:
                                    </div>

                                    <div class="col-e-9 col-m-12 col-t-12">
                                        <input type="text" name="foto" value="<?= $usuario->getFoto()?>" >
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-e-3 col-m-12 col-t-12">
                                        Victorias:
                                    </div>

                                    <div class="col-e-9 col-m-12 col-t-12">
                                        <input type="text" name="victorias" value="<?= $usuario->getVictorias()?>">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-e-3 col-m-12 col-t-12">
                                        Estado:
                                    </div>

                                    <div class="col-e-9 col-m-12 col-t-12">
                                        <input type="text" name="estado" value="<?= $usuario->getEstado() ?>">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-e-3 col-m-12 col-t-12">
                                        Activado:
                                    </div>

                                    <div class="col-e-9 col-m-12 col-t-12">
                                        <input type="text" name="activado" value="<?= $usuario->getActivado() ?>">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-e-3 col-m-12 col-t-12">
                                        Puntuacion:
                                    </div>

                                    <div class="col-e-9 col-m-12 col-t-12">
                                        <input type="text" name="puntuacion" value="<?=$usuario->getPuntuacion() ?>">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-e-3 col-m-12 col-t-12">
                                        Rol:
                                    </div>

                                    <div class="col-e-9 col-m-12 col-t-12">
                                        <input type="text" name="rol" value="<?=$usuario->getRol() ?>"readonly >
                                    </div>
                                </div>

                                <div class="row padTop">
                                    <div class="col-e-12 col-m-12 col-t-12 centrado">
                                        <input type="submit" value="Aceptar cambios" name="aceptarCambios">
                                    </div>
                                </div>
                        </fieldset>
                    </form>
                    
                    <div class="row">
                        <div class="col-e-12 col-m-12 col-t-12 centrado">
                            <button type="button"><a href="crudAdmin.php">Volver</a></button>
                        </div>
                    </div>
                </div>                    
            </section>

            <footer class="row">
                <p class=" col-e-4 col-m-8 izquierda">Creado por Malena Diez</p>
                <p class=" col-e-8 col-m-4 derecha">@Copyright</p>
            </footer>
        </div>        
    </body>
</html>