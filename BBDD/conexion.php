<?php
    require_once (dirname(__DIR__).'/Bitacora/Bitacora.php');
    require_once (dirname(__DIR__).'/Modelo/Persona.php');
    require_once (dirname(__DIR__).'/Modelo/Rol.php');
    require_once (dirname(__DIR__).'/Modelo/Enigma.php');
    require_once (dirname(__DIR__).'/Modelo/Opcion.php');
    require_once (dirname(__DIR__).'/Modelo/Partida.php');
    require_once (dirname(__DIR__).'/Modelo/Historial.php');
    require_once 'constantes.php';
    

    Class Conexion{
        private $servidor;
        private $usuario;
        private $contraseña;
        private $bbdd;
        private $conexion;
        private $bitacora;


        public function __construct(){
            $this->servidor = Constantes::servidor;
            $this->usuario = Constantes::usuario;
            $this->contraseña = Constantes::contraseña;
            $this->bbdd = Constantes::bbdd;
            $this->bitacora = new Bitacora();
        }

        public function conectarBBDD(){
            $this->conexion = new mysqli($this->servidor, $this->usuario, $this->contraseña, $this->bbdd);
            $this->bitacora->guardarArchivo("Conexión a la Base de Datos correcta.");
        }

        public function cerrarBBDD(){
            $this->conexion->close();
            $this->bitacora->guardarArchivo("Conexion a la Base de Datos cerrada correctamente.");
        }

        public function iniciarSesion($email,$contraseña){
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('SELECT * FROM usuario JOIN rol_usuario ON usuario.correo=rol_usuario.correo WHERE usuario.correo=? AND usuario.contraseña=?');
            $persona = null;
            $stmt->bind_param("ss",$email,$contraseña);
            $stmt->execute();
            $result = $stmt->get_result();
            while($fila = $result->fetch_assoc()){
                $this->bitacora->guardarArchivo("Se ha iniciado sesión correctamente.");
                $persona = new Persona($fila["correo"], $fila["nombre"], $fila["apellidos"], $fila["contraseña"], $fila["foto"], $fila["victorias"], $fila["estado"],$fila["activado"], $fila["puntuacion"], $fila["id_rol"]);
            }
            $stmt->close();
            $this->cerrarBBDD();
            return $persona;
        }

        /**
         * Esta función me devolverá los roles a los que puedo acceder dependiendo 
         * de que tipo de usuario sea, administrador o editor.
         */
        public function seleccionarRoles($rol){
            $this->conectarBBDD();
            //La select me devuelve los roles que estan por debajo o igual al rol de la persona que inicia sesion:
            $stmt = $this->conexion->prepare('SELECT * FROM rol WHERE id_rol <= ?');
            $stmt->bind_param("i", $rol);
            $vectorRoles = [];
            $stmt->execute();
            $result = $stmt->get_result();
            while($fila = $result->fetch_assoc()){
                $rol = new Rol($fila["id_rol"], $fila["nombre"]);
                $vectorRoles[] = $rol; 
                $this->bitacora->guardarArchivo('Roles seleccionados correctamente.');
            }
            $stmt->close();
            $this->cerrarBBDD();
            return $vectorRoles;
        }


        public function insertarPersona($persona){
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('INSERT INTO usuario VALUES(?,?,?,?,?,?,?,?,?)');
            $stmt2 = $this->conexion->prepare('INSERT INTO rol_usuario VALUES(?,?)');
            $correo = $persona->getCorreo();  
            $nombre = $persona->getNombre();
            $ape = $persona->getApellidos();
            $contra = $persona->getContraseña();
            $foto = $persona->getFoto();
            $victorias = $persona->getVictorias();
            $estado = $persona->getEstado();
            $act = $persona->getActivado();
            $punt = $persona->getPuntuacion();
            $rol = $persona->getRol();
            $stmt->bind_param("sssssiiii", $correo,$nombre,$ape,$contra,$foto,$victorias,$estado, $act,$punt);
            $stmt2->bind_param("si", $correo, $rol); //El rol por defecto es 0 (usuario estandar)
            $conseguido = false;
            if($stmt->execute() && $stmt2->execute()){
                $conseguido = true;
                $this->bitacora->guardarArchivo("Persona insertada correctamente.");
            }
            $stmt->close();
            $this->cerrarBBDD();
            return $conseguido;
        }
        

        public function seleccionarCorreos(){
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('SELECT correo FROM usuario');
            $vectorEmail = []; 
            $stmt->execute();
            $result = $stmt->get_result();
            while($fila = $result->fetch_assoc()){
                $vectorEmail[] = $fila;
            } 
            $stmt->close();
            $this->cerrarBBDD();
            $this->bitacora->guardarArchivo("Emails seleccionados correctamente.");
            return $vectorEmail;
        }

        public function seleccionarUsuarios(){
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('SELECT * FROM usuario JOIN rol_usuario ON usuario.correo=rol_usuario.correo');
            $persona = null;
            $vectorUsuarios = [];
            $stmt->execute();
            $result = $stmt->get_result();
            while($fila = $result->fetch_assoc()){
                $this->bitacora->guardarArchivo("Usuarios recogidos correctamente.");
                $persona = new Persona($fila["correo"], $fila["nombre"], $fila["apellidos"], $fila["contraseña"], $fila["foto"], $fila["victorias"], $fila["estado"],$fila["activado"], $fila["puntuacion"], $fila["id_rol"]);
                $vectorUsuarios[] = $persona;
            }
            $stmt->close();
            $this->cerrarBBDD();
            return $vectorUsuarios;
        }

        public function cogerCorreo($correo){
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('SELECT correo FROM usuario WHERE correo = ?');
            $persona = null;
            $stmt->bind_param("s",$correo);
            $stmt->execute();
            $result = $stmt->get_result();
            while($fila = $result->fetch_assoc()){
                $this->bitacora->guardarArchivo("Usuarios recogidos correctamente.");
                $correo = $fila["correo"];
            }
            $stmt->close();
            $this->cerrarBBDD();
            return $correo;
        }


        public function seleccionarEnigmas(){
            $this->conectarBBDD();
            //Cojo los enigmas:
            $stmt = $this->conexion->prepare('SELECT * FROM enigma_pregunta');
            $enigma = null;
            $opcion = null;
            $vectorEnigmas = [];
            $stmt->execute();
            $result = $stmt->get_result();
            while($fila = $result->fetch_assoc()){
                $enigma = new Enigma($fila["id_pregunta"], $fila["frase"]);
                //Cojo el enigma y le meto sus opciones:
                $enigma = $this->recogerOpciones($enigma);
                //El enigma con sus opciones y sus datos lo meto en un vectorEnigmas que me recoge todos los que tenga la BBDD:
                $vectorEnigmas[] = $enigma;
            }
            $stmt->close();
            $this->cerrarBBDD();
            $this->bitacora->guardarArchivo("Enigmas con sus opciones recogidos correctamente.");
            return $vectorEnigmas;
        }

        public function recogerOpciones($enigma){
            $stmt = $this->conexion->prepare('SELECT * FROM enigma_opcion WHERE id_pregunta = ?');
            $stmt->bind_param("i", $enigma->getId_pregunta());
            $stmt->execute();
            $result = $stmt->get_result();
            while($fila = $result->fetch_assoc()){
                $opcion = new Opcion($fila["id_opcion"], $fila["descripcion"],$fila["opcion_correcta"]);
                //Cojo cada opcion de ese enigma y lo meto dentro del vectorOpciones de la clase Enigma...
                $enigma->addOpcion($opcion);
            }
            //Devuelvo el enigma con sus opciones en el vector interno de su clase.
            return $enigma;
        }


        public function deleteUsuario($correo){
            $this->deleteRol($correo);
            $this->deleteUsuarioPartida($correo);
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('DELETE FROM usuario WHERE correo = ?');
            $stmt->bind_param("s",$correo);
            $stmt->execute();

            $stmt->close();
            $this->cerrarBBDD();
            $this->bitacora->guardarArchivo("Persona eliminada correctamente.");
        }

        /**
         * Este metodo sirve para borrar el rol que tenia asignada la persona con ese correo.
         */
        public function deleteRol($correo){
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('DELETE FROM rol_usuario WHERE correo = ?');
            $stmt->bind_param("s",$correo);
            $stmt->execute();
            $this->bitacora->guardarArchivo("Rol de la persona seleccionada eliminada correctamente.");
            $this->cerrarBBDD();
        }

        /**
         * Este metodo sirve para borrar el usuario de la partida al que pertenecia.
         */
        public function deleteUsuarioPartida($correo){
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('DELETE FROM usuario_partida WHERE correo = ?');
            $stmt->bind_param("s",$correo);
            $stmt->execute();
            $this->bitacora->guardarArchivo("Persona seleccionada eliminada de la partida correctamente.");
            $this->cerrarBBDD();
        }

        public function cogerUsuario($correo){
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('SELECT * FROM usuario JOIN rol_usuario ON usuario.correo=rol_usuario.correo WHERE usuario.correo = ?');
            $stmt->bind_param("s",$correo);
            $persona = null;
            $stmt->execute();
            $result = $stmt->get_result();
            while($fila = $result->fetch_assoc()){
                $persona = new Persona($fila["correo"], $fila["nombre"], $fila["apellidos"], $fila["contraseña"], $fila["foto"], $fila["victorias"], $fila["estado"],$fila["activado"], $fila["puntuacion"], $fila["id_rol"]);
            }
            $stmt->close();
            $this->cerrarBBDD();
            $this->bitacora->guardarArchivo("Persona seleccionada y lista para editar.");
            return $persona;
        }

        public function insertarGestor($rol, $persona){
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('INSERT INTO usuario VALUES(?,?,?,?,?,?,?,?,?)');
            $stmt2 = $this->conexion->prepare('INSERT INTO rol_usuario VALUES(?,?)');            
            $stmt->bind_param("sssssiiii",$persona->getCorreo(),$persona->getNombre(),$persona->getApellidos(),$persona->getFoto(), $persona->getContraseña(),$persona->getVictorias(),$persona->getEstado(),$persona->getActivado(),$persona->getPuntuacion());
            $stmt2->bind_param("si", $persona->getCorreo(), $rol);
            $conseguido = false;
            if($stmt->execute() && $stmt2->execute()){
                $conseguido = true;
                $this->bitacora->guardarArchivo("Gestor insertado correctamente.");
            }
            $stmt->close();
            $stmt2->close();
            $this->cerrarBBDD();
            return $conseguido;
        }

        public function updatePersonaSinContra($persona){
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('UPDATE usuario SET correo = ?, nombre = ?, apellidos = ?, foto = ?, victorias = ?, estado = ?, activado = ?, puntuacion = ? WHERE correo = "'.$persona->getCorreo().'"');
            $stmt->bind_param("ssssiiii",$persona->getCorreo(),$persona->getNombre(),$persona->getApellidos(),$persona->getFoto(), $persona->getVictorias(),$persona->getEstado(),$persona->getActivado(),$persona->getPuntuacion());
            $stmt->execute();
            $stmt->close();
            $this->cerrarBBDD();
            $this->bitacora->guardarArchivo("Persona actualizada correctamente.");
        }

        public function updatePersona($persona){
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('UPDATE usuario SET correo = ?, nombre = ?, apellidos = ?, contraseña = ?, foto = ? WHERE correo = "'.$persona->getCorreo().'"');
            $stmt->bind_param("sssss",$persona->getCorreo(),$persona->getNombre(),$persona->getApellidos(), $persona->getContraseña(), $persona->getFoto());
            $stmt->execute();
            $stmt->close();
            $this->cerrarBBDD();
            $this->bitacora->guardarArchivo("Persona actualizada correctamente.");
        }


        public function añadirEnigma($frase, $opciones, $opCorrecta){
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('INSERT INTO enigma_pregunta VALUES (null,?)');
            $stmt->bind_param("s", $frase);
            $stmt->execute();
            $stmt->close();
            //Ahora vamos a añadirle las opciones a la tabla enigma_opcion:
            $this->cerrarBBDD();
            $this->añadirOpciones($opciones, $opCorrecta);
        }


        public function añadirOpciones($opciones, $opCorrecta){
            $ultimoId = $this->ultimoId_Pregunta();
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('INSERT INTO enigma_opcion VALUES (null,?,?,?)');
            foreach($opciones as $i => $op){ 
                //Si la opcion[i] tiene el radio button marcado, en la BBDD pondremos un 1 para saber que es la correcta:
                $correcta = 0;
                if($i == $opCorrecta){
                    $correcta = 1;
                }
                $stmt->bind_param("isi", $ultimoId, $op, $correcta);
                $stmt->execute();
            }
            $this->cerrarBBDD();
        }

        /**
         * Con este método recogemos el ultimo id_pregunta que ha sido usado para poder usarlo en la insercion de la otra tabla:
         */
        public function ultimoId_Pregunta(){
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('SELECT max(id_pregunta) AS ultimoId FROM enigma_pregunta');
            $stmt->execute();
            $result = $stmt->get_result();
            while($fila = $result->fetch_assoc()){
                $ultimoId = $fila["ultimoId"];
            }
            $this->cerrarBBDD();
            return $ultimoId;
        }

        public function cogerEnigma($id_pregunta){
            $this->conectarBBDD();
            //Cojo los enigmas:
            $stmt = $this->conexion->prepare('SELECT * FROM enigma_pregunta WHERE id_pregunta = ?');
            $stmt->bind_param("i", $id_pregunta);
            $enigma = null;
            $opcion = null;
            $stmt->execute();
            $result = $stmt->get_result();
            while($fila = $result->fetch_assoc()){
                $enigma = new Enigma($fila["id_pregunta"], $fila["frase"]);
                //Cojo el enigma y le meto sus opciones:
                $enigma = $this->recogerOpciones($enigma);
            }
            $stmt->close();
            $this->cerrarBBDD();
            $this->bitacora->guardarArchivo("Enigmas con sus opciones recogidos correctamente.");
            return $enigma;
        }

        public function editarEnigma($id_pregunta, $frase, $vectorId_opciones, $vectorOpciones, $opcionCorrecta){
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('UPDATE enigma_pregunta SET frase = ? WHERE id_pregunta = ?');
            $stmt->bind_param("si", $frase, $id_pregunta);
            $stmt->execute();
            $stmt->close();
            $this->editarOpcionesEnigma($vectorId_opciones, $vectorOpciones, $opcionCorrecta);
            $this->cerrarBBDD();
            $this->bitacora->guardarArchivo("Enigma actualizado correctamente.");
        }

        public function editarOpcionesEnigma($vectorId_opciones, $opciones, $opcionCorrecta){
            $stmt = $this->conexion->prepare('UPDATE enigma_opcion SET descripcion = ?, opcion_correcta = ? WHERE id_opcion = ?');
            //Opciones es el vector de 4 opciones, i es 0,1,2,3 y op es los valores de 0,1,2 y 3
            foreach($opciones as $i => $op){ 
                //Si la opcion[i] tiene el radio button marcado, en la BBDD pondremos un 1 para saber que es la correcta:
                $correcta = 0;
                if($i == $opcionCorrecta){
                    $correcta = 1;
                }
                //op es el valor que tienen 0, 1, 2 y 3, correcta es 0 o 1 y vectorId_opciones[$i] es el id_opcion de 0, de 1, de 2 y de 3.
                //Es decir, id_opcion19[0], id_opcion20[1]...
                $stmt->bind_param("sii", $op, $correcta, $vectorId_opciones[$i]);
                $stmt->execute();
            }
        }

        public function deleteEnigma($id_pregunta){
            $this->deleteOpciones($id_pregunta);
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('DELETE FROM enigma_pregunta WHERE id_pregunta = ?');
            $stmt->bind_param("i",$id_pregunta);
            $stmt->execute();
            $this->bitacora->guardarArchivo("Enigma correspondiente eliminado correctamente.");
            $this->cerrarBBDD();
        }

        public function deleteOpciones($id_pregunta){
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('DELETE FROM enigma_opcion WHERE id_pregunta = ?');
            $stmt->bind_param("i",$id_pregunta);
            $stmt->execute();
            $this->bitacora->guardarArchivo("Opciones del enigma correspondiente eliminadas correctamente.");
            $this->cerrarBBDD();
        }

        public function updateContraseña($correo, $contraseña){
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('UPDATE usuario SET contraseña = ? WHERE correo = ?');
            $stmt->bind_param("ss",$contraseña,$correo);
            $stmt->execute();
            $stmt->close();
            $this->cerrarBBDD();
            $this->bitacora->guardarArchivo("Contraseña actualizada correctamente.");
        }

        public function verificarCorreo($correo){
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('UPDATE usuario SET activado = ? WHERE correo = ?');
            $activado = 1;
            $stmt->bind_param("is",$activado,$correo);
            $stmt->execute();
            $stmt->close();
            $this->cerrarBBDD();
            $this->bitacora->guardarArchivo("Usuario activado correctamente.");
        }

        public function seleccionarUsuariosRanking(){
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('SELECT correo, puntuacion FROM usuario  ORDER BY puntuacion DESC');
            $persona = null;
            $vectorUsuarios = [];
            $stmt->execute();
            $result = $stmt->get_result();
            while($fila = $result->fetch_assoc()){
                $this->bitacora->guardarArchivo("Usuarios recogidos correctamente.");
                //Tenemos el objeto Persona con correo y puntuación:
                $persona = new Persona($fila["correo"], null, null,null, null, null, null,null, $fila["puntuacion"], null);
                $vectorUsuarios[] = $persona;
            }
            $stmt->close();
            $this->cerrarBBDD();
            return $vectorUsuarios;
        }

        public function seleccionarUsuariosEstado(){
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('SELECT correo, estado FROM usuario');
            $persona = null;
            $vectorUsuarios = [];
            $stmt->execute();
            $result = $stmt->get_result();
            while($fila = $result->fetch_assoc()){
                $this->bitacora->guardarArchivo("Usuarios recogidos correctamente.");
                //Tenemos el objeto Persona con correo y puntuación:
                $persona = new Persona($fila["correo"], null, null, null, null, null, $fila["estado"],null, null);
                $vectorUsuarios[] = $persona;
            }
            $stmt->close();
            $this->cerrarBBDD();
            return $vectorUsuarios;
        }

        public function usuarioConectado($correo){
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('UPDATE usuario SET estado = ? WHERE correo = ?');
            $estado = 1;
            $stmt->bind_param("is",$estado,$correo);
            $stmt->execute();
            $stmt->close();
            $this->cerrarBBDD();
            $this->bitacora->guardarArchivo("Usuario ".$correo." conectado.");
        }

        public function usuarioDesconectado($correo){
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('UPDATE usuario SET estado = ? WHERE correo = ?');
            $estado = 0;
            $stmt->bind_param("is",$estado,$correo);
            $stmt->execute();
            $stmt->close();
            $this->cerrarBBDD();
            $this->bitacora->guardarArchivo("Usuario ".$correo." desconectado.");
        }


        public function recogerPartidas(){
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('SELECT partida.id_partida, partida.privacidad, partida.fecha_inicio, partida.fecha_fin, partida.llaves, count(usuario_partida.id_partida) AS contJugadores
                    FROM partida LEFT JOIN usuario_partida ON partida.id_partida = usuario_partida.id_partida WHERE partida.terminada = 0 AND partida.privacidad = 0 GROUP BY partida.id_partida');        
            $vectorPartida = [];
            $partida = null;
            $stmt->execute();
            $result = $stmt->get_result();
            while($fila = $result->fetch_assoc()){
                $this->bitacora->guardarArchivo("Partidas recogidas correctamente.");
                $partida = new Partida($fila["id_partida"], $fila["privacidad"], $fila["fecha_inicio"], $fila["fecha_fin"], $fila["llaves"], $fila["contJugadores"]);
                if($partida->getContjugadores() < 5){
                    $vectorPartida[] = $partida;
                }
            }
            $stmt->close();
            $this->cerrarBBDD();
            return $vectorPartida;
        }


        public function cuantosJugadores($id_partida){
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('SELECT count(*) AS cuantosJugadores FROM usuario_partida WHERE id_partida = ?');
            $stmt->bind_param("i",$id_partida);
            $cuantosJugadores = 0;
            $stmt->execute();
            $result = $stmt->get_result();
            while($fila = $result->fetch_assoc()){
                $cuantosJugadores = $fila["cuantosJugadores"];
            }
            $stmt->close();
            $this->cerrarBBDD();
            return $cuantosJugadores;
        }

        public function addJugadorPartida($id_partida, $correo){
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('INSERT INTO usuario_partida VALUES (?,?,0,0,0,0)');
            $stmt->bind_param("is",$id_partida, $correo);
            $stmt->execute();
            $stmt->close();
            $this->cerrarBBDD();
        }

        public function salirPartida($Correo, $id_partida){
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('DELETE FROM usuario_partida WHERE id_partida = ? AND correo = ?');
            $stmt->bind_param("is",$id_partida, $Correo);
            $stmt->execute();
            $this->bitacora->guardarArchivo("Persona eliminada de la partida correctamente.");
            $this->cerrarBBDD();
        }

        public function existePartida($id_partida){
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('SELECT *  FROM partida WHERE id_partida = ?');
            $stmt->bind_param("i",$id_partida);
            $existe = false;
            $stmt->execute();
            $result = $stmt->get_result();
            while($fila = $result->fetch_assoc()){
                $existe = true;
            }
            $stmt->close();
            $this->cerrarBBDD();
            return $existe;
        }

        public function crearPartida($id_partida, $privada){
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('INSERT INTO partida VALUES (?,?,null,null,0,0)');
            $stmt->bind_param("ii",$id_partida, $privada);
            $stmt->execute();
            $stmt->close();
            $this->cerrarBBDD();
        }

        //-------------------------------------------------------------EMPIEZA LO DIFICIL-----------------------------------------------------------------------

        public function cogerJugadoresPartida($id_partida){
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('SELECT *  FROM usuario_partida WHERE id_partida = ?');
            $stmt->bind_param("i",$id_partida);
            $vectorJugadores = [];
            $stmt->execute();
            $result = $stmt->get_result();
            while($fila = $result->fetch_assoc()){
                //dentro del vector habrá otro vector por cada jugador, es decir 5 vectores dentro de vectorJugadores:
                $vectorJugadores[] = ['correo' => $fila["correo"], 'almirante' =>$fila["almirante"], 'puede_responder' => $fila["puede_responder"], 'vetado' => $fila["vetado"],'fallos' => $fila["fallos"]];
            }
            $stmt->close();
            $this->cerrarBBDD();
            return $vectorJugadores;
        }

        public function seleccionarEnigmaAlea(){
            $this->conectarBBDD();
            //Cogemos un enigma aleatorio:
            $stmt = $this->conexion->prepare('SELECT * FROM enigma_pregunta ORDER BY rand() LIMIT 1');
            $arrayEnigma = [];
            $opcion = null;
            $stmt->execute();
            $result = $stmt->get_result();
            while($fila = $result->fetch_assoc()){
                //Esta primera posicion del array sera para la pregunta
                $arrayEnigma['pregunta'] = $fila["frase"];
                //La segunda posicion será el id_pregunta
                $arrayEnigma['id_pregunta'] = $fila["id_pregunta"];
                //La tercera posicion serán las 4 respuestas posibles
                $arrayEnigma['respuestas'] = $this->recogerOpcionesEnigmaAlea($fila["id_pregunta"]);
            }
            $stmt->close();
            $this->cerrarBBDD();
            $this->bitacora->guardarArchivo("Enigmas con sus opciones recogidos correctamente.");
            return $arrayEnigma;
        }

        

        public function recogerOpcionesEnigmaAlea($id_pregunta){
            $stmt = $this->conexion->prepare('SELECT * FROM enigma_opcion WHERE id_pregunta = ?');
            $stmt->bind_param("i", $id_pregunta);
            $stmt->execute();
            $result = $stmt->get_result();
            $vectorRespuestas = [];
            while($fila = $result->fetch_assoc()){
                $vectorRespuestas[] = ['id_opcion' => $fila["id_opcion"], 'descripcion' => $fila["descripcion"],'opcion_correcta'=>$fila["opcion_correcta"]];
            }
            return $vectorRespuestas;
        }

        public function hacerAlmirante($correo){
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('UPDATE usuario_partida SET almirante = 1 WHERE correo = ?');
            $stmt->bind_param("s",$correo);
            $stmt->execute();
            $stmt->close();
            $this->cerrarBBDD();
            $this->bitacora->guardarArchivo("Usuario ".$correo." convertido a Almirante.");
        }

        public function hayAlmirantes($id_partida){
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('SELECT *  FROM usuario_partida WHERE id_partida = ? AND almirante = 1');
            $stmt->bind_param("i",$id_partida);
            $ya_hay = false;
            $stmt->execute();
            $result = $stmt->get_result();
            while($fila = $result->fetch_assoc()){
                $ya_hay = true;
            }
            $stmt->close();
            $this->cerrarBBDD();
            return $ya_hay;
        }

        public function sumarPunto($correo, $puntuacion){
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('UPDATE usuario SET puntuacion = ? WHERE correo = ?');
            $stmt->bind_param("is",$puntuacion,$correo);
            $stmt->execute();
            $stmt->close();
            $this->cerrarBBDD();
            $this->bitacora->guardarArchivo("Sumado un punto al jugador ".$correo.".");
        }

        public function sumarLlave($id_partida, $llave){
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('UPDATE partida SET llaves = ? WHERE id_partida = ?');
            $stmt->bind_param("ii",$llave,$id_partida);
            $stmt->execute();
            $stmt->close();
            $this->cerrarBBDD();
            $this->bitacora->guardarArchivo("Sumado una llave a la partida ".$id_partida.".");
        }

        public function cuantasLlaves($id_partida){
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('SELECT llaves  FROM partida WHERE id_partida = ?');
            $stmt->bind_param("i",$id_partida);
            $cuantas = 0;
            $stmt->execute();
            $result = $stmt->get_result();
            while($fila = $result->fetch_assoc()){
                $cuantas = $fila["llaves"];
            }
            $stmt->close();
            $this->cerrarBBDD();
            return $cuantas;
        }

        public function cuantosFallosPersona($correo,$id_partida){
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('SELECT fallos FROM usuario_partida WHERE id_partida = ? AND correo = ?');
            $stmt->bind_param("is",$id_partida, $correo);
            $cuantos = 0;
            $stmt->execute();
            $result = $stmt->get_result();
            while($fila = $result->fetch_assoc()){
                $cuantos = $fila["fallos"];
            }
            $stmt->close();
            $this->cerrarBBDD();
            return $cuantos;
        }

        public function sumarFallo($correo, $id_partida, $fallosJugador){
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('UPDATE usuario_partida SET fallos = ? WHERE id_partida = ? AND correo = ?');
            $stmt->bind_param("iis",$fallosJugador,$id_partida, $correo);
            $stmt->execute();
            $stmt->close();
            $this->cerrarBBDD();
            $this->bitacora->guardarArchivo("Sumado una llave a la partida ".$id_partida.".");
        }

        public function insertarPreguntaAux($id_partida, $id_pregunta){
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('INSERT INTO enigma_aux VALUES (?,?)');
            $stmt->bind_param("ii",$id_partida, $id_pregunta);
            $stmt->execute();
            $stmt->close();
            $this->cerrarBBDD();
        }

        public function borrarPregunta($id_partida){
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('DELETE FROM enigma_aux WHERE id_partida = ?');
            $stmt->bind_param("i",$id_partida);
            $stmt->execute();
            $this->bitacora->guardarArchivo("Pregunta eliminada de la aux correctamente.");
            $this->cerrarBBDD();
        }

        public function cogerPreguntaAux($id_partida){
            $this->conectarBBDD();
            //Cogemos un enigma aleatorio:
            $stmt = $this->conexion->prepare('SELECT enigma_pregunta.id_pregunta AS id_pregunta, enigma_pregunta.frase AS frase FROM enigma_pregunta JOIN enigma_aux ON enigma_pregunta.id_pregunta = enigma_aux.id_pregunta WHERE enigma_aux.id_partida = ?');
            $stmt->bind_param("i",$id_partida);
            $arrayEnigma = [];
            $opcion = null;
            $stmt->execute();
            $result = $stmt->get_result();
            while($fila = $result->fetch_assoc()){
                //Esta primera posicion del array sera para la pregunta
                $arrayEnigma['pregunta'] = $fila["frase"];
                //La segunda posicion será el id_pregunta
                $arrayEnigma['id_pregunta'] = $fila["id_pregunta"];
                //La tercera posicion serán las 4 respuestas posibles
                $arrayEnigma['respuestas'] = $this->recogerOpcionesEnigmaAlea($fila["id_pregunta"]);
            }
            $stmt->close();
            $this->cerrarBBDD();
            $this->bitacora->guardarArchivo("Enigmas con sus opciones recogidos correctamente.");
            return $arrayEnigma;
        }

        public function cambiarPuedeResponder($correo, $puedeResponder, $id_partida){
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('UPDATE usuario_partida SET puede_responder = ? WHERE id_partida = ? AND correo = ?');
            $stmt->bind_param("iis",$puedeResponder,$id_partida, $correo);
            $stmt->execute();
            $stmt->close();
            $this->cerrarBBDD();
            $this->bitacora->guardarArchivo('El jugador'.$correo.' ahora puede responder.');
        }

        public function actualizarFechaFinPartida($id_partida){
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('UPDATE partida SET fecha_fin = now() WHERE id_partida = ?');
            $stmt->bind_param("i",$id_partida);
            $stmt->execute();
            $stmt->close();
            $this->cerrarBBDD();
            $this->bitacora->guardarArchivo('Fecha fin actualizada con exito.');
        }

        public function seleccionarFechaInicio($id_partida){
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('SELECT fecha_inicio FROM partida WHERE id_partida = ?');
            $stmt->bind_param("i",$id_partida);
            $fecha_inicio = 0;
            $stmt->execute();
            $result = $stmt->get_result();
            while($fila = $result->fetch_assoc()){
                $fecha_inicio = $fila["fecha_inicio"];
            }
            $stmt->close();
            $this->cerrarBBDD();
            return $fecha_inicio;
        }

        public function seleccionarFechaFin($id_partida){
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('SELECT fecha_fin FROM partida WHERE id_partida = ?');
            $stmt->bind_param("i",$id_partida);
            $fecha_fin = 0;
            $stmt->execute();
            $result = $stmt->get_result();
            while($fila = $result->fetch_assoc()){
                $fecha_fin = $fila["fecha_fin"];
            }
            $stmt->close();
            $this->cerrarBBDD();
            return $fecha_fin;
        }

        public function crearHistorial($id_partida,$llaves,$horaInicio,$horaFin,$jugadores){
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('INSERT INTO historial VALUES (null,?,?,?,?,?)');
            $stmt->bind_param("iisss",$id_partida,$llaves,$horaInicio,$horaFin,$jugadores);
            $stmt->execute();
            $stmt->close();
            $this->cerrarBBDD();
        }

        public function cogerHistorial($id_partida){
            $this->conectarBBDD();
            $stmt = $this->conexion->prepare('SELECT * FROM historial WHERE id_partida = ?');
            $stmt->bind_param("i",$id_partida);
            $historial = null;
            $stmt->execute();
            $result = $stmt->get_result();
            while($fila = $result->fetch_assoc()){
                $historial = new Historial($fila["id_historial"], $fila["id_partida"],$fila["llaves"],$fila["hora_inicio"],$fila["hora_fin"],$fila["usuarios"]);
            }
            $stmt->close();
            $this->cerrarBBDD();
            return $historial;
        }
    }

    