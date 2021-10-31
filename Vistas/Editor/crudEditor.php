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

            <div class="col-e-8 col-m-6 edicionTitulo">
                <h1>ESCAPE WEB</h1>
            </div>
        </header>

        <div class="row sectionEditor alturaDiv">
            <div class="col-e-12">
                <div class="row">
                    <nav class="col-e-6 col-o-8 col-m-12 col-t-12 offset-e-3 offset-o-2 offset-m-0 offset-t-0">
                        <div class="row">
                            <div class="col-e-4 col-o-5 col-m-12 col-t-12">
                                <div class="row">
                                    <a href="añadirEnigmas.php" class="col-e-12 button buttonPrimario">Añadir
                                        enigmas</a>
                                </div>
                            </div>
                            <div class="col-e-4 col-o-3 col-m-12 col-t-12">
                                <div class="row">
                                    <a href="../elegirRol.php" class="col-e-12 button buttonPrimario">Volver</a>
                                </div>
                            </div>
                            <div class="col-e-4 col-o-4 col-m-12 col-t-12">
                                <form action="../../Controlador/registro_IS.php" method="POST">
                                    <div class="row">
                                        <input class="col-e-12 button buttonPrimario" type="submit" name="cerrarSesion"
                                            value="Cerrar sesion"></input>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </nav>
                </div>


                <section class="row">
                    <div class="col-e-12">
                        <?php
                        foreach($vectorEnigmas as $enigma){
                            $cad =  '<div class="row">
                                        <div class="etiquetaEnigma col-e-6 col-o-8 col-m-12 col-t-12 offset-e-3 offset-o-2 offset-m-0 offset-t-0 padTarjeta">
                                            <form action="../../Controlador/controlador_editor.php" method="POST">
                                                <div class="row">
                                                    <div class="col-e-12 col-m-12 col-t-12 col-o-12">
                                                        <div class="row">
                                                            <input class="col-e-12 col-m-12" type="hidden" name="id_pregunta" value="'.$enigma->getId_pregunta().'" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-e-3 col-m-12 col-t-12 col-o-12 padBottom15">
                                                        Frase:
                                                    </div>

                                                    <div class="col-e-9 col-m-12 col-t-12 col-o-12">
                                                        <div class="row">
                                                            <input type="text" class="col-e-12 col-m-12" name="frase" value="'. $enigma->getFrase() .'" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-e-3 col-m-12 col-t-12 col-o-12 padBottom15 padTop15">
                                                        Opciones: 
                                                    </div>
                                                    <div class="col-e-9 col-m-12 col-t-12 padBottom15">
                                                        <select name="opciones">';
                                                            foreach($enigma->getVectorOpciones() as $opcion){
                                                                $cad .= '<option>"'.$opcion->getDescripcion().'"</option>';
                                                            }
                                                            $cad .= '</select>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-e-2 col-m-5 floatIzq">
                                                        <div class="row">
                                                            <input type="submit" class="col-e-12 col-m-12 buttonMini buttonPrimario" name="borrarEnigma" value="Borrar">
                                                        </div>     
                                                    </div>

                                                    <div class="col-e-2 col-m-5 floatDer">
                                                        <div class="row">
                                                            <input type="submit" class="col-e-12 col-m-12 buttonMini buttonPrimario" name="editarEditor" value="Editar">
                                                        </div>    
                                                    </div>
                                                </div>                        
                                            </form>
                                        </div>
                                    </div>';
                                echo $cad;
                        }
                    ?>
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