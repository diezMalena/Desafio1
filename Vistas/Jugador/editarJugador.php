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
            <div class="col-e-12">
                <section class="row">
                    <div
                        class="col-e-4 col-o-7 col-t-7 col-m-12 offset-e-4 offset-m-0 offset-o-3 offset-t-3 padTop padBottom marginTop">
                        <form action="../../Controlador/controlador_jugador.php" method="POST">
                            <fieldset class="padBottom fondoFieldsetUsuario">
                                <legend>Editar usuario: </legend>
                                <div class="row padBottom15">
                                    <div class="col-e-3 col-o-3 col-m-3 col-t-3">
                                        Correo:
                                    </div>

                                    <div class="col-e-9 col-o-9 col-m-9 col-t-9">
                                        <div class="row">
                                            <input type="text" class="col-e-12 col-o-8 col-t-8 col-m-8" name="correo"
                                                value="<?=$usuario->getCorreo() ?>" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="row padBottom15">
                                    <div class="col-e-3 col-o-3 col-m-3 col-t-3">
                                        Nombre:
                                    </div>

                                    <div class="col-e-9 col-o-9 col-m-9 col-t-9">
                                        <div class="row">
                                            <input type="text" class="col-e-12 col-o-8 col-t-8 col-m-8" name="nombre"
                                                value="<?= $usuario->getNombre() ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row padBottom15">
                                    <div class="col-e-3 col-o-3 col-m-3 col-t-3">
                                        Apelllidos:
                                    </div>

                                    <div class="col-e-9 col-o-9 col-m-9 col-t-9">
                                        <div class="row">
                                            <input type="text" class="col-e-12 col-o-8 col-t-8 col-m-8" name="apellidos"
                                                value="<?= $usuario->getApellidos() ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row padBottom15">
                                    <div class="col-e-3 col-o-3 col-m-3 col-t-3">
                                        Foto:
                                    </div>

                                    <div class="col-e-9 col-o-9 col-m-9 col-t-9">
                                        <div class="row">
                                            <input type="text" class="col-e-12 col-o-8 col-t-8 col-m-8" name="foto"
                                                value="<?= $usuario->getFoto()?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row padBottom15">
                                    <div class="col-e-3 col-o-3 col-m-3 col-t-3">
                                        Contraseña:
                                    </div>

                                    <div class="col-e-9 col-o-9 col-m-9 col-t-9">
                                        <div class="row">
                                            <input type="text" class="col-e-12 col-o-8 col-t-8 col-m-8"
                                                name="contraseña" value="<?= $usuario->getContraseña()?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row padTop15 padBottom15">
                                    <div class="col-e-4 col-m-5 floatIzq">
                                        <div class="row">
                                            <input type="submit" class="col-e-12 col-m-12 buttonMini buttonSecundario"
                                                name="aceptarCambiosJugador" value="Aceptar cambios">
                                        </div>
                                    </div>

                                    <div class="col-e-2 col-m-5 floatDer">
                                        <div class="row">
                                            <a href="perfilJugador.php"
                                                class="col-e-12 col-m-12 buttonMini buttonSecundario">Volver</a>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
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