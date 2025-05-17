<?php

/*************************************************************/
/* Archivo:  conexion.php
 * Objetivo: Clase para establecer conexión con la base de datos
 * Autor:    
 *************************************************************/

class Conexion {
    public static function conectar() {
        $conexion = new mysqli("localhost", "root", "", "agenda1");
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }
        return $conexion;
    }
}
?>



