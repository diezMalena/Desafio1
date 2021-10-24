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

                <div class="col-e-6 col-m-6 edicionTitulo">
                    <h1>ESCAPE WEB</h1>
                </div>
            </header>
            

            <section class="row">
                <div class="col-e-12">
                    <form action="../../Controlador/controlador_crud.php" method="POST">
                        Correo <input type="text" name="correo" value="<?=$usuario->getCorreo() ?>" readonly>
                        Nombre <input type="text" name="nombre" value="<?= $usuario->getNombre() ?>">
                        Apellidos <input type="text" name="apellidos" value="<?= $usuario->getApellidos() ?>">
                        Foto <input type="text" name="foto" value="<?= $usuario->getFoto()?>" >
                        Victorias <input type="text" name="victorias" value="<?= $usuario->getVictorias()?>">
                        Estado <input type="text" name="estado" value="<?= $usuario->getEstado() ?>">
                        Activado <input type="text" name="activado" value="<?= $usuario->getActivado() ?>">
                        Puntuacion <input type="text" name="puntuacion" value="<?=$usuario->getPuntuacion() ?>">
                        Rol <input type="text" name="rol" value="<?=$usuario->getRol() ?>"readonly >
                        <input type="submit" value="Aceptar cambios" name="aceptarCambios">
                    </form>
                    <a href="crudAdmin.php">Volver</a>
                </div>                    
            </section>

            <footer class="row">
                <p class=" col-e-4 col-m-8 izquierda">Creado por Malena Diez</p>
                <p class=" col-e-8 col-m-4 derecha">@Copyright</p>
            </footer>
        </div>        
    </body>
</html>