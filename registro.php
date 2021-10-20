<html>
    <head>
        <title>Registrarse</title>
    </head>
    <body>
        <?php
            session_start();
            if(isset($_SESSION["mensajeError"])){
                echo $_SESSION["mensajeError"];
                unset($_SESSION["mensajeError"]);
            }
        ?>
        
        <form action="controlador.php">
            E-mail  <input type="text" name="correo" value="" required> <br><br>
            Nombre  <input type="text" name="nombre" value="" required> <br><br>
            Apellidos  <input type="text" name="apellidos" value="" required> <br><br>
            Foto <input type="text" name="foto" value=""> <br><br>
            Contraseña <input type="password" name="contraseña" value="" required> <br><br>
            Repite la contraseña <input type="password" name="contraseña2" value="" required> <br><br>
            <fieldset>
                <input type="radio" name="rol" value="admin" required>Admin
                <input type="radio" name="rol" value="user" required>User
            </fieldset>
            <input type="submit" name="registrar" value="Registrarse">
            <button><a href="index.php">Volver</a></button>
        </form>
    </body>
</html>