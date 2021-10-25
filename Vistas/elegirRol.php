<html>
    <head>
        <title>Escape Web</title>
        <script src="Script/validacion.js"></script>
        <link rel="stylesheet" href="../CSS/general.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Vollkorn:ital,wght@1,500&display=swap">
    </head>

    <body>
        <?php
            require_once '../BBDD/conexion.php';
            require_once (dirname(__DIR__).'/Modelo/Rol.php');
            session_start();

            if(isset($_SESSION["vectorRoles"])){
                $vectorRoles = $_SESSION["vectorRoles"];
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
            

            <section class="row sectionIndex">
                <div class="col-e-12">
                    <form action="../Controlador/registro_IS.php" method="POST" class="col-m-12 col-e-3 padTop padBottom offset-e-4 offset-m-0 ">
                        <fieldset class="padBottom centrado fondoFieldset">
                            <legend>Elige tu rol:   </legend>
                                <div class="row">
                                    <div class="col-e-12 col-m-12 padBottom">
                                        <select name="rol">
                                            <?php
                                                foreach($vectorRoles as $rol){
                                                    echo '<option value="'.$rol->getId().'">'.$rol->getNombre().'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-e-6 col-m-12">
                                        <input type="submit" value="Aceptar" name="aceptarRol" class="botonElegirRol"/>
                                    </div>
                                    <div class="col-e-6 col-m-12">
                                        <button type="button" class="botonElegirRol"><a href="../index.php">Volver</a></button>                           
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