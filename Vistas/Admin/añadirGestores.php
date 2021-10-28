<html>
    <head>
        <title>Registrarse</title>
        <link rel="stylesheet" href="../../CSS/general.css">
    </head>
    <body>
        <?php
            session_start();
            if(isset($_SESSION["mensajeError"])){
                echo $_SESSION["mensajeError"];
                unset($_SESSION["mensajeError"]);
            }
        ?>
        <div class="container">
            <header class="row">
                <div class="col-e-4 col-m-5">
                    <img src="../../Img/Generales/barco.png" class="imgResponsive">
                </div>

                <div class="col-e-6 col-m-8 offset-e-1 edicionTitulo">
                    <h1>ESCAPE WEB</h1>
                </div>
            </header>

            <section class="row sectionAdmin">
                <div class="col-e-12">
                    <form action="../../Controlador/controlador_crud.php" method="POST" class="col-m-12 col-e-4  padTop padBottom offset-e-4 offset-m-0 ">
                        <fieldset class="padBottom">
                            <legend>Añadir gestores:  </legend>
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
                                <div class="row">
                                    <div class="col-e-6 col-m-12">
                                        Rol: 
                                    </div>
                                    <div class="col-e-6 col-m-12">
                                        <select name="rol">
                                            <option value="1">Editor</option>
                                            <option value="2">Administrador</option>
                                        </select>
                                    </div>
                                </div>  
                                <div class="row">
                                    <div class="col-e-6 col-m-12 padTop">
                                        <input type="submit" name="añadirGestor" value="Añadir">
                                    </div>

                                    <div class="col-e-6 col-m-12 padTop">
                                        <button><a href="crudAdmin.php">Volver</a></button>
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