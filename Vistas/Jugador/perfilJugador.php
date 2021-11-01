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
            if(isset($_SESSION["persona"])){
                $usuario = $_SESSION["persona"];
            }

        ?>
    <div class="container">
        <header class="row">
            <div class="col-e-4 col-o-3 col-t-3 col-m-5">
                <img src="../../Img/Generales/barco.png" class="imgResponsive">
            </div>

            <div class="col-e-6 col-o-7 col-t-7 col-m-6 offset-e-1 edicionTitulo">
                <h1>ESCAPE WEB</h1>
            </div>
        </header>

        <div class="row sectionRanking alturaDiv">
            <nav class="col-e-2 col-o-2 col-t-12 col-m-12">
                <form action="../../Controlador/controlador_jugador.php" method="POST">
                    <div class="row">
                        <div class="col-e-12">
                            <div class="row padBottom padTop40">
                                <input class="col-e-12 button buttonSecundario" type="submit" value="Jugar"
                                    name="jugar"></input>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-e-12">
                            <div class="row padBottom">
                                <input class="col-e-12 button buttonSecundario" type="submit" name="editarPerfil"
                                    value="Editar mi perfil"></input>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-e-12">
                            <div class="row padBottom">
                                <input class="col-e-12 button buttonSecundario" type="submit" name="ranking"
                                    value="Ver ranking"></input>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-e-12">
                            <div class="row padBottom">
                                <input class="col-e-12 button buttonSecundario" type="submit" name="jugadoresOnline"
                                    value="Jugadores online"></input>
                            </div>
                        </div>
                    </div>
                </form>
                <form action="../../Controlador/registro_IS.php" method="POST">
                    <div class="row">
                        <div class="col-e-12">
                            <div class="row padBottom">
                                <input class="col-e-12 button buttonSecundario" type="submit" name="cerrarSesion"
                                    value="Cerrar sesion"></input>
                            </div>
                        </div>
                    </div>
                </form>
            </nav>

            <section class="col-e-10 col-o-10 col-t-12 col-m-12 padTop padBottom">
                <div class="row">
                    <fieldset
                        class="col-e-4 col-o-10 col-t-12 col-m-12 offset-e-4 offset-m-0 offset-o-1 offset-t-0 padTop padBottom marginTop fondoFieldsetUsuario">
                        <legend>Mis datos:</legend>
                        <div class="row">
                            <div class="col-e-4 col-m-12 letraGrande">
                                Usuario:
                            </div>
                            <div class="col-e-8 col-m-12">
                                <div class="row">
                                    <input class="col-e-10 letraGrande" type="text" name="correo"
                                        value="<?=$usuario->getCorreo() ?>" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row padTop">
                            <div class="col-e-4 col-m-12 letraGrande">
                                Puntuación:
                            </div>
                            <div class="col-e-8 col-m-12">
                                <div class="row">
                                    <input class="col-e-10 letraGrande" type="text" name="puntuacion"
                                        value="<?=$usuario->getPuntuacion() ?> puntos" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row padTop">
                            <div class="col-e-4 col-m-12 letraGrande">
                                Estado:
                            </div>
                            <div class="col-e-8 col-m-12">
                                <div class="row">
                                    <input class="col-e-10 letraGrande" type="text" name="puntuacion" value="<?php 
                                        if($usuario->getEstado() == 1){
                                            echo "Conectado";
                                        }else{
                                            echo "Desconectado";
                                        } 
                                        ?>" readonly>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </section>
        </div>
        <footer class="row">
            <p class=" col-e-4 col-m-8 izquierda">Creado por Malena Diez</p>
            <p class=" col-e-8 col-m-4 derecha">@Copyright</p>
        </footer>
    </div>
</body>

</html>