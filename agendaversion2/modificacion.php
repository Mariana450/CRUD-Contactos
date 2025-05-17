<?php

include_once("modelo/contacto.php");
include_once("modelo/conexion.php"); 
$conexion = Conexion::conectar(); 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_contacto = $_POST['id_contacto'];
    $nombre = $_POST['NombreNuevo'];
    $direccion = $_POST['Direccion'];
    $telefono = $_POST['Telefono'];
    $email = $_POST['Email'];
    
    session_start();
    $id_usuario = $_SESSION['id_usuario']; 

    $contacto = new Contacto($nombre, $direccion, $telefono, $email, $id_usuario);
    if ($contacto->modificar($conexion, $id_contacto)) {
        header("Location: modificar.php?id=$id_contacto&resultado=exito");
    } else {
        header("Location: modificar.php?id=$id_contacto&resultado=fallo");
    }
} else {
    header("Location: contacto.php");
}
?>
