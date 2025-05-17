<?php

function conectarDB() {
    $host = "localhost";
    $usuario = "root";
    $clave = "";
    $baseDeDatos = "agenda1";
    $conexion = new mysqli($host, $usuario, $clave, $baseDeDatos);

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    return $conexion;
}
?>
