<?php
session_start();

$conexion = new mysqli("localhost", "root", "", "agenda1");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];

    
    $stmt = $conexion->prepare("SELECT id, usuario, tipo FROM usuario WHERE usuario = ? AND clave = ?");
    $stmt->bind_param("ss", $usuario, $clave);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $fila = $resultado->fetch_assoc();
        $_SESSION['usuario'] = $fila['usuario'];
        $_SESSION['id_usuario'] = $fila['id'];
        $_SESSION['tipo'] = $fila['tipo'];  

        header("Location: eliminar.php");
        exit();
    } else {
        echo "Usuario o clave incorrecta.";
    }

    $stmt->close();
}
$conexion->close();
?>
