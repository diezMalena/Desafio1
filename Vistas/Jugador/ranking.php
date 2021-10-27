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
                <div class="col-e-4 col-m-5">
                    <img src="../../Img/Generales/barco.png" class="imgResponsive">
                </div>

                <div class="col-e-6 col-m-6 edicionTitulo">
                    <h1>ESCAPE WEB</h1>
                </div>
            </header>
            
            <section class="row sectionRanking"> <?php
                foreach($vectorUsuarios as $i => $usuario){
                    if($i % 2 == 0){
                        $cad= '<div class="row">
                                    <div class="colorClaro col-e-6 col-o-12 col-t-12 col-m-12 offset-e-3">
                                        <div class="col-e-3 col-o-12 col-t-12 col-m-12 centrado">
                                            Jugador:
                                        </div>  
                                        <div class="col-e-3 col-o-12 col-t-12 col-m-12">
                                            <input type="text" value="'.$usuario->getCorreo().'">
                                        </div>
                                        <div class="col-e-3 col-o-12 col-t-12 col-m-12 centrado">
                                            Puntuación:
                                        </div>  
                                        <div class="col-e-2 col-o-12 col-t-12 col-m-12">
                                            <input type="text" value="'.$usuario->getPuntuacion().'">
                                        </div>
                                    </div>
                                </div>';
                    }else{
                        $cad='<div class="row">
                                <div class="colorOscuro col-e-6 col-o-12 col-t-12 col-m-12 offset-e-3">
                                    <div class="col-e-3 col-o-12 col-t-12 col-m-12 centrado">
                                        Jugador:
                                    </div>  
                                    <div class="col-e-3 col-o-12 col-t-12 col-m-12">
                                        <input type="text" value="'.$usuario->getCorreo().'">
                                    </div>
                                    <div class="col-e-3 col-o-12 col-t-12 col-m-12 centrado">
                                        Puntuación:
                                    </div>  
                                    <div class="col-e-2 col-o-12 col-t-12 col-m-12">
                                            <input type="text" value="'.$usuario->getPuntuacion().'">
                                    </div>
                                </div>
                            </div>';
                    }
                echo $cad;
                }?>
                <button type="button"><a href="perfilJugador.php">Volver a mi perfil</a></button>
            </section>
                

            <footer class="row">
                <p class=" col-e-4 col-m-8 izquierda">Creado por Malena Diez</p>
                <p class=" col-e-8 col-m-4 derecha">@Copyright</p>
            </footer>
        </div>        
    </body>
</html>