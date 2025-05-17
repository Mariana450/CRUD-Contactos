<nav>
  
<?php if (isset($_SESSION['usuario'])): ?>
    <div class="menu-principal">
        <a class="menu" href="buscar.php">Buscar</a>
        <a class="menu" href="mostrar.php">Consultar</a>
        <a class="menu" href="insertar.php">Insertar</a>
        <a class="menu" href="eliminar.php">Contactos</a>
        <a class="menu" href="logout.php">Cerrar sesión</a>
    </div>
<?php else: ?>
    <p>No has iniciado sesión.</p>
<?php endif; ?>

</nav>
