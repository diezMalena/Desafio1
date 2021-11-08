<html>

<head>
    <title>Escape Web</title>
    <script src="../../Script/validacionId_partida.js"></script>
    <link rel="stylesheet" href="../../CSS/general.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Vollkorn:ital,wght@1,500&display=swap">
</head>

<body onload="validacion()">
    <?php
            require_once '../../BBDD/conexion.php';
            require_once '../../Modelo/Partida.php';
            session_start();
            if(isset($_SESSION["vectorPartida"])){
                $vectorPartida = $_SESSION["vectorPartida"];
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

        <section class="row sectionRanking padBottom padTop15 alturaDiv">
            <article class="col-e-8 col-o-8 col-t-12 col-m-12 offset-e-2 offset-o-2 offset-t-0 offset-m-0 fondoJugar">
                <div class="row">
                    <div class="col-e-8 col-o-10 col-t-12 col-m-12 redonditoGris padding offset-e-2 offset-o-1 offset-t-0 offset-m-0">
                        <div class="row">
                            <p class="centrado padBottom15">Partidas públicas disponibles</p>
                        </div>
                        <?php
                            if(count($vectorPartida) > 0){
                                foreach($vectorPartida as $partida){
                                    $cad = '<div class="row">
                                                <div class="col-e-4 col-o-4 col-t-4 col-m-4 margin">
                                                    <div class="row">
                                                        Código de partida
                                                    </div>
                                                </div>
                    
                                                <div class="col-e-4 col-o-4 col-t-4 col-m-4 margin">
                                                    <div class="row">
                                                        Jugadores
                                                    </div>
                                                </div>
                                            </div>'; 
                                    $cad .= '<div class="row">
                                                <form action="../../Controlador/controlador_juego.php" method="POST">
                                                    <div class="col-e-4 col-o-4 col-t-4 col-m-4 margin">
                                                        <div class="row">
                                                            <input type="text" class="col-e-12" value="'.$partida->getId_partida().'" name="id_partida" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-e-4 col-o-4 col-t-4 col-m-4 margin">
                                                        <div class="row">
                                                            <input type="text" class="col-e-12" value="'.$partida->getContjugadores().'/5 jugadores" name="contJugadores" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-e-3 col-o-3 col-t-3 col-m-3 margin">
                                                        <div class="row">
                                                            <input type="submit" class="col-e-12 buttonMini buttonSecundario" value="Unirme" name="unirme">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>';
                                        echo $cad;
                                    }
                            }else{
                                $cad = "No hay partidas disponibles.";
                                echo $cad;
                            }
                                ?>
                    </div>
                </div>

                <div class="row padTop40">
                    <div class="col-e-8 col-o-10 col-t-12 col-m-12 centrado offset-e-2 offset-o-1 offset-t-0 offset-m-0">
                        <form novalidate action="../../Controlador/controlador_juego.php" method="POST">
                            <fieldset class="padBottom fondoFieldsetPartida">
                                <legend>Salas: </legend>
                                <div class="row padBottom15">
                                    <div class="col-e-6 col-m-4 col-t-4 col-o-4">
                                        <label for="id_partida">
                                            <span>Código de partida: </span>
                                        </label>
                                    </div>

                                    <div class="col-e-6 col-m-8 col-t-8 col-o-8">
                                        <div class="row">
                                            <input type="text" class="col-e-12 col-m-12" id="id_partida"
                                                name="id_partida" value="">
                                            <span id="id_partidaError" class="error" aria-live="polite"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row padBottom15">
                                    <div class="col-e-6 col-m-4 col-t-4 col-o-4">
                                        Crear partida privada:
                                    </div>

                                    <div class="col-e-1 col-m-8 col-t-8 col-o-8">
                                        <input class="floatIzq" type="checkbox" name="privada" value="1">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-e-5 col-o-5 col-t-5 col-m-5 floatIzq">
                                        <div class="row">
                                            <input type="submit" value="Crear partida" name="crearPartida"
                                                id="crearPartida" class="col-e-12 button buttonSecundario" />
                                        </div>
                                    </div>

                                    <div class="col-e-5 col-o-5 col-t-5 col-m-5 floatDer">
                                        <div class="row">
                                            <input type="submit" value="Unirme a partida" name="unirme" id="unirme"
                                                class="col-e-12 button buttonSecundario" />
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
                <div class="row padTop15">
                    <div class="col-e-4 col-m-4 col-t-4 col-o-6 offset-e-2 offset-o-1 offset-t-0 offset-m-0">
                        <div class="row">
                            <a href="perfilJugador.php" class="col-e-5 col-o-6 col-t-12 col-m-12 button buttonPrimarioVolver">Volver</a>
                        </div>
                    </div>

                    <div class="col-e-4 col-m-4 col-t-4 col-o-4 offset-e-2 offset-t-4 offset-o-0">
                        <div class="row">
                            <form action="../../Controlador/registro_IS.php" method="POST">
                                <div class="row">
                                    <input class="col-e-6 col-o-12 col-t-12 col-m-12 button buttonPrimarioVolver" type="submit" name="cerrarSesion"
                                        value="Cerrar sesion"></input>
                                </div>
                            </form>
                        </div>
                    </div>
            </article>
        </section>
    </div>


    <footer class="row">
        <p class=" col-e-4 col-m-8 izquierda">Creado por Malena Diez</p>
        <p class=" col-e-8 col-m-4 derecha">@Copyright</p>
    </footer>
    </div>
</body>

</html>