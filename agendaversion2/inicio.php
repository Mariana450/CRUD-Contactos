<?php

session_start();

$sErr = "";
$sNom = "";
$sTipo = "";

if (isset($_SESSION["usuario"]) && isset($_SESSION["tipo"])) {
    $sNom = $_SESSION["usuario"];
    $sTipo = $_SESSION["tipo"];    
} else {
    $sErr = "Debe estar firmado";
}

if ($sErr !== "") {
    header("Location: error.php?sErr=" . urlencode($sErr));
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio - Agenda</title>
    <link rel="stylesheet" href="css/sty.css">
</head>
<body>

    <?php 
        include_once("cabecera.html"); 
        include_once("menu.php");      
        include_once("aside.html"); 
    ?>

    <section class="container1">
        <h1>Bienvenido <?php echo htmlspecialchars($sNom); ?> (<?php echo htmlspecialchars($sTipo); ?>)</h1>

        
    </section>

    <?php include_once("pie.html"); ?>
</body>
</html>
