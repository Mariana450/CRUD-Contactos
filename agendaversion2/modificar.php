<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Contacto</title>
    <link rel="stylesheet" href="css/sty.css">
    <script src="js/popup.js"></script>
    <script src="js/modificar.js" defer></script>
</head>

<?php include_once('modelo/agenda.php'); ?>

<body>
<?php include_once("cabecera.html"); ?>
<?php include_once("menu.php"); ?>
<?php include_once("aside.html"); ?>
<br><br>

<section class="container1">
    <h1>Buscar y Modificar Contacto</h1>
    <form id="formularioModificar" action="modificacion.php" method="POST" class="formulario">
        <input type="hidden" name="NombreBuscar" value="<?php echo isset($_GET['nombre']) ? htmlspecialchars($_GET['nombre']) : ''; ?>">

        <label for="NombreNuevo">Nombre:</label>
        <input type="text" id="NombreNuevo" name="NombreNuevo" required value="<?php echo isset($_GET['nombre']) ? htmlspecialchars($_GET['nombre']) : ''; ?>">

        <label for="Direccion">Dirección:</label>
        <input type="text" id="Direccion" name="Direccion" required value="<?php echo isset($_GET['direccion']) ? htmlspecialchars($_GET['direccion']) : ''; ?>">

        <label for="Telefono">Teléfono:</label>
        <input type="text" id="Telefono" name="Telefono" required value="<?php echo isset($_GET['telefono']) ? htmlspecialchars($_GET['telefono']) : ''; ?>">

        <label for="Email">Email:</label>
        <input type="email" id="Email" name="Email" required value="<?php echo isset($_GET['email']) ? htmlspecialchars($_GET['email']) : ''; ?>">

        <input type="hidden" name="id_contacto" value="<?php echo htmlspecialchars($_GET['id']); ?>">

        <button type="button" onclick="mostrarConfirmacion()">Modificar Contacto</button>
    </form>

    
    <div id="modalConfirmacion" class="modal">
        <div class="modal-contenido">
            <p>¿Desea guardar esta modificación?</p>
            <button onclick="enviarFormulario()">Aceptar</button>
            <button onclick="cerrarModal('modalConfirmacion')">Cancelar</button>
        </div>
    </div>

  
    <div id="modalResultado" class="modal">
        <div class="modal-contenido">
            <img id="iconoResultado" src="" alt="Icono" width="80">
            <p id="mensajeResultado"></p>
            <button onclick="cerrarModal('modalResultado')">Aceptar</button>
        </div>
    </div>
</section>

<br><br>
<?php include_once("pie.html"); ?>
</body>
</html>
