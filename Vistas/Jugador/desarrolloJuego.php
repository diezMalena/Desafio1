<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../../Script/JuegoJS/juego.js"></script>
    <link rel="stylesheet" href="../../CSS/general.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Vollkorn:ital,wght@1,500&display=swap">
    <title>Escape Web</title>
</head>

<body>
    <?php
        require_once '../../BBDD/json.php';
        require_once '../../BBDD/conexion.php';
        require_once '../../Modelo/Persona.php';
        session_start();
        $conex = new Conexion();
        if(isset($_SESSION["arrayJugadores"])){
            $arrayJugadores = $_SESSION["arrayJugadores"];
        }
        if(isset($_SESSION["jugadorActual"])){
            $jugadorActual = $_SESSION["jugadorActual"];
        }
        if(isset($_SESSION["enigma"])){
            $enigma = $_SESSION["enigma"];
        }   
        if(isset($_SESSION["llaves"])){
            $llaves = $_SESSION["llaves"];
        }
        if(isset($_SESSION["primeraRonda"])){
            $primeraRonda = $_SESSION["primeraRonda"];
        }
        if(isset($_SESSION["id_partida"])){
            $id_partida = $_SESSION["id_partida"];
        }
        if(isset($_SESSION["persona"])){
            $persona = $_SESSION["persona"];
        }

        /*Recogemos el array asociativo de php ya convertido a json con ENCODE, y esos datos json 
        los almacenamos en $datosJuego: */
        $datosJuego = json::convertirDatosJson($arrayJugadores,$jugadorActual,$enigma,$llaves, $primeraRonda);

        //Vamos a traer de nuevo los datos(una pregunta nueva, y los jugadores ya actualizados):
        $arrayJugadores = $conex->cogerJugadoresPartida($id_partida);
        //Recorrer el arrayJugadores y lo comparo con el correo de la persona en sesion: 
        foreach($arrayJugadores as $jugador){
            if($persona->getCorreo() == $jugador["correo"]){
                $_SESSION["jugadorActual"] = $jugador;
            }
        }
        $enigma = $conex->cogerPreguntaAux($id_partida);
        $llaves = $conex->cuantasLlaves($id_partida);
        $_SESSION["llaves"] = $llaves;
        $_SESSION["enigma"] = $enigma;
        $_SESSION["arrayJugadores"] = $arrayJugadores;
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

        <section class="row sectionRanking padBottom padTop40 alturaDiv">
            <article class="col-e-8 col-o-8 col-t-12 col-m-12 offset-e-2 offset-o-2 offset-t-0 offset-m-0 fondoJugar">
                <div class="row">
                    <div
                        class="col-e-10 col-o-10 col-t-12 col-m-12 redonditoGris padding offset-e-1 offset-o-1 offset-t-0 offset-m-0">
                        <div class="row">
                            <div class="col-e-4 col-o-4 col-t-4 col-m-4">
                                Llaves: <input type="text" class="sinBordeClaro" name="llaves" id="llaves" value="" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-e-12 col-o-10 col-t-12 col-m-12">
                                <form action="../../Controlador/controlador_juego.php" method="POST">
                                    <div class="row padTop15">
                                        <div class="col-e-2">
                                            Enigma:
                                        </div>
                                        <div class="col-e-10">
                                            <div class="row">
                                                <input type="text" class="col-e-12" name="frase" id="frase" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row padTop15">
                                        <div class="col-e-4 offset-e-3" id="opciones">
                                            <!-- EN ESTE DIV SE PINTAN LAS RESPUESTAS POSIBLES -->
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-e-11">
                                            <div class="row">
                                                <input type="hidden" class="col-e-8" name="datosJuego" id="datosJuego"
                                                    value="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row padTop15">
                                        <div class="col-e-4 offset-e-3">
                                            <div class="row">
                                                <input type="submit" id="aceptar" value="Responder" name="aceptar"
                                                    class="col-e-8 button buttonSecundario">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-e-4 redonditoGris padding" id="eresAlmirante">

                        </div>
                    </div>

                </div>

            </article>
        </section>
        <footer class="row">
            <p class=" col-e-4 col-m-8 izquierda">Creado por Malena Diez</p>
            <p class=" col-e-8 col-m-4 derecha">@Copyright</p>
        </footer>
    </div>


    <!-- Esto coge el JSON  de PHP, y lo mete en javascript -->
    
</body>
<script>
    var juego = '<?php echo $datosJuego; ?>';
    jugarJS(juego);
</script>
</html>