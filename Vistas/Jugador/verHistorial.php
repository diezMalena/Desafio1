<html>

<head>
    <title>Escape Web</title>
    <link rel="stylesheet" href="../../CSS/general.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Vollkorn:ital,wght@1,500&display=swap">
</head>

<body>
    <?php
            require_once '../../Modelo/Historial.php';
            session_start();
            if(isset($_SESSION["historial"])){
                $historial = $_SESSION["historial"];
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
            <div class="col-e-8 col-o-8 col-t-12 col-m-12 offset-e-2 offset-o-2 offset-t-0 offset-m-0 padTop15">
                <section class="row fondoRanking">
                    <div class="col-e-12">
                        <div class="row padBottom15">
                            <div
                                class="colorClaro col-e-6 col-o-6 col-t-10 col-m-10 offset-e-3 offset-o-3 offset-t-1 offset-m-1">
                                <div class="row padTop15 padBottom15">
                                    <div class="col-e-4 col-o-4 col-t-4 col-m-4 centrado">
                                        Código de la partida:
                                    </div>
                                    <div class="col-e-8 col-o-8 col-t-8 col-m-8">
                                        <input type="text" class="col-e-11  letraGrande"
                                            value="<?=$historial->getId_partida()?>" readonly>
                                    </div>
                                </div>
                                <div class="row padTop15 padBottom15">
                                    <div class="col-e-4 col-o-4 col-t-4 col-m-4 centrado">
                                        Llaves:
                                    </div>
                                    <div class="col-e-8 col-o-8 col-t-8 col-m-8">
                                        <input type="text" class="col-e-11  letraGrande"
                                            value="<?=$historial->getLlaves()?> llaves" readonly>
                                    </div>
                                </div>
                                <div class="row padTop15 padBottom15">
                                    <div class="col-e-4 col-o-4 col-t-4 col-m-4 centrado">
                                        Hora de inicio:
                                    </div>
                                    <div class="col-e-8 col-o-8 col-t-8 col-m-8">
                                        <input type="text" class="col-e-11  letraGrande"
                                            value="<?=$historial->getHoraInicio()?>" readonly>
                                    </div>
                                </div>
                                <div class="row padTop15 padBottom15">
                                    <div class="col-e-4 col-o-4 col-t-4 col-m-4 centrado">
                                        Hora de fin:
                                    </div>
                                    <div class="col-e-8 col-o-8 col-t-8 col-m-8">
                                        <input type="text" class="col-e-11  letraGrande"
                                            value="<?=$historial->getHoraFin()?>" readonly>
                                    </div>
                                </div>

                                <div class="row padTop15 padBottom15">
                                    <div class="col-e-4 col-o-4 col-t-4 col-m-4 centrado">
                                        Jugadores:
                                    </div>
                                    <div class="col-e-8 col-o-8 col-t-8 col-m-8">
                                        <input type="text" class="col-e-11 letraGrande"
                                            value="<?=$historial->getUsuarios()?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row padTop padBottom30">
                            <div
                                class="col-e-4 col-o-4 col-t-10 col-m-8 offset-e-4 offset-m-2 offset-o-4 offset-t-1 offset-m-2">
                                <div class="row">
                                    <a href="perfilJugador.php"
                                        class="col-e-12 col-m-12 button buttonPrimarioVolver">Volver a mi perfil</a>
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