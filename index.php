<html>

<head>
    <title>Escape Web</title>
    <link rel="stylesheet" href="./CSS/general.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Vollkorn:ital,wght@1,500&display=swap">
    <script src="./Script/validacionLogin.js"></script>
</head>

<body onload="validacion()">
    <?php
            require_once './BBDD/conexion.php';
            session_start();
        ?>
    <div class="container">
        <header class="row">
            <div class="col-e-4 col-m-5">
                <img src="./Img/Generales/barco.png" class="imgResponsive">
            </div>

            <div class="col-e-8 col-m-6 edicionTitulo">
                <h1>ESCAPE WEB</h1>
            </div>
        </header>


        <section class="row sectionIndex alturaDiv">
            <div class="col-m-12 col-e-4 col-t-12 col-o-8 padTop padBottom offset-e-4 offset-m-0 offset-t-0 offset-o-2">
                <form novalidate action="./Controlador/registro_IS.php" method="POST">
                    <fieldset class="padBottom fondoFieldset">
                        <legend>Introduce tus datos: </legend>
                        <div class="row">
                            <div class="col-e-12 col-m-12 col-t-12 col-o-12">
                                <button class="tooltip">?
                                    <span class="tooltiptext">
                                        <p>
                                            Un grupo de marines de la Marina Imperial Japonesa, se vio, no sabe muy bien
                                            cómo,
                                            encerrado en la bodega de un buque de guerra japonés de la era Sengoku (s.
                                            XVI).
                                            Uno de los marines se da cuenta de
                                            que sus pies cada vez están más
                                            cubiertos de agua.
                                            El objetivo es salir del barco en el
                                            menor tiempo posible, ya que
                                            calculan que en menos de media hora
                                            su vida corre peligro.
                                            Para salir del barco, deberán
                                            encontrar las cinco llaves que les
                                            permitirán salir de la bodega…
                                            pero… ¿cómo?
                                        </p>
                                    </span>
                                </button>
                            </div>
                        </div>


                        <div class="row padBottom15">
                            <div class="col-e-4 col-m-12">
                                <label for="mail">
                                    <span>E-mail:</span>
                                </label>
                            </div>
                            <div class="col-e-8 col-m-12">
                                <div class="row">
                                    <input type="email" class="col-e-12" name="correo" id="mail" required minlength="5">
                                    <span class="error" aria-live="polite"></span>
                                </div>    
                            </div>
                        </div>

                        <div class="row padBottom15">
                            <div class="col-e-4 col-m-12">
                                Contraseña:
                            </div>
                            <div class="col-e-8 col-m-12">
                                <div class="row">
                                    <input class="col-e-12" type="password" id="password" name="contraseña" value=""
                                        required minlength="5">
                                    <span id="passE" class="error" aria-live="polite"></span>
                                </div>
                            </div>
                        </div>


                        <div class="row padTop padBottom">
                            <div class="col-e-12 centrado">
                                <div class="row">
                                    <input type="submit" value="Iniciar sesión" id="iniciarSesion" name="iniciarSesion"
                                        class="col-e-12 col-m-12 button buttonPrimario">
                                </div>
                            </div>
                        </div>

                        <div class="row  padBottom">
                            <div class="col-e-12 centrado error">
                                <?php 
                                    if(isset($_SESSION["mensajeError"])){
                                        echo $_SESSION["mensajeError"];
                                        unset($_SESSION["mensajeError"]);
                                    }
                                    if(isset($_SESSION["mensajeRecibido"])){
                                        echo $_SESSION["mensajeRecibido"];
                                        unset($_SESSION["mensajeRecibido"]);
                                    }
                                ?>
                            </div>
                        </div>

                        <div class="row padBottom">
                            <div class="col-e-12 centrado">
                                <p> ¿No tienes cuenta? <a href="./Vistas/registro.php">Registrarse</a> </p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-e-12 centrado">
                                <p> <a href="./Vistas/olvideContraseña.php">He olvidado la contraseña</a> </p>
                            </div>
                        </div>
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