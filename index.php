<html>
    <head>
        <title>Escape Web</title>
        <script src="Script/validacion.js"></script>
        <link rel="stylesheet" href="./CSS/general.css">
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
                <img src="" alt="">
                </div>
            </header>
        
            <form action="./Controlador/registro_IS.php" method="post">
                <label for="mail">
                    <span>E-mail:</span>
                    <input type="email" name="correo" id="mail" required minlength="5">
                    <span class="error" aria-live="polite"></span>
                </label> <br><br>
                
                Contraseña  <input type="password" name="contraseña" value="" required minlength="5"><br><br>
                <input type="submit" value="Iniciar sesión" name="iniciarSesion">
            </form>
            <a href="registro.php">Registrarse</a>      
            <a href="olvideContraseña.php">He olvidado la contraseña</a>
        </div>        
    </body>
</html>