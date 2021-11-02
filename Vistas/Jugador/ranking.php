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
                <img src="../../Img/Generales/barco.png" class="imgResponsive">
            </div>

            <div class="col-e-6 col-o-7 col-t-7 col-m-6 offset-e-1 edicionTitulo">
                <h1>ESCAPE WEB</h1>
            </div>
        </header>

        <div class="row sectionRanking alturaDiv">
            <div class="col-e-12">
                <section class="row">
                    <div class="col-e-12">
                        <?php
                            foreach($vectorUsuarios as $i => $usuario){
                                if($i % 2 == 0){
                                    $cad= '<div class="row padBottom15">
                                                <div class="colorClaro col-e-6 col-o-6 col-t-8 col-m-8 offset-e-3 offset-o-3 offset-t-2 offset-m-2">
                                                    <div class="row padTop15 padBottom15">
                                                        <div class="col-e-3 col-o-4 col-t-4 col-m-4 centrado">
                                                            Jugador:
                                                        </div>
                                                        <div class="col-e-3 col-o-8 col-t-8 col-m-8">
                                                            <input type="text" value="'.$usuario->getCorreo().'">
                                                        </div>
                                                    
                                                        <div class="col-e-3 col-o-4 col-t-4 col-m-4 centrado">
                                                            Puntuación:
                                                        </div>  
                                                        <div class="col-e-2 col-o-8 col-t-8 col-m-8">
                                                            <input type="text" value="'.$usuario->getPuntuacion().' puntos">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>';
                                }else{
                                    $cad='<div class="row padBottom15">
                                            <div class="colorOscuro col-e-6 col-o-6 col-t-8 col-m-8 offset-e-3 offset-o-3 offset-t-2 offset-m-2">
                                                <div class="row padTop15 padBottom15">
                                                    <div class="col-e-3 col-o-4 col-t-4 col-m-4 centrado">
                                                        Jugador:
                                                    </div>  
                                                    <div class="col-e-3 col-o-8 col-t-8 col-m-8">
                                                        <input type="text" value="'.$usuario->getCorreo().'">
                                                    </div>
                                                
                                                    <div class="col-e-3 col-o-4 col-t-4 col-m-4 centrado">
                                                        Puntuación:
                                                    </div>  
                                                    <div class="col-e-2 col-o-8 col-t-8 col-m-8">
                                                        <input type="text" value="'.$usuario->getPuntuacion().' puntos">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                                }
                            echo $cad;
                            }?>
                                <div class="row padTop padBottom30">
                                    <div class="col-e-2 col-o-4 col-t-10 col-m-8 offset-e-5 offset-m-1 offset-o-4 offset-t-1 offset-m-2">
                                        <div class="row">
                                            <a href="perfilJugador.php" class="col-e-12 col-m-12 button buttonSecundario">Volver a mi perfil</a>
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