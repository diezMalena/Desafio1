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
            if(isset($_SESSION["mensajeRecibido"])){
                echo $_SESSION["mensajeRecibido"];
                unset($_SESSION["mensajeRecibido"]);
            }
        ?>
        <div class="container">
            <header class="row">
                <div class="col-e-4 col-m-5">
                    <img src="./Img/Generales/barco.png" class="imgResponsive">
                </div>

                <div class="col-e-6 col-m-6 edicionTitulo">
                    <h1>ESCAPE WEB</h1>
                </div>
            </header>
            

            <section class="row sectionIndex">
                <div class="col-e-12">
                    <form action="./Controlador/registro_IS.php" method="POST" class="col-m-12 col-e-4 padTop padBottom offset-e-4 offset-m-0 ">
                        <fieldset class="padBottom fondoFieldset">
                            <legend>Introduce tus datos:   </legend>
                                <button class="tooltip">?
                                    <span class="tooltiptext">
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
                    
                            <div class="row">
                                <div class="col-e-6 col-m-12">
                                    <label for="mail">
                                        <span>E-mail:</span>
                                        <span class="error" aria-live="polite"></span>
                                    </label>
                                </div>
                                <div class="col-e-5 col-m-12">
                                    <input type="email" name="correo" id="mail" required minlength="5">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-e-6 col-m-12">
                                Contraseña:  
                                </div>
                                <div class="col-e-6 col-m-12">
                                    <input type="password" name="contraseña" value="" required minlength="5">
                                </div>
                            </div>


                            <div class="row padTop padBottom">
                                <div class="col-e-12 centrado ">
                                    <input type="submit" value="Iniciar sesión" name="iniciarSesion" class="botonIS"> 
                                </div>
                            </div>

                            <div class="row padBottom">
                                <div class="col-e-12 centrado">
                                    <p> ¿No tienes cuenta?  <a href="./Vistas/registro.php">Registrarse</a> </p> 
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