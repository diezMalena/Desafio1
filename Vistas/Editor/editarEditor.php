<html>
    <head>
        <title>Añadir enigmas</title>
        <link rel="stylesheet" href="../../CSS/general.css">
    </head>
    <body>
        <?php
            require_once '../../Modelo/Enigma.php';
            require_once '../../Modelo/Opcion.php';

            session_start();
            if(isset($_SESSION["enigma"])){
                $enigma = $_SESSION["enigma"];
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
                <div class="col-e-12">
                    <form action="../../Controlador/controlador_editor.php" method="POST" class="col-m-12 col-e-4  padTop padBottom offset-e-4 offset-m-0 ">
                        <fieldset class="padBottom">
                            <legend>Editar enigmas:  </legend>

                            <div class="row">
                                <div class="col-e-3 col-m-12">
                                    ID_pregunta:
                                </div>
                                <div class="col-e-9 col-m-12">
                                    <input class="col-e-12" type="text" name="id_pregunta" value="<?=$enigma->getId_pregunta() ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-e-3 col-m-12">
                                    Frase:
                                </div>
                                <div class="col-e-9 col-m-12">
                                    <input class="col-e-12" type="text" name="frase" value="<?=$enigma->getFrase() ?>">
                                </div>
                            </div>

                            <?php
                                //Recorro todas las opciones del vector donde estan almacenadas para ir colocandolas:
                                $aux = 1;
                                foreach($enigma->getVectorOpciones() as $i => $op){
                                    $cad = '<div class="row">
                                                <div class="col-e-3 col-m-12">
                                                    Opcion '.$aux.':
                                                </div>
                                                <div class="col-e-9 col-m-12">
                                                    <!-- El vector id_op[] almacena los 4 id_opcion de ese enigma -->
                                                    <input type="hidden"  name="id_op[]" value="'.$op->getId_opcion().'">
                                                    <input class="col-e-10" type="text" name="op[]" value="'.$op->getDescripcion().'">';
                                                    if($op->getOpcion_correcta() == 0){ //Si no es la opcion correcta...
                                                        $cad .= '<input type="radio" name="opCorrecta" value="'.$i.'">';
                                                    }else{ //Si es la opcion correcta, lo marcamos con checked:
                                                        $cad .= '<input type="radio" name="opCorrecta" value="'.$i.'" checked>';
                                                    }
                                        $cad .= '</div>
                                            </div>';
                                    $aux++;      
                                    echo $cad;  
                                }
                            ?>
                            
                            <div class="row">
                                <div class="col-e-4 col-m-8 izquierda">
                                    <input type="submit" name="aceptarCambios" value="Aceptar cambios">
                                </div>

                                <div class="col-e-8 col-m-4 derecha">
                                    <button type="button"><a href="crudEditor.php">Volver</a></button>
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