<html>

<head>
    <title>Registrarse</title>
    <link rel="stylesheet" href="../CSS/general.css">
    <script src='https://www.google.com/recaptcha/api.js?render=6Lc2AAodAAAAAFynKlvUXb95G2U8H3tRJH3wm29P'></script>
    <script src="../Script/recaptcha.js"></script>
    <script src="../Script/validacionRegistro.js"></script>
</head>

<body onload="validacion()">
    <?php
            session_start();
        ?>
    <div class="container">
        <header class="row">
            <div class="col-e-4 col-m-5">
                <a href="../index.php"><img src="../Img/Generales/barco.png" class="imgResponsive"></a>
            </div>

            <div class="col-e-8 col-m-6 edicionTitulo">
                <h1>ESCAPE WEB</h1>
            </div>
        </header>


        <div class="row sectionRanking alturaDiv">
            <div class="col-e-12">
                <section class="row">
                    <div
                        class="col-m-12 col-e-4 col-t-12 col-o-6 padTop padBottom offset-e-4 offset-m-0 offset-t-0 offset-o-3">
                        <form novalidate name="formularioRegistro" action="../Controlador/registro_IS.php"
                            method="POST">
                            <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
                            <fieldset class="padBottom fondoFieldsetUsuario">
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
                                            <input type="email" class="col-e-12" name="correo" id="mail" required
                                                minlength="5">
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
                                            <input type="text" id="nombre" class="col-e-12" name="nombre" value=""
                                                required>
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
                                            <input type="text" class="col-e-12" id="apellidos" name="apellidos" value=""
                                                required>
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

                                    if(isset($_SESSION["mensajeCaptcha"])){
                                        echo $_SESSION["mensajeCaptcha"];
                                        unset($_SESSION["mensajeCaptcha"]);
                                    }
                                ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-e-5 col-m-5 floatIzq">
                                        <div class="row">
                                            <input type="submit" value="Registrarse" name="registrar" id="registrarse"
                                                class="col-e-12 button buttonPrimario" />
                                        </div>
                                    </div>
                                    <div class="col-e-5 col-m-5 floatDer">
                                        <div class="row">
                                            <a href="../index.php" class="col-e-12 button buttonPrimario">Volver</a>
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