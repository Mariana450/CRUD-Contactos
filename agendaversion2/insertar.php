<?php
session_start();

if (!isset($_SESSION['usuario']) || !isset($_SESSION['id_usuario'])) {
    echo "Usuario no identificado.";
    exit;
}

$mensaje = "";

$conexion = new mysqli("localhost", "root", "", "agenda1");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $telefono = trim($_POST['telefono']);
    $email = trim($_POST['email']);
    $direccion = trim($_POST['direccion']);
    $id_usuario = $_SESSION['id_usuario'];

    $stmt = $conexion->prepare("INSERT INTO contactos (nombre, direccion, telefono, email, id_usuario) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $nombre, $direccion, $telefono, $email, $id_usuario);

    if ($stmt->execute()) {
        $mensaje = "Contacto insertado correctamente.";
    } else {
        $mensaje = "Error al insertar: " . htmlspecialchars($stmt->error);
    }

    $stmt->close();
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Insertar Contacto - Agenda</title>
    <link rel="stylesheet" href="css/sty.css">
</head>
<body>

<?php
    include_once 'cabecera.html';
    include_once 'menu.php';
    include_once 'aside.html';
?>

<section class="container1">
    <h2>Nuevo contacto</h2>

    <!-- Formulario -->
    <form method="POST" class="formulario-contacto">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" placeholder="Nombre" required><br>

        <label for="direccion">Dirección:</label><br>
        <input type="text" id="direccion" name="direccion" placeholder="Dirección" required><br>

        <label for="telefono">Teléfono:</label><br>
        <input type="text" id="telefono" name="telefono" placeholder="Teléfono" required><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" placeholder="Email" required><br>

        <input type="submit" value="Insertar">
    </form>
</section>

<?php include_once 'pie.html'; ?>

<?php if (!empty($mensaje) && strpos($mensaje, 'insertado correctamente') !== false): ?>
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            mostrarPopup(`
                <img src="img/happy.jpeg" style="max-width: 100px; display: block; margin: 0 auto;">
                <h3>¡Contacto añadido con éxito!</h3>
                <p><?= htmlspecialchars($mensaje) ?></p>
            `, 'mostrar.php');
        });
    </script>
<?php endif; ?>

<script src="js/popup.js"></script>
</body>
</html>
