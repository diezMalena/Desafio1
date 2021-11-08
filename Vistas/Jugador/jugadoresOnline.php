<html>

<head>
    <title>Escape Web</title>
    <link rel="stylesheet" href="../../CSS/general.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Vollkorn:ital,wght@1,500&display=swap">
</head>

<body>
    <?php
            require_once '../../Modelo/Persona.php';
            session_start();
            if(isset($_SESSION["vectorUsuarios"])){
                $vectorUsuarios = $_SESSION["vectorUsuarios"];
            }

        ?>
    <div class="container">
        <header class="row">
            <div class="col-e-4 col-o-3 col-t-3 col-m-5">
                <a href="../../index.php"><img src="../../Img/Generales/barco.png" class="imgResponsive"></a>
            </div>

            <div class="col-e-6 col-o-7 col-t-7 col-m-6 offset-e-1 edicionTitulo">
                <h1>ESCAPE WEB</h1>
            </div>
        </header>



        <div class="row sectionRanking alturaDiv">
            <div class="col-e-6 col-o-6 col-t-12 col-m-12 padTop15 offset-e-3 offset-o-3 offset-t-0 offset-m-0">
                <section class="row fondoRanking padTop">
                    <div class="col-e-12">
                        <?php
                            foreach($vectorUsuarios as $i => $usuario){
                                if($i % 2 == 0){
                                    $cad= '<div class="row padTop">
                                                <div class="colorClaroOnline col-e-6 col-o-8 col-t-10 col-m-10 offset-e-3 offset-m-1 offset-o-2 offset-t-1">
                                                    <div class="row">
                                                        <div class="col-e-1 col-o-1 col-t-1 col-m-1 centrado padBottom15">';
                                                            if($usuario->getEstado() == 0){
                                                                $cad .= '<input type="button" class="desconectado" disabled>';
                                                            }else{
                                                                $cad .= '<input type="button" class="conectado" disabled>';
                                                            }
                                                $cad .= '</div>  
                                                        <div class="col-e-10 col-o-10 col-t-10 col-m-10">
                                                            <div class="row">
                                                                <input type="text" value="'.$usuario->getCorreo().'" class="col-e-12 col-o-12 col-t-12 col-m-12 centrado letraGrande" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>';
                                }else{
                                    $cad ='<div class="row padTop">
                                                <div class="colorOscuroOnline col-e-6 col-o-8 col-t-10 col-m-10 offset-e-3 offset-m-1 offset-o-2 offset-t-1">
                                                    <div class="row">
                                                        <div class="col-e-1 col-o-1 col-t-1 col-m-1 centrado padBottom15">';
                                                            if($usuario->getEstado() == 0){
                                                                $cad .= '<input type="button" class="desconectado" disabled>';
                                                            }else{
                                                                $cad .= '<input type="button" class="conectado" disabled>';
                                                            }
                                                $cad .= '</div>
                                                    <div class="col-e-10 col-o-10 col-t-10 col-m-10">
                                                            <div class="row">
                                                                <input type="text" value="'.$usuario->getCorreo().'" class="col-e-12 col-o-12 col-t-12 col-m-12 centrado letraGrande">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>';
                                }
                                echo $cad;
                            }?>
                        <div class="row padTop padBottom30">
                            <div class="col-e-4 col-o-6 col-t-10 col-m-10 offset-e-4 offset-m-1 offset-o-3 offset-t-1">
                                <div class="row">
                                    <a href="perfilJugador.php" class="col-e-12 col-m-12 button buttonPrimarioVolver">Volver
                                        a mi perfil</a>
                                </div>
                            </div>
                        </div>

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