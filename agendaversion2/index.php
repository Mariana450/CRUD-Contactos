<?php
session_start();

include_once("cabecera.html");
include_once("menu.php");

$mensaje = "";
if (isset($_SESSION['login_error'])) {
    $mensaje = $_SESSION['login_error'];
    unset($_SESSION['login_error']);
}
?>
 
<section class="login-container">
<h2>Iniciar Sesión</h2>
        <form class="login-form" method="POST" action="login.php">
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" required>

            <label for="clave">Clave:</label>
            <input type="password" id="clave" name="clave" required>
        <input type="submit" value="Enviar" />
    </form>

    <?php if (!empty($mensaje)): ?>
        <p style="color:red;"><?php echo htmlspecialchars($mensaje); ?></p>
    <?php endif; ?>
</section>
<br><br><br><br><br><br>



<?php include_once("pie.html"); ?>
