<html>
    <head>
        <title>Registrarse</title>
        <script src="Script/validacion.js"></script>
        <link rel="stylesheet" href="./CSS/general.css">
    </head>
    <body onload="validarEmail()">
        <?php
            session_start();
            if(isset($_SESSION["mensajeError"])){
                echo $_SESSION["mensajeError"];
                unset($_SESSION["mensajeError"]);
            }
        ?>
        <div class="container">
            <header class="row">
                <div class="col-e-4 col-m-12">
                    <img src="./Img/Generales/barco.png" class="imgResponsive">
                </div>

                <div class="col-e-6 col-m-12 edicionTitulo">
                    <h1>ESCAPE WEB</h1>
                </div>
            </header>

            <nav class="row">
                <div class="col-m-12 derecha">
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
            </nav>

            <section class="row">
                <article class="col-e-12 centrado pad5 padBottom">
                    <form action="./Controlador/registro_IS.php" method="POST">
                        <fieldset class="padBottom col-e-6">
                            <legend>Registro:  </legend>
                                <label for="mail" novalidate>
                                    <span>E-mail:</span>
                                    <input type="email" name="correo" id="mail" required minlength="5">
                                    <span class="error" aria-live="polite"></span>
                                </label> <br><br>
                                Nombre:  <input type="text" name="nombre" value="" required> <br><br>
                                Apellidos:  <input type="text" name="apellidos" value="" required> <br><br>
                                Foto: <input type="text" name="foto" value=""> <br><br>
                                Contraseña: <input type="password" name="contraseña" value="" required minlength="5"> <br><br>
                                Repite la contraseña: <input type="password" name="contraseña2" value="" required minlength="5"> <br><br>

                                <input type="submit" name="registrar" value="Registrarse">
                                <button><a href="index.php">Volver</a></button>
                        </fieldset>
                    </form>
                </article>
            </section>

            <footer class="row">
                <p class=" col-e-4 col-m-12 izquierda">Creado por Malena Diez</p>
                <p class=" col-e-8 col-m-12 derecha">@Copyright</p>
            </footer>
        </div>
    </body>
</html>