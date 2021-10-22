<html>
    <head>
        <title>Registrarse</title>
        <script src="Script/validacion.js"></script>
        <link rel="stylesheet" href="./CSS/general.css">
    </head>
    <body onload="validarEmail()">
        <?php
            session_start();
            if(isset($_SESSION["mensajeError"])){?>
            <div class="alert alert-danger">
                <?php
                echo $_SESSION["mensajeError"];
                ?>
            </div>
            <?php
                unset($_SESSION["mensajeError"]);
            }
        ?>
        <div class="container">
            <header class="row">
                <div class="col-e-4 col-m-5">
                    <img src="./Img/Generales/barco.png" class="imgResponsive">
                </div>

                <div class="col-e-6 col-m-6 centrado">
                    <h1>ESCAPE WEB</h1>
                </div>
            </header>

            <section class="row">
                <div class="col-e-12">
                    <form action="./Controlador/registro_IS.php" method="POST" class="col-m-12 col-e-4  padTop padBottom offset-e-4 offset-m-0 ">
                        <fieldset class="padBottom">
                            <legend>Registro:  </legend>
                                <button class="tooltip">?
                                    <span class="tooltiptext">
                                        <p>
                                            ¡Regístrate y podrás disfrutar del mejor Escape Web!
                                            Más de 15.000 enigmas por adivinar... ¿A qué esperas?
                                            <br>¡Únete a nosotros!
                                        </p>
                                    </span>
                                </button>
                    
                            <div class="row">
                                <div class="col-e-6 col-m-12">
                                    <label for="mail" novalidate>
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
                                    Nombre: 
                                </div>
                                <div class="col-e-6 col-m-12">
                                    <input type="text" name="nombre" value="" required>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-e-6 col-m-12">
                                    Apellidos:  
                                </div>
                                <div class="col-e-6 col-m-12">
                                    <input type="text" name="apellidos" value="" required>
                                </div>
                            </div>
                           
                            
                            <div class="row">
                                <div class="col-e-6 col-m-12">
                                    Foto: 
                                </div>
                                <div class="col-e-6 col-m-12">
                                    <input type="text" name="foto" value="">
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
                            <div class="row">
                                <div class="col-e-6 col-m-12">
                                    Repite la contraseña: 
                                </div>
                                <div class="col-e-6 col-m-12">
                                    <input type="password" name="contraseña2" value="" required minlength="5">
                                </div>
                            </div>  
                                <br>
                            <div class="row">
                                <div class="col-e-6 col-m-12">
                                    <input type="submit" name="registrar" value="Registrarse">
                                </div>

                                <div class="col-e-6 col-m-12">
                                    <button><a href="index.php">Volver</a></button>
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