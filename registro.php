<html>
    <head>
        <title>Registrarse</title>
        <script src="Script/validacion.js"></script>
    </head>
    <body onload="validarEmail()">
        <?php
            session_start();
            if(isset($_SESSION["mensajeError"])){
                echo $_SESSION["mensajeError"];
                unset($_SESSION["mensajeError"]);
            }
        ?>
        
        <form action="./Controlador/registro_IS.php">
            <!--El atributo novalidate sirve para no enviar el formulario -->
            <label for="mail" novalidate>
                <span>E-mail:</span>
                <input type="email" name="correo" id="mail" required minlength="5">
                <span class="error" aria-live="polite"></span>
            </label> <br><br>
            Nombre  <input type="text" name="nombre" value="" required> <br><br>
            Apellidos  <input type="text" name="apellidos" value="" required> <br><br>
            Foto <input type="text" name="foto" value=""> <br><br>
            Contraseña <input type="password" name="contraseña" value="" required minlength="5"> <br><br>
            Repite la contraseña <input type="password" name="contraseña2" value="" required minlength="5"> <br><br>

            <input type="submit" name="registrar" value="Registrarse">
            <button><a href="index.php">Volver</a></button>
        </form>
    </body>
</html>