<html>

<head>
    <title>Añadir enigmas</title>
    <script src='https://www.google.com/recaptcha/api.js?render=6Lc2AAodAAAAAFynKlvUXb95G2U8H3tRJH3wm29P'></script>
    <script src="../../Script/recaptcha.js"></script>
    <link rel="stylesheet" href="../../CSS/general.css">
</head>

<body>
    <div class="container">
        <header class="row">
            <div class="col-e-4 col-o-3 col-t-3 col-m-5">
                <a href="../../index.php"><img src="../../Img/Generales/barco.png" class="imgResponsive"></a>
            </div>

            <div class="col-e-6 col-o-7 col-t-7 col-m-6 offset-e-1 edicionTitulo">
                <h1>ESCAPE WEB</h1>
            </div>
        </header>

        <div class="row sectionEditor alturaDiv">
            <div class="col-e-12">
                <section class="row">
                    <div
                        class="col-e-6 col-o-10 col-t-10 col-m-12  padTop padBottom offset-e-3 offset-o-1 offset-t-1 offset-m-0">
                        <form action="../../Controlador/controlador_editor.php" method="POST">
                            <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
                            <fieldset class="padBottom">
                                <legend>Añadir enigmas: </legend>
                                <div class="row">
                                    <div class="col-e-3 col-m-12 col-o-12 col-t-12 padBottom15">
                                        Frase:
                                    </div>
                                    <div class="col-e-9 col-m-12 col-o-12 col-t-12">
                                        <div class="row">
                                            <input class="col-e-12" type="text" name="frase" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-e-3 col-m-12 col-o-12 col-t-12 padBottom15">
                                        Opcion 1:
                                    </div>
                                    <div class="col-e-9 col-m-12 col-o-12 col-t-12">
                                        <div class="row">
                                            <input class="col-e-10" type="text" name="op[]" value="" required>
                                            <input type="radio" name="opCorrecta" value="0">
                                        </div>

                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-e-3 col-m-12 col-o-12 col-t-12 padBottom15">
                                        Opcion 2:
                                    </div>
                                    <div class="col-e-9 col-m-12 col-o-12 col-t-12">
                                        <div class="row">
                                            <input class="col-e-10" type="text" name="op[]" value="" required>
                                            <input type="radio" name="opCorrecta" value="1">
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-e-3 col-m-12 col-o-12 col-t-12 padBottom15">
                                        Opcion 3:
                                    </div>
                                    <div class="col-e-9 col-m-12 col-o-12 col-t-12">
                                        <div class="row">
                                            <input class="col-e-10" type="text" name="op[]" value="" required>
                                            <input type="radio" name="opCorrecta" value="2">
                                        </div>

                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-e-3 col-m-12 col-o-12 col-t-12 padBottom15">
                                        Opcion 4:
                                    </div>
                                    <div class="col-e-9 col-m-12 col-o-12 col-t-12">
                                        <div class="row">
                                            <input class="col-e-10" type="text" name="op[]" value="" required>
                                            <input type="radio" name="opCorrecta" value="3" required>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-e-12 centrado error">
                                        <?php
                                            if(isset($_SESSION["mensajeCaptcha"])){
                                                echo $_SESSION["mensajeCaptcha"];
                                                unset($_SESSION["mensajeCaptcha"]);
                                            }
                                        ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-e-2 col-o-5 col-m-5 col-t-5 floatIzq padTop15">
                                        <div class="row">
                                            <input type="submit" name="añadirEnigma"
                                                class="col-e-12 col-m-12 buttonMini buttonPrimario"
                                                value="Añadir enigma">
                                        </div>
                                    </div>

                                    <div class="col-e-2 col-o-5 col-m-5 col-t-5 floatDer padTop15">
                                        <div class="row">
                                            <a href="crudEditor.php"
                                                class="col-e-12 col-m-12 buttonMini buttonPrimarioVolver">Volver</a>
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