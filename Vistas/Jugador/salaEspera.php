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
            require_once '../../Modelo/Partida.php';
            session_start();
            $conex = new Conexion();
            if(isset($_SESSION["id_partida"])){
                $id_partida = $_SESSION["id_partida"];
            }

            if(isset($_SESSION["cuantosJugadores"])){
                $cuantosJugadores = $_SESSION["cuantosJugadores"];
            }
        ?>
    <div class="container">
        <header class="row">
            <div class="col-e-4 col-o-3 col-t-3 col-m-5">
                <a href="../../index.php"><img src="../../Img/Generales/barco.png" class="imgResponsive"></a>
            </div>

            <div class="col-e-6 col-o-7 col-t-7 col-m-6 offset-e-1 edicionTitulo">
                <h1>ESCAPE WEB</h1>
            </div>
        </header>

        <div class="row sectionRanking alturaDiv">
            <div class="col-e-12">
                <section class="row">
                    <article class="col-m-10 col-e-6 col-t-8 col-o-8 offset-e-3 offset-o-0 offset-m-1 offset-t-2 offset-o-2 padTopCentrar">
                        <div class="row redonditoGris padTop40 padBottom">
                            <div class="row">
                                <div class="col-e-6 col-o-8 col-t-8 ol-m-10 offset-e-3 offset-m-1 offset-t-2 offset-o-2 offset-e-2 padBottom15">
                                    <p>Espere a que se unan el resto de jugadores...</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-e-4 col-o-4 col-t-4 col-m-4 offset-m-2 offset-t-2 offset-o-3 offset-e-3">
                                    Código
                                </div>

                                <div class="col-e-4 col-o-4 col-t-4 col-m-4 offset-t-1">
                                    Jugadores
                                </div>
                            </div>

                            <div class="row padTop15">
                                <div class="col-e-4 col-o-4 col-t-4 col-m-4 offset-m-1 offset-t-1 offset-o-1 offset-e-1">
                                    <div class="row">
                                        <input type="text" class="col-e-12 sinBordeClaro centrado" name="id_partida"
                                            value="<?= $id_partida ?>">
                                    </div>
                                </div>

                                <div class="col-e-4 col-o-4 col-t-4 col-m-4 offset-m-1 offset-t-1 offset-o-1 offset-e-1">
                                    <div class="row">
                                        <input type="text" class="col-e-12 sinBordeClaro centrado" name="cuantosJugadores"
                                            value="<?= $cuantosJugadores ?>/5 jugadores">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-e-6 col-o-6 col-t-7 col-m-7 offset-m-2 offset-t-3 offset-o-3 offset-e-3">
                                        <div class="row padTop15">
                                            <form action="../../Controlador/controlador_juego.php" method="POST">
                                                <input type="submit" class="col-e-12 buttonMini buttonPrimario"
                                                    name="salir" value="Salir">
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </article>
                </section>
            </div>
        </div>

        <?php
            $cuantosJugadores = $conex->cuantosJugadores($id_partida);
            if($cuantosJugadores < 5){
                //Si todavia no hemos llegado a 5 jugadores, tenemos que recargar la sala de espera:
                $_SESSION["cuantosJugadores"] = $cuantosJugadores;
                header("Refresh: 1");
            }else{
                /*Si ya hemos llegado a 5 jugadores, nos vamos a la ventana del juego:
                ComienzaJuego será un request del controlador y el 1 es para que tenga un valor y entre dentro del isset: */
                header("Location: ../../Controlador/controlador_juego.php?comienzaJuego=1");
            }
        ?>

        <footer class="row">
            <p class=" col-e-4 col-m-8 izquierda">Creado por Malena Diez</p>
            <p class=" col-e-8 col-m-4 derecha">@Copyright</p>
        </footer>
    </div>
</body>

</html>