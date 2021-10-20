<html>
    <head>
        <title>Desafío 1</title>
    </head>
    <body>
        <?php
            /*require_once 'conexion.php';
            session_start();
            if(isset($_SESSION["mensajeError"])){
                echo $_SESSION["mensajeError"];
                unset($_SESSION["mensajeError"]);
            }*/
        ?>
        
        <form action="controlador.php" method="post">
            Introduce tu e-mail:  <input type="text" name="usuario" value="" required><br><br>
            Introduce tu contraseña:  <input type="password" name="contraseña" value="" required><br><br>
            <input type="submit" value="Iniciar sesión" name="iniciarSesion">
        </form>
        <a href="registro.php">Registrarse</a>      
        <a href="olvideContraseña.php">He olvidado la contraseña</a>
    </body>
</html>