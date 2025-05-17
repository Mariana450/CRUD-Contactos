<?php
session_start();
include_once("cabecera.html");
include_once("menu.php");
include_once("aside.html");
?>
<br><br>
<section class="container1">
<?php
require 'config.php';

if (isset($_GET["Nombre"]) && !empty(trim($_GET["Nombre"]))) {
    $nombreBuscar = trim($_GET["Nombre"]);
    $oMysql = conectarDB();

    $Query = "SELECT * FROM contactos WHERE nombre = ?";
    $stmt = $oMysql->prepare($Query);
    $stmt->bind_param("s", $nombreBuscar);
    $stmt->execute();
    $Result = $stmt->get_result();

    echo "<h2>Resultados de la búsqueda</h2>";

    if ($Result->num_rows == 0) {
        echo "<p>No se encontró ningún contacto con ese nombre.</p>";
    } else {
        echo "<table class='tabla-contactos' border='1'>";
        echo "<thead><tr><th>ID</th><th>Nombre</th><th>Dirección</th><th>Teléfono</th><th>Email</th></tr></thead><tbody>";
        while ($row = $Result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["nombre"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["direccion"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["telefono"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    }

    $stmt->close();
    $oMysql->close();
} else {
    echo "<p>Por favor, ingrese un nombre para buscar.</p>";
}
?>
</section>
<br><br>

<?php include_once("pie.html"); ?>
