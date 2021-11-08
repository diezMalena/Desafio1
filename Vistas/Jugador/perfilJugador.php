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
                <a href="../../index.php"><img src="../../Img/Generales/barco.png" class="imgResponsive"></a>
            </div>

            <div class="col-e-6 col-o-7 col-t-7 col-m-6 offset-e-1 edicionTitulo">
                <h1>ESCAPE WEB</h1>
            </div>
        </header>

        <div class="row sectionRanking alturaDiv">
            <div class="col-e-12">
                <div class="row">
                    <nav class="col-e-12 col-o-12 col-t-12 col-m-12 navegador">
                        <div class="row">
                            <div class="col-e-9 col-o-9 col-t-12 col-m-12">
                                <div class="row">
                                    <form action="../../Controlador/controlador_jugador.php" method="POST">
                                        <div class="col-e-2 col-o-2 col-t-8 col-m-12 offset-t-2 offset-m-0">
                                            <div class="row">
                                                <input class="col-e-12 button buttonPrimario" type="submit"
                                                    value="Jugar" name="jugar"></input>
                                            </div>
                                        </div>

                                        <div class="col-e-2 col-o-2 col-t-8 col-m-12 offset-t-2 offset-m-0">
                                            <div class="row">
                                                <input class="col-e-12 button buttonPrimario" type="submit"
                                                    name="editarPerfil" value="Editar mi perfil"></input>
                                            </div>
                                        </div>


                                        <div class="col-e-3 col-o-2 col-t-8 col-m-12 offset-t-2 offset-m-0">
                                            <div class="row">
                                                <input class="col-e-12 button buttonPrimario" type="submit"
                                                    name="ranking" value="Ver ranking"></input>
                                            </div>
                                        </div>

                                        <div class="col-e-3 col-o-2 col-t-8 col-m-12 offset-t-2 offset-m-0">
                                            <div class="row">
                                                <input class="col-e-12 button buttonPrimario" type="submit"
                                                    name="jugadoresOnline" value="Jugadores online"></input>
                                            </div>
                                        </div>

                                        <div class="col-e-2 col-o-2 col-t-8 col-m-12 offset-t-2 offset-m-0">
                                            <div class="row">
                                                <?php 
                                                    if(isset($_SESSION["persona"])){
                                                        $persona = $_SESSION["persona"];
                                                        if($persona->getRol() > 0){
                                                            echo '<input class="col-e-12 button buttonPrimario" type="submit"
                                                            name="cambiarRol" value="Cambiar rol"></input>';
                                                        }
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="col-e-2 col-o-3 col-t-8 col-m-12 offset-t-2  offset-e-1 offset-m-0 offset-o-0">
                                <form action="../../Controlador/registro_IS.php" method="POST">
                                    <div class="row">
                                        <div class="col-e-12 offset-e-0 offset-o-0 offset-t-0 offset-m-0">
                                            <div class="row">
                                                <input class="col-e-12 button buttonPrimarioVolver" type="submit"
                                                    name="cerrarSesion" value="Cerrar sesion"></input>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>


            <section class="col-e-10 col-o-10 col-t-12 col-m-12 padTop padBottom">
                <div class="row">
                    <fieldset
                        class="col-e-5 col-o-8 col-t-8 col-m-12 offset-e-5 offset-m-0 offset-o-3 offset-t-2 padTop padBottom marginTop fondoFieldsetUsuario">
                        <legend>Mis datos:</legend>
                        <div class="row">
                            <div class="col-e-4 col-o-4 col-t-4 col-m-4 letraGrande">
                                Usuario:
                            </div>
                            <div class="col-e-8 col-o-8 col-t-8 col-m-8 letraGrande">
                                <div class="row">
                                    <?php echo $usuario->getCorreo()  ?>
                                </div>
                            </div>
                        </div>

                        <div class="row padTop">
                            <div class="col-e-4 col-o-4 col-t-4 col-m-4 letraGrande">
                                Puntuación:
                            </div>
                            <div class="col-e-8 col-o-8 col-t-8 col-m-8 letraGrande">
                                <div class="row">
                                    <?php echo $usuario->getPuntuacion()  ?> puntos
                                </div>
                            </div>
                        </div>

                        <div class="row padTop">
                            <div class="col-e-4 col-o-4 col-t-4 col-m-4 letraGrande">
                                Estado:
                            </div>
                            <div class="col-e-8 col-o-8 col-t-8 col-m-8 letraGrande">
                                <div class="row">
                                    <?php 
                                        if($usuario->getEstado() == 1){
                                            echo "Conectado";
                                        }else{
                                            echo "Desconectado";
                                        } 
                                        ?>
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