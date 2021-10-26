<html>
    <head>
        <title>Añadir enigmas</title>
        <link rel="stylesheet" href="../../CSS/general.css">
    </head>
    <body>
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
                            <legend>Añadir enigmas:  </legend>
                    
                            <div class="row">
                                <div class="col-e-3 col-m-12">
                                    Frase:
                                </div>
                                <div class="col-e-9 col-m-12">
                                    <input class="col-e-12" type="text" name="frase" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-e-3 col-m-12">
                                    Opcion 1: 
                                </div>
                                <div class="col-e-9 col-m-12">
                                    <input class="col-e-10" type="text" name="op[]" value="" required>
                                    <input type="radio" name="opCorrecta" value="0">
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-e-3 col-m-12">
                                    Opcion 2: 
                                </div>
                                <div class="col-e-9 col-m-12">
                                    <input class="col-e-10" type="text" name="op[]" value="" required>
                                    <input type="radio" name="opCorrecta" value="1">
                                </div>
                            </div>
                           
                            
                            <div class="row">
                                <div class="col-e-3 col-m-12">
                                    Opcion 3: 
                                </div>
                                <div class="col-e-9 col-m-12">
                                    <input class="col-e-10" type="text" name="op[]" value="" required>
                                    <input type="radio" name="opCorrecta" value="2">
                                </div>
                            </div>

                            
                            <div class="row">
                                <div class="col-e-3 col-m-12">
                                    Opcion 4: 
                                </div>
                                <div class="col-e-9 col-m-12">
                                    <input class="col-e-10" type="text" name="op[]" value="" required>
                                    <input type="radio" name="opCorrecta" value="3" required>
                                </div>
                            </div>

                            
                                <br>
                            <div class="row">
                                <div class="col-e-4 col-m-8 izquierda">
                                    <input type="submit" name="añadirEnigma" value="Añadir enigma">
                                </div>

                                <div class="col-e-8 col-m-4 derecha">
                                    <button><a href="crudEditor.php">Volver</a></button>
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