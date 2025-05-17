<?php
include_once('modelo/agenda.php'); 

session_start();

$sErr = "";
$sNom = "";
$sTipo = "";
$id_usuario = 0;


if (isset($_SESSION["usuario"]) && isset($_SESSION["tipo"]) && isset($_SESSION["id_usuario"])) {
    $sNom = $_SESSION["usuario"];
    $sTipo = $_SESSION["tipo"];
    $id_usuario = $_SESSION["id_usuario"];
} else {
    $sErr = "Debe estar firmado";
}

if ($sErr !== "") {
    header("Location: error.php?sErr=" . urlencode($sErr));
    exit();
}

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "agenda1");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta según tipo de usuario
if ($sTipo === 'admin') {
    $sql = "SELECT * FROM contactos";
    $stmt = $conexion->prepare($sql);
} else {
    $sql = "SELECT * FROM contactos WHERE id_usuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_usuario);
}

$stmt->execute();
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mostrar Contactos - Agenda</title>
    <style>
/* Estilo para el cuerpo de la página */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    color: #333;
    margin: 0;
    padding: 20px;
}

/* Estilo para la tabla */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

/* Estilo para las celdas de la tabla */
td, th {
    padding: 10px;
    text-align: left;
    border: 1px solid #ddd;
}

/* Estilo para los encabezados de la tabla */
th {
    background-color: #4CAF50;
    color: white;
    font-weight: bold;
}

/* Estilo para las filas de la tabla */
tr:nth-child(even) {
    background-color: #f2f2f2;
}

/* Estilo para las filas al pasar el cursor */
tr:hover {
    background-color: #ddd;
}

/* Estilo para el mensaje de "No se encontraron resultados" */
h2 {
    color: #ff6347;
}

/* Estilo para el botón */
button {
    background-color:rgb(12, 29, 174);
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    margin-top: 20px;
    font-size: 16px;
}

button:hover {
    background-color:rgb(23, 17, 208);
}
</style>
    <link rel="stylesheet" href="css/sty.css">
</head>
<body>

    <?php 
        include_once("cabecera.html"); 
        include_once("menu.php");       
        include_once("aside.html"); 
    ?>
    <br><br>
    <section class="container1">
        <h1>Bienvenido <?php echo htmlspecialchars($sNom); ?> </h1>
        <h2>Lista de Contactos</h2>

        <?php if ($resultado->num_rows > 0): ?>
            <table class="tabla-contactos">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($fila = $resultado->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($fila['id']) ?></td>
                            <td><?= htmlspecialchars($fila['nombre']) ?></td>
                            <td><?= htmlspecialchars($fila['telefono']) ?></td>
                            <td><?= htmlspecialchars($fila['email']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No se encontraron contactos.</p>
        <?php endif; ?>
    </section>
    <br><br>
    <?php 
        $stmt->close();
        $conexion->close();
        include_once("pie.html"); 
    ?>
</body>
</html>
