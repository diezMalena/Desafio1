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
            <label for="mail">
                <span>E-mail:</span>
                <input type="email" id="mail" required minlength="5">
                <span class="error" aria-live="polite"></span>
            </label> <br><br>
            Nombre  <input type="text" name="nombre" value="" required> <br><br>
            Apellidos  <input type="text" name="apellidos" value="" required> <br><br>
            Foto <input type="text" name="foto" value=""> <br><br>
            Contraseña <input type="password" name="contraseña" value="" required> <br><br>
            Repite la contraseña <input type="password" name="contraseña2" value="" required> <br><br>

            <input type="submit" name="registrar" value="Registrarse">
            <button><a href="index.php">Volver</a></button>
        </form>
    </body>
</html>