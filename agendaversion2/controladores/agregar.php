<?php
include_once('../modelo/agenda.php');

$nombre = $_POST['Nombre'] ?? '';
$direccion = $_POST['Direccion'] ?? '';
$telefono = $_POST['Telefono'] ?? '';
$email = $_POST['Email'] ?? '';

if (Agenda::insertar($nombre, $direccion, $telefono, $email)) {
    echo 'exito';
} else {
    echo 'error';
}
?>
