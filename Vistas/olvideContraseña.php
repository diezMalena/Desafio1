<html>

<head>
    <title>Escape Web</title>
    <link rel="stylesheet" href="../CSS/general.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Vollkorn:ital,wght@1,500&display=swap">
</head>

<body>
    <?php
            require_once '../BBDD/conexion.php';
            session_start();
            if(isset($_SESSION["mensajeError"])){
                echo $_SESSION["mensajeError"];
                unset($_SESSION["mensajeError"]);
            }

            if(isset($_SESSION["mensajeLlegada"])){
                echo $_SESSION["mensajeLlegada"];
                unset($_SESSION["mensajeLlegada"]);
            }
        ?>
    <div class="container">
        <header class="row">
            <div class="col-e-4 col-m-5">
                <img src="../Img/Generales/barco.png" class="imgResponsive">
            </div>

            <div class="col-e-6 col-m-6 edicionTitulo">
                <h1>ESCAPE WEB</h1>
            </div>
        </header>


        <section class="row sectionIndex alturaDiv">
            <div class="col-m-12 col-e-4 col-o-6 padTop padBottom offset-e-4 offset-m-0 offset-o-3">
                <form action="../Controlador/registro_IS.php" method="POST">
                    <fieldset class="padBottom fondoFieldset">
                        <legend>Introduce una direccion de correo electronico: </legend>

                        <div class="row padTop padBottom">
                            <div class="col-e-3 col-o-3 col-m-4 col-t-4">
                                <label for="mail">
                                    <span>E-mail:</span>
                                    <span class="error" aria-live="polite"></span>
                                </label>
                            </div>
                            <div class="col-e-9 col-o-9 col-m-8 col-t-8">
                                <div class="row">
                                    <input type="email" class="col-e-12" name="correo" id="mail" required minlength="5">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-e-5 col-o-5 col-m-5 col-t-5 floatIzq">
                                <div class="row">
                                    <input type="submit" class="col-e-12 button buttonPrimario" value="Enviar"
                                        name="olvideContraseña">
                                </div>
                            </div>
                            <div class="col-e-5 col-o-5 col-m-5 col-t-5 floatDer">
                                <div class="row">
                                    <a href="../index.php" class="col-e-12 button buttonPrimario">Volver</a>
                                </div>
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