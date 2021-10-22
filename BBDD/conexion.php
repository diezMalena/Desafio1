<?php
    require_once (dirname(__DIR__).'/Bitacora/Bitacora.php');
    require_once (dirname(__DIR__).'/Modelo/Persona.php');
    require_once (dirname(__DIR__).'/Modelo/Rol.php');
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

        public function iniciarSesion($email,$contraseña){
            $stmt = $this->conexion->prepare('SELECT * FROM usuario JOIN rol_usuario ON usuario.correo=rol_usuario.correo WHERE usuario.correo=? AND usuario.contraseña=?');
            $persona = null;
            $stmt->bind_param("ss",$email,$contraseña);
            $stmt->execute();
            $result = $stmt->get_result();
            while($fila = $result->fetch_assoc()){
                $this->bitacora->guardarArchivo("Se ha iniciado sesión correctamente.");
                $persona = new Persona($fila["correo"], $fila["nombre"], $fila["apellidos"], $fila["contraseña"], $fila["foto"], $fila["victorias"], $fila["estado"],$fila["activado"], $fila["puntuacion"], $fila["id_rol"]);
            }
            return $persona;
        }

        /**
         * Esta función me devolverá los roles a los que puedo acceder dependiendo de que tipo de usuario sea, administrador o editor.
         */
        public function seleccionarRoles($rol){
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
            return $vectorRoles;
        }


        public function insertarPersona($persona){
            $stmt = $this->conexion->prepare('INSERT INTO usuario VALUES(?,?,?,?,?,?,?,?,?)');
            $stmt2 = $this->conexion->prepare('INSERT INTO rol_usuario VALUES(?,?)');            
            $stmt->bind_param("sssssiiii",$persona->getCorreo(),$persona->getNombre(),$persona->getApellidos(),$persona->getFoto(), $persona->getContraseña(),$persona->getVictorias(),$persona->getEstado(),$persona->getActivado(),$persona->getPuntuacion());
            $stmt2->bind_param("si", $persona->getCorreo(), $persona->getRol());
            $conseguido = false;
            if($stmt->execute() && $stmt2->execute()){
                $conseguido = true;
                $this->bitacora->guardarArchivo("Persona insertada correctamente.");
            }
            return $conseguido;
        }
        

        public function seleccionarCorreos(){
            $stmt = $this->conexion->prepare('SELECT correo FROM usuario');
            $vectorEmail = []; 
            $stmt->execute();
            $result = $stmt->get_result();
            while($fila = $result->fetch_assoc()){
                $vectorEmail[] = $fila;
            } 
            $this->bitacora->guardarArchivo("Emails seleccionados correctamente.");
            return $vectorEmail;
        }

        public function seleccionarUsuarios(){
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
            return $vectorUsuarios;
        }
    }
?>