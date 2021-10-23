<html>
    <head>
        <title>Escape Web</title>
        <script src="Script/validacion.js"></script>
        <link rel="stylesheet" href="../../CSS/general.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Vollkorn:ital,wght@1,500&display=swap">
    </head>

    <body>
        <?php
            require_once '../../BBDD/conexion.php';
            
            session_start();

            if(isset($_SESSION["vectorEnigmas"])){
                $vectorEnigmas = $_SESSION["vectorEnigmas"];
            }
        ?>
        <div class="container">
            <header class="row">
                <div class="col-e-4 col-m-5">
                    <img src="../../Img/Generales/barco.png" class="imgResponsive">
                </div>

                <div class="col-e-6 col-m-6 edicionTitulo">
                    <h1>ESCAPE WEB</h1>
                </div>
            </header>
            

            <section class="row">
                <div class="col-e-12">
                    <?php
                        foreach($vectorEnigmas as $enigma){
                            $cad = '<form action="../../Controlador/controlador_crud.php" method="POST">
                                        ID_Pregunta <input type="text" name="id_pregunta" value="'.$enimga->getId_pregunta().'" readonly>
                                        Frase <input type="text" name="frase" value="'. $enimga->getFrase() .'" readonly>
                                        <input type="submit" name="borrar" value="Borrar">
                                        <input type="submit" name="editar" value="Editar">
                                    </form>';
                            echo $cad;
                        }
                    ?>
                    <a href="../elegirRol.php">Volver</a>
                </div>
                                    
            </section>

            <footer class="row">
                <p class=" col-e-4 col-m-8 izquierda">Creado por Malena Diez</p>
                <p class=" col-e-8 col-m-4 derecha">@Copyright</p>
            </footer>
        </div>        
    </body>
</html>