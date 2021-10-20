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

    }
?>