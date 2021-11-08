<?php
    Class Partida{
        private $id_partida;
        private $privacidad;
        private $fecha_inicio;
        private $fecha_fin;
        private $llaves;
        private $contJugadores;

        public function __construct($id_partida = 0, $privacidad = 0, $fecha_inicio = null, $fecha_fin= null, $llaves = 0, $contJugadores = 0){
            $this->id_partida = $id_partida;
            $this->privacidad = $privacidad;
            $this->fecha_inicio = $fecha_inicio;
            $this->fecha_fin = $fecha_fin;
            $this->llaves = $llaves;
            $this->contJugadores = $contJugadores;
        }

        public function getId_partida(){
            return $this->id_partida;
        }

        public function setId_partida($id_partida){
            $this->id_partida = $id_partida;
        }

        public function getprivacidad(){
            return $this->privacidad;
        }

        public function setIprivacidad($privacidad){
            $this->privacidad = $privacidad;
        }

        public function getFecha_inicio(){
            return $this->fecha_inicio;
        }

        public function setFecha_inicio($fecha_inicio){
            $this->fecha_inicio = $fecha_inicio;
        }

        public function getFecha_fin(){
            return $this->fecha_fin;
        }

        public function setFecha_fin($fecha_fin){
            $this->fecha_fin = $fecha_fin;
        }

        public function getLlaves(){
            return $this->llaves;
        }

        public function setLlaves($llaves){
            $this->llaves = $llaves;
        }

        public function getContjugadores(){
            return $this->contJugadores;
        }

        public function setContjugadores($contjugadores){
            $this->contJugadores = $contjugadores;
        }

        public function __toString(){
            return 'Partida: ' .$this->id_partida. ', '.$this->privacidad.', '.$this->fecha_inicio.', '.$this->fecha_fin.', '.$this->llaves.', '.$this->contJugadores.'.';
        }
    }