<html>
    <head>
        <title>Escape Web</title>
        <script src="Script/validacion.js"></script>
        <link rel="stylesheet" href="./CSS/general.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Vollkorn:ital,wght@1,500&display=swap">
    </head>

    <body>
        <?php
            require_once './BBDD/conexion.php';
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
                        <center><b>ATAKEBUNE</b></center>
                        <p>
                        Un grupo de marines de la Marina Imperial Japonesa, se vio, no sabe muy bien cómo,
                        encerrado en la bodega de un buque de guerra japonés de la era Sengoku (s. XVI).
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
            </nav>

            <section class="row">
                <article class="col-e-12 centrado pad5 padBottom">
                        <form action="./Controlador/registro_IS.php" method="post">
                            <fieldset  class="padBottom col-e-6">
                                <legend>Introduce tus datos:  </legend><br>
                                    <label for="mail">
                                        <span>E-mail:</span>
                                        <input type="email" name="correo" id="mail" required minlength="5">
                                        <span class="error" aria-live="polite"></span>
                                    </label> <br><br>
                                
                                    Contraseña:  <input type="password" name="contraseña" value="" required minlength="5"><br><br>
                                    <input type="submit" value="Iniciar sesión" name="iniciarSesion" class="botonIS">
                                    <br><br>
                                    <p> ¿No tienes cuenta?  <a href="registro.php">Registrarse</a> </p>      
                                    <br>
                                    <p> <a href="olvideContraseña.php">He olvidado la contraseña</a> </p>
                            </fieldset>
                        </form>
                        <br>
                    </article>
            </section>

            <footer class="row">
                <p class=" col-e-4 col-m-12 izquierda">Creado por Malena Diez</p>
                <p class=" col-e-8 col-m-12 derecha">@Copyright</p>
            </footer>
        </div>        
    </body>
</html>