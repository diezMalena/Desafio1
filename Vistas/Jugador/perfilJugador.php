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
            
            <section class="row sectionAdmin">
                <form action="../../Controlador/controlador_jugador.php" method="POST">
                    <input type="submit" value="Ver Ranking" name="ranking">
                </form>

                <form action="../../Controlador/registro_IS.php" method="POST">
                    <input type="submit" value="Cerrar sesion" name="cerrarSesion">
                </form>
                
            </section>

            <footer class="row">
                <p class=" col-e-4 col-m-8 izquierda">Creado por Malena Diez</p>
                <p class=" col-e-8 col-m-4 derecha">@Copyright</p>
            </footer>
        </div>        
    </body>
</html>