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
                <section class="row padTop40">
                    <div
                        class="col-e-8 col-o-8 col-t-10 col-m-10 offset-e-2 offset-o-2 offset-t-1 offset-m-1 fondoJugar padTop padBottom">
                        <div class="row padTop40 padBottom15">
                            <div
                                class="col-e-12 col-o-12 col-t-12 col-m-12">
                                <p class="centrado">Enhorabuena, ¡HAS SOBREVIVIDO AL ESCAPE ROOM MÁS DIFICIL DE TODOS!
                                </p>
                            </div>
                        </div>

                        <div class="row padTop padBottom">
                            <div class="col-e-4 col-m-8 col-t-6 col-o-6 offset-e-4 offset-o-3 offset-t-3 offset-m-2">
                                <form action="../../Controlador/controlador_juego.php" method="POST">
                                    <div class="row">
                                        <input type="submit" value="Ver historial" name="verHistorial"
                                            class="col-e-12 button buttonSecundario" />
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-e-4 col-m-5 col-t-5 col-o-5 floatIzq">
                                <form action="../../Controlador/registro_IS.php" method="POST">
                                    <div class="row">
                                        <input type="submit" value="Cerrar sesión" name="cerrarSesion"
                                            class="col-e-12 button buttonPrimarioVolver" />
                                    </div>
                                </form>
                            </div>

                            <div class="col-e-4 col-m-5 col-t-5 col-o-5 floatDer">
                                <div class="row">
                                    <a href="perfilJugador.php"
                                        class="col-e-12 button buttonPrimarioVolver">Volver</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>


        <footer class="row">
            <p class=" col-e-4 col-m-8 izquierda">Creado por Malena Diez</p>
            <p class=" col-e-8 col-m-4 derecha">@Copyright</p>
        </footer>
    </div>
</body>

</html>