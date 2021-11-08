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
            <div class="col-e-4 col-o-3 col-t-3 col-m-5">
                <a href="../index.php"><img src="../Img/Generales/barco.png" class="imgResponsive"></a>
            </div>

            <div class="col-e-6 col-o-7 col-t-7 col-m-6 offset-e-1 edicionTitulo">
                <h1>ESCAPE WEB</h1>
            </div>
        </header>

        <div class="row sectionRanking alturaDiv">
            <div class="col-e-12">
                <section class="row">
                    <div class="col-m-12 col-e-4 col-t-8 col-o-8 padTop padBottom offset-e-4 offset-m-0 offset-t-2 offset-o-2">
                        <form action="../Controlador/registro_IS.php" method="POST">
                            <fieldset class="padBottom centrado fondoFieldsetUsuario">
                                <legend>Elige tu rol: </legend>
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
                                    <div class="col-e-5 col-m-5 col-t-5 col-o-5 floatIzq">
                                        <div class="row">
                                            <input type="submit" value="Aceptar" name="aceptarRol"
                                                class="col-e-12 button buttonPrimario" />
                                        </div>
                                    </div>
                                    <div class="col-e-5 col-m-5 col-t-5 col-o-5 floatDer">
                                        <div class="row">
                                            <a href="../index.php" class="col-e-12 button buttonPrimario">Volver</a>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </section>
            </div>
        </div>


        <footer class="row">
            <p class=" col-e-4 col-m-8 izquierda">Creado por Malena Diez</p>
            <p class=" col-e-8 col-m-4 derecha">@Copyright</p>
        </footer>
    </div>
</body>

</html>