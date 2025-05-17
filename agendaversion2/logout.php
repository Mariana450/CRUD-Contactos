<?php
session_start(); // Inicia o reanuda la sesión
session_unset(); // Elimina todas las variables de sesión
session_destroy(); // Destruye la sesión


header("Location: index.php");
exit();
?>
