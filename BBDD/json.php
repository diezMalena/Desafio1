<?php

    Class json{
        /**
         * Esta funcion se va a encargar de coger datos de la BBDD y convertirlos
         * a JSON.
         */
        static function convertirDatosJson($arrayJugadores, $jugador, $enigma, $llaves,$primeraRonda){
            $arrayDatos = [
                'jugadores' => $arrayJugadores,
                'jugadorActual' => $jugador,
                'enigma' => $enigma,
                'llaves' => $llaves,
                'primeraRonda' => $primeraRonda
            ];

            return json_encode($arrayDatos);
        }
    }