<html>
    <head>
        <title>Escape Web</title>
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
            

            <section class="row sectionEditor">
                <div class="row offset-e-3 padTop">
                    <div class="col-e-4 col-m-12 col-t-12">
                        <button><a href="añadirEnigmas.php">Añadir enigmas</a></button>
                    </div>

                    <div class="col-e-4 col-m-12 col-t-12">
                        <button><a href="../elegirRol.php">Volver</a></button>
                    </div>

                    <div class="col-e-4 col-m-12 col-t-12">
                        <form action="../../Controlador/registro_IS.php" method="post">
                            <input type="submit" value="Cerrar sesion" name="cerrarSesion">
                        </form>
                    </div>
                </div>
                <div class="col-e-11 offset-e-1">
                    <?php
                        foreach($vectorEnigmas as $enigma){
                            $cad =  '<div class="etiquetaEnigma col-e-5 col-m-12 padTarjeta marginTarjeta">
                                        <form action="../../Controlador/controlador_editor.php" method="POST">
                                            <div class="row">
                                                <div class="col-e-3 col-m-12 col-t-12">
                                                    ID_Pregunta:
                                                </div>

                                                <div class="col-e-9 col-m-12 col-t-12">
                                                    <input class="col-e-12 col-m-12" type="text" name="id_pregunta" value="'.$enigma->getId_pregunta().'" readonly>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-e-3 col-m-12 col-t-12">
                                                    Frase:
                                                </div>

                                                <div class="col-e-9 col-m-12 col-t-12">
                                                    <input type="text" class="col-e-12 col-m-12" name="frase" value="'. $enigma->getFrase() .'" readonly>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-e-3 col-m-12 col-t-12">
                                                    Opciones: 
                                                </div>
                                                <div class="col-e-9 col-m-12 col-t-12">
                                                    <select name="opciones">';
                                                        foreach($enigma->getVectorOpciones() as $opcion){
                                                            $cad .= '<option>"'.$opcion->getDescripcion().'"</option>';
                                                        }
                                                        $cad .= '</select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-e-4 col-m-8 izquierda">
                                                    <input type="submit" name="borrar" value="Borrar">
                                                </div>

                                                <div class="col-e-8 col-m-4 derecha">
                                                    <input type="submit" name="editarEditor" value="Editar">
                                                </div>
                                            </div>                        
                                        </form>
                                    </div>';
                                echo $cad;
                        }
                    ?>   
                </div>
            </section>

            <footer class="row">
                <p class=" col-e-4 col-m-8 izquierda">Creado por Malena Diez</p>
                <p class=" col-e-8 col-m-4 derecha">@Copyright</p>
            </footer>
        </div>        
    </body>
</html>