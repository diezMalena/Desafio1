<?php
    require_once 'Persona.php';
    require_once 'Bitacora.php';

    Class Conexion{
        private $servidor;
        private $usuario;
        private $contraseña;
        private $bbdd;
        private $conexion;
        private $bitacora;

        public function __construct(){
            $this->servidor = "Localhost";
            $this->usuario = "Malena";
            $this->contraseña = "Chubaca2020";
            $this->bbdd = "desafio1";
            $this->bitacora = new Bitacora();
        }

        public function conectarBBDD(){
            $this->conexion = new mysqli($this->servidor, $this->usuario, $this->contraseña, $this->bbdd);
            $this->bitacora->guardarArchivo("Conexión a la Base de Datos correcta.");
        }

        public function iniciarSesion($email,$contraseña){
            $stmt = $this->conexion->prepare('SELECT * FROM personas WHERE Email = ? AND Contraseña = ?');
            $persona = null;
            $stmt->bind_param("ss",$email,$contraseña);
            $stmt->execute();
            $result = $stmt->get_result();
            while($fila = $result->fetch_assoc()){
                $this->bitacora->guardarArchivo("Se ha iniciado sesión correctamente.");
                $persona = new Persona($fila["correo"], $fila["nombre"], $fila["apellidos"], $fila["contraseña"], $fila["foto"], $fila["victorias"], $fila["estado"],$fila["activado"], $fila["puntuacion"], $fila["rol"]);
            }
            return $persona;
        }


        public function insertarPersona($persona){
            $stmt = $this->conexion->prepare('INSERT INTO usuario VALUES(?,?,?,?,?,?,?,?,?,?)');
            $stmt2 = $this->conexion->prepare('INSERT INTO rol_usuario VALUES(?,?)');            
            $stmt->bind_param("sssiis",$persona->getCorreo(),$persona->getNombre(),$persona->getApellidos(),$persona->getContraseña(),$persona->getFoto(),$persona->getVictorias(),$persona->getEstado(),$persona->getActivado(),$persona->getPuntuacion());
            $stmt2->bind_param("si", $persona->getCorreo(), $persona->getRol());
            $conseguido = false;
            if($stmt->execute() && $stmt2->execute()){
                $conseguido = true;
                $this->bitacora->guardarArchivo("Persona insertada correctamente.");
            }
            return $conseguido;
        }
        

    }
?>