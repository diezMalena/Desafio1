<?php

    Class Opcion{
        private $id_opcion;
        private $descripcion;
        private $opcion_correcta;

        public function __construct($id_opcion, $descr, $opcion_correcta){
            $this->id_opcion = $id_opcion;
            $this->descripcion = $descr;
            $this->opcion_correcta = $opcion_correcta;
        }

        public function getId_opcion(){
            return $this->id_opcion;
        }

        public function setId_opcion($id_opcion){
            $this->id_opcion = $id_opcion;
        }

        public function getDescripcion(){
            return $this->descripcion;
        }

        public function setDescripcion($desc){
            $this->descripcion = $desc;
        }

        public function getOpcion_correcta(){
            return $this->opcion_correcta;
        }

        public function setVectorOpciones($op_correcta){
            $this->opcion_correcta = $op_correcta;
        }
    }