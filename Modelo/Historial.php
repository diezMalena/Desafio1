<?php

    Class Historial{
        private $id_historial;
        private $id_partida;
        private $llaves;
        private $horaInicio;
        private $horaFin;
        private $usuarios;

        public function __construct($id_historial,$id_partida, $llaves, $horaInicio,$horaFin,$usuarios){
            $this->id_historial = $id_historial;
            $this->id_partida =$id_partida;
            $this->llaves = $llaves;
            $this->horaInicio = $horaInicio;
            $this->horaFin = $horaFin;
            $this->usuarios = $usuarios;
        }

       

        public function getId_partida()
        {
                return $this->id_partida;
        }
 
        public function setId_partida($id_partida)
        {
                $this->id_partida = $id_partida;

                return $this;
        }

        public function getLlaves()
        {
                return $this->llaves;
        }


        public function setLlaves($llaves)
        {
                $this->llaves = $llaves;

                return $this;
        }

        public function getHoraInicio()
        {
                return $this->horaInicio;
        }


        public function setHoraInicio($horaInicio)
        {
                $this->horaInicio = $horaInicio;

                return $this;
        }

        public function getHoraFin()
        {
                return $this->horaFin;
        }


        public function setHoraFin($horaFin)
        {
                $this->horaFin = $horaFin;

                return $this;
        }

  
        public function getUsuarios()
        {
                return $this->usuarios;
        }


        public function setUsuarios($usuarios)
        {
                $this->usuarios = $usuarios;

                return $this;
        }

        public function getId_historial()
        {
                return $this->id_historial;
        }

        public function setId_historial($id_historial)
        {
                $this->id_historial = $id_historial;

                return $this;
        }
    }