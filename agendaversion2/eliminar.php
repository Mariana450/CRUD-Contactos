<?php
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

// Conexión a base de datos
$conexion = new mysqli("localhost", "root", "", "agenda1");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener contactos según tipo de usuario
if ($sTipo === 'admin') {
    $sql = "SELECT * FROM contactos";
    $stmt = $conexion->prepare($sql);
} else {
    $sql = "SELECT * FROM contactos WHERE id_usuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_usuario);
}

$stmt->execute();
$contactos = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Contactos</title>
   
   <style> /* Estilo para el cuerpo de la página */
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
    background-color:rgb(22, 15, 221);
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

/* Responsividad */
@media (max-width: 768px) {
    table {
        font-size: 0.85rem;     /* Letra más pequeña */
        width: 95%;
    }

    td, th {
        padding: 4px 6px;       /* Reduce aún más el padding */
    }}

/* Estilo para el mensaje de "No se encontraron resultados" */
h2 {
    color:rgb(15, 15, 15);
}

/* Estilo para el botón */
button {
    background-color:rgb(17, 54, 201);
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    margin-top: 20px;
    font-size: 16px;
}
/* Responsividad en pantallas pequeñas */
@media (max-width: 768px) {
    button {
        width: 100%;            
        font-size: 14px;         
        padding: 12px 16px;      
        margin-top: 15px;
    }
}

button:hover {
    background-color:rgb(30, 54, 231);
}
</style>

    
</head>
<body>

<?php include_once("cabecera.html"); ?>
<?php include_once("menu.php"); ?>
<?php include_once("aside.html"); ?>
<br><br>
<section class="container1">
    <h1>Bienvenido <?php echo htmlspecialchars($sNom); ?></h1>
    <h2>Lista de Contactos</h2>

    <?php if (isset($_GET['mensaje'])): ?>
    <div class="mensaje-exito" id="mensajeExito">
        <span class="cerrar" onclick="cerrarMensaje()">×</span>
        <?php echo htmlspecialchars($_GET['mensaje']); ?>
    </div>
    <?php endif; ?>

    <table class="tabla-contactos" border="1">
        <tr>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th>Acción</th>
        </tr>

        <?php while ($row = $contactos->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row["nombre"]); ?></td>
                <td><?php echo htmlspecialchars($row["direccion"]); ?></td>
                <td><?php echo htmlspecialchars($row["telefono"]); ?></td>
                <td><?php echo htmlspecialchars($row["email"]); ?></td>
                <td>
                    <button onclick="confirmarEliminacion(
                        <?php echo $row['id']; ?>,
                        '<?php echo addslashes($row['nombre']); ?>',
                        '<?php echo addslashes($row['direccion']); ?>',
                        '<?php echo addslashes($row['telefono']); ?>',
                        '<?php echo addslashes($row['email']); ?>'
                    )">Eliminar</button>

                    <a href="modificar.php?
                        id=<?= urlencode($row['id']) ?>
                        &nombre=<?= urlencode($row['nombre']) ?>
                         &direccion=<?= urlencode($row['direccion']) ?>
                        &telefono=<?= urlencode($row['telefono']) ?>
                        &email=<?= urlencode($row['email']) ?>"
                        style="text-decoration: none;">
                        <button style="background-color:rgb(0, 13, 23); color: white;">Modificar</button>
                        </a>


                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <div align="center" style="margin: 20px;">
    <a class="menu" href="insertar.php" style="background-color:rgb(0, 13, 23); color: white;">Insertar</a>
    </div>
        </section>
<br><br>
<?php
$stmt->close();
$conexion->close();
include_once("pie.html");
?>
<script src="js/popup.js"></script>

</body>
</html>
