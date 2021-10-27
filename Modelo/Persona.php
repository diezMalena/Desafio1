<?php 
class Persona{
    private $correo;
    private $nombre;
    private $apellidos;
    private $contraseña;
    private $foto;
    private $victorias;
    private $estado;
    private $activado;
    private $puntuacion;
    private $rol;


    function __construct($correo = "", $nombre = "", $apellidos = "", $contraseña = "", $foto = "", $victorias = 0, $estado = 0, $activado = 0, $puntuacion = 0, $rol = 0) {
        $this->correo = $correo;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->contraseña = $contraseña;
        $this->foto = $foto;
        $this->victorias = $victorias;
        $this->estado = $estado;
        $this->activado = $activado;
        $this->puntuacion = $puntuacion;
        $this->rol = $rol;
    }

    function __toString(){
        return 'Correo: ' .$this->correo. ', Nombre: '.$this->nombre. ', Apellidos: ' .$this->apellidos. ', Contraseña: '.$this->contraseña.', Foto: '.$this->foto.', Vcitorias: '.$this->victorias. ', Estado: '.$this->estado.', Activado: '.$this->activado.', Puntuación: '.$this->puntuacion. ', Rol:' .$this->rol. '.';
    }

    function getNombre() {
        return $this->nombre;
    }

    function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    function getCorreo() {
        return $this->correo;
    }

    function setCorreo($email): void {
        $this->correo = $email;
    }

    function getContraseña() {
        return $this->contraseña;
    }


    function setContraseña($contraseña): void {
        $this->contraseña = $contraseña;
    }

    function getApellidos(){
        return $this->apellidos;
    }

    function setApellidos($apellidos){
        $this->apellidos = $apellidos;
    }

    function getRol() {
        return $this->rol;
    }

    function setRol($rol): void {
        $this->rol = $rol;
    }

    function getVictorias() {
        return $this->victorias;
    }

    function setVictorias($victorias): void {
        $this->victorias = $victorias;
    }

    function getPuntuacion() {
        return $this->puntuacion;
    }

    function setPuntuacion($puntos): void {
        $this->puntuacion = $puntos;
    }

    function getFoto(){
        return $this->foto;
    }

    function setFoto($foto){
        $this->foto = $foto;
    }

    function getEstado(){
        return $this->estado;
    }

    function setEstado($estado){
        $this->estado = $estado;
    }

    function getActivado(){
        return $this->activado;
    }

    function setActivado($activado){
        $this->activado = $activado;
    }
}
?>