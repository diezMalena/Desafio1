<?php

    Class Enigma{
        private $id_pregunta;
        private $frase;
        private $vectorOpciones;

        public function __construct($id_pregunta, $frase){
            $this->id_pregunta = $id_pregunta;
            $this->frase = $frase;
            $this->vectorOpciones = [];
        }

        public function getId_pregunta(){
            return $this->id_pregunta;
        }

        public function setId_pregunta($id_pregunta){
            $this->id_pregunta = $id_pregunta;
        }

        public function getFrase(){
            return $this->frase;
        }

        public function setFrase($frase){
            $this->frase = $frase;
        }

        public function getVectorOpciones(){
            return $this->vectorOpciones;
        }

        public function setVectorOpciones($vectorOpciones){
            $this->vectorOpciones = $vectorOpciones;
        }

        
        public function addOpcion($opcion){
            $this->vectorOpciones[] = $opcion;
        }
    }