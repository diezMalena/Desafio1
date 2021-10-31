<html>

<head>
    <title>Registrarse</title>
    <link rel="stylesheet" href="../CSS/general.css">
    <script src="../Script/validacionRegistro.js"></script>
</head>

<body onload="validacion()">
    <?php
            session_start();
        ?>
    <div class="container">
        <header class="row">
            <div class="col-e-4 col-m-5">
                <img src="../Img/Generales/barco.png" class="imgResponsive">
            </div>

            <div class="col-e-8 col-m-6 edicionTitulo">
                <h1>ESCAPE WEB</h1>
            </div>
        </header>

        <section class="row fondoRegistro alturaDiv">
            <div class="col-m-12 col-e-4 col-t-12 col-o-8 padTop padBottom offset-e-4 offset-m-0 offset-t-0 offset-o-2">
                <form novalidate name="formularioRegistro" action="../Controlador/registro_IS.php" method="POST">
                    <fieldset class="padBottom fondoFieldsetRegistro">
                        <legend>Registro: </legend>

                        <div class="row padBottom15">
                            <div class="col-e-12 col-m-12 col-t-12 col-o-12">
                                <button class="tooltip">?
                                    <span class="tooltiptext">
                                        <p>
                                            ¡Regístrate y podrás disfrutar del mejor Escape Web!
                                            Más de 15.000 enigmas por adivinar... ¿A qué esperas?
                                            <br>¡Únete a nosotros!
                                        </p>
                                    </span>
                                </button>
                            </div>
                        </div>

                        <div class="row padBottom15">
                            <div class="col-e-6 col-m-4 col-t-4 col-o-4">
                                <label for="mail">
                                    <span>E-mail:</span>
                                </label>
                            </div>
                            <div class="col-e-6 col-m-8 col-t-8 col-o-8">
                                <div class="row">
                                    <input type="email" class="col-e-12" name="correo" id="mail" required minlength="5">
                                    <span class="error" aria-live="polite"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row padBottom15">
                            <div class="col-e-6 col-m-4 col-t-4 col-o-4">
                                Nombre:
                            </div>
                            <div class="col-e-6 col-m-8 col-t-8 col-o-8">
                                <div class="row">
                                    <input type="text" id="nombre" class="col-e-12" name="nombre" value="" required>
                                    <span id="nombreError" class="error" aria-live="polite"></span>
                                </div>
                            </div>
                        </div>


                        <div class="row padBottom15">
                            <div class="col-e-6 col-m-4 col-t-4 col-o-4">
                                Apellidos:
                            </div>
                            <div class="col-e-6 col-m-8 col-t-8 col-o-8">
                                <div class="row">
                                    <input type="text" class="col-e-12" id="apellidos" name="apellidos" value="" required>
                                    <span id="apellidosError" class="error" aria-live="polite"></span>
                                </div>
                            </div>
                        </div>


                        <div class="row padBottom15">
                            <div class="col-e-6 col-m-4 col-t-4 col-o-4">
                                Foto:
                            </div>
                            <div class="col-e-6 col-m-8 col-t-8 col-o-8">
                                <div class="row">
                                    <input class="col-e-12" type="text" name="foto" value="">
                                </div>
                            </div>
                        </div>



                        <div class="row padBottom15">
                            <div class="col-e-6 col-m-4 col-t-4 col-o-4">
                                Contraseña:
                            </div>
                            <div class="col-e-6 col-m-8 col-t-8 col-o-8">
                                <div class="row">
                                    <input type="password" id="contraseña" class="col-e-12" id="contraseña1"
                                        name="contraseña" value="" required minlength="5">
                                    <span id="contraseñaError" class="error" aria-live="polite"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row padBottom15">
                            <div class="col-e-6 col-m-4 col-t-4 col-o-4">
                                Repite la contraseña:
                            </div>
                            <div class="col-e-6 col-m-8 col-t-8 col-o-8">
                                <div class="row">
                                    <input type="password" id="contraseña2" class="col-e-12" id="contraseña2"
                                        name="contraseña2" value="" required minlength="5">
                                    <span id="contraseñaError2" class="error" aria-live="polite"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row padTop padBottom">
                            <div class="col-e-12 centrado error">
                                <?php 
                                    if(isset($_SESSION["mensajeError"])){
                                        echo $_SESSION["mensajeError"];
                                        unset($_SESSION["mensajeError"]);
                                    }
                                ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-e-6 col-m-12">
                                <input type="submit" name="registrar" value="Registrarse" id="registrarse">
                            </div>

                            <div class="col-e-6 col-m-12">
                                <button><a href="../index.php">Volver</a></button>
                            </div>
                        </div>

                    </fieldset>
                </form>
            </div>
        </section>


        <footer class="row">
            <p class=" col-e-4 col-m-8 izquierda">Creado por Malena Diez</p>
            <p class=" col-e-8 col-m-4 derecha">@Copyright</p>
        </footer>
    </div>
</body>

</html>