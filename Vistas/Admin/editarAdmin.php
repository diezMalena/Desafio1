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
            if(isset($_SESSION["usuario"])){
                $usuario = $_SESSION["usuario"];
            }

        ?>
    <div class="container">
        <header class="row">
            <div class="col-e-4 col-m-5">
                <a href="../../index.php"><img src="../../Img/Generales/barco.png" class="imgResponsive"></a>
            </div>

            <div class="col-e-8 col-m-6 edicionTitulo">
                <h1>ESCAPE WEB</h1>
            </div>
        </header>


        <div class="row sectionAdmin alturaDiv">
            <div class="col-e-12">
                <section class="row">
                    <div
                        class="col-m-12 col-e-4 col-t-12 col-o-8 padTop padBottom offset-e-4 offset-m-0 offset-t-0 offset-o-2">
                        <form action="../../Controlador/controlador_crud.php" method="POST">
                            <fieldset class="padBottom">
                                <legend>Editar usuario: </legend>
                                <div class="row padBottom15">
                                    <div class="col-e-3 col-m-4 col-t-4 col-o-4">
                                        Correo:
                                    </div>

                                    <div class="col-e-9 col-m-8 col-t-8 col-o-8">
                                        <div class="row">
                                            <input type="text" class="col-e-12" name="correo"
                                                value="<?=$usuario->getCorreo() ?>" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="row padBottom15">
                                    <div class="col-e-3 col-m-4 col-t-4 col-o-4">
                                        Nombre:
                                    </div>

                                    <div class="col-e-9 col-m-8 col-t-8 col-o-8">
                                        <div class="row">
                                            <input type="text" class="col-e-12" name="nombre"
                                                value="<?= $usuario->getNombre() ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row padBottom15">
                                    <div class="col-e-3 col-m-4 col-t-4 col-o-4">
                                        Apelllidos:
                                    </div>

                                    <div class="col-e-9 col-m-8 col-t-8 col-o-8">
                                        <div class="row">
                                            <input type="text" class="col-e-12" name="apellidos"
                                                value="<?= $usuario->getApellidos() ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row padBottom15">
                                    <div class="col-e-3 col-m-4 col-t-4 col-o-4">
                                        Foto:
                                    </div>
                                    <div class="col-e-9 col-m-8 col-t-8 col-o-8">
                                        <div class="row">
                                            <input type="text" class="col-e-12" name="foto"
                                                value="<?= $usuario->getFoto()?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row padBottom15">
                                    <div class="col-e-3 col-m-4 col-t-4 col-o-4">
                                        Victorias:
                                    </div>
                                    <div class="col-e-9 col-m-8 col-t-8 col-o-8">
                                        <div class="row">
                                            <input type="text" class="col-e-12" name="victorias"
                                                value="<?= $usuario->getVictorias()?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row padBottom15">
                                    <div class="col-e-3 col-m-4 col-t-4 col-o-4">
                                        Estado:
                                    </div>
                                    <div class="col-e-9 col-m-8 col-t-8 col-o-8">
                                        <div class="row">
                                        <select name="activado">
                                                <?php 
                                                    if($usuario->getEstado() == 0){
                                                        echo '<option value="0" selected>Desconectado</option>
                                                            <option value="1">Conectado</option>';
                                                    }else{
                                                        echo '<option value="0">Desconectado</option>
                                                            <option value="1" selected>Conectado</option>';
                                                    }
                                                ?> 
                                            </select>
                                        </div>

                                    </div>
                                </div>

                                <div class="row padBottom15">
                                    <div class="col-e-3 col-m-4 col-t-4 col-o-4">
                                        Activado:
                                    </div>
                                    <div class="col-e-9 col-m-8 col-t-8 col-o-8">
                                        <div class="row">
                                            <select name="activado">
                                                <?php 
                                                    if($usuario->getActivado() == 0){
                                                        echo '<option value="0" selected>Desactivado</option>
                                                            <option value="1">Activado</option>';
                                                    }else{
                                                        echo '<option value="0">Desactivado</option>
                                                            <option value="1" selected>Activado</option>';
                                                    }
                                                ?> 
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row padBottom15">
                                    <div class="col-e-3 col-m-4 col-t-4 col-o-4">
                                        Puntuacion:
                                    </div>
                                    <div class="col-e-9 col-m-8 col-t-8 col-o-8">
                                        <div class="row">
                                            <input type="text" class="col-e-12" name="puntuacion"
                                                value="<?=$usuario->getPuntuacion() ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row padBottom15">
                                    <div class="col-e-3 col-m-4 col-t-4 col-o-4">
                                        Rol:
                                    </div>
                                    <div class="col-e-9 col-m-8 col-t-8 col-o-8">
                                        <div class="row">
                                            <input type="text" class="col-e-12" name="rol"
                                                value="<?=$usuario->getRol() ?>" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="row padBottom15">
                                    <div class="col-e-4 col-m-5 floatIzq">
                                        <div class="row">
                                            <input type="submit" class="col-e-12 col-m-12 buttonMini buttonPrimario"
                                                name="aceptarCambios" value="Aceptar cambios">
                                        </div>
                                    </div>

                                    <div class="col-e-2 col-m-5 floatDer">
                                        <div class="row">
                                            <a href="crudAdmin.php"
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