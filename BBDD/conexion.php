<?php
    require_once (dirname(__DIR__).'/Bitacora/Bitacora.php');
    require_once (dirname(__DIR__).'/Modelo/Persona.php');
    require_once (dirname(__DIR__).'/Modelo/Rol.php');
    require_once (dirname(__DIR__).'/Modelo/Enigma.php');
    require_once (dirname(__DIR__).'/Modelo/Opcion.php');
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
         * Esta función me devolverá los roles a los que puedo acceder dependiendo de que tipo de usuario sea, administrador o editor.
         */
        public function seleccionarRoles($rol){
            $this->conectarBBDD();
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
            $stmt->bind_param("sssssiiii",$persona->getCorreo(),$persona->getNombre(),$persona->getApellidos(),$persona->getFoto(), $persona->getContraseña(),$persona->getVictorias(),$persona->getEstado(),$persona->getActivado(),$persona->getPuntuacion());
            $stmt2->bind_param("si", $persona->getCorreo(), $persona->getRol());
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
            $this->conectarBBDD();
            $this->deleteRol($correo);
            $this->deleteUsuarioEquipo($correo);
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
            $stmt = $this->conexion->prepare('DELETE FROM rol_usuario WHERE correo = ?');
            $stmt->bind_param("s",$correo);
            $stmt->execute();
            $this->bitacora->guardarArchivo("Rol de la persona seleccionada eliminada correctamente.");
        }

        /**
         * Este metodo sirve para borrar el usuario del equipo al que pertenecia.
         */
        public function deleteUsuarioEquipo($correo){
            $stmt = $this->conexion->prepare('DELETE FROM usuario_equipo WHERE correo = ?');
            $stmt->bind_param("s",$correo);
            $stmt->execute();
            $this->bitacora->guardarArchivo("Persona seleccionada eliminada del equipo correctamente.");
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
    }
?>