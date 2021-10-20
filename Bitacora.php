<?php

/**
 * Description of Bitacora
 * 
 * @author malena
 */
class Bitacora {
    public static $nombre_archivo = "desafio1.txt"; 
 
    public static function guardarArchivo($mensa){
        $file = fopen(self::$nombre_archivo, "a");
        fwrite($file, $mensa . PHP_EOL);
        fclose($file);
    }
    
    public static function leerArchivo(){
        $file = fopen(self::$nombre_archivo, "r");
        while(!feof($file)) {
            echo fgets($file). "<br />";
        }
        fclose($file);
    }   
}