function mostrarConfirmacion() {
    document.getElementById('modalConfirmacion').style.display = 'block';
}

function cerrarModal(id) {
    document.getElementById(id).style.display = 'none';
}

function enviarFormulario() {
    cerrarModal('modalConfirmacion');
    document.getElementById('formularioModificar').submit();
}

// Mostrar modal de resultado después de redirección
window.addEventListener('DOMContentLoaded', () => {
    const params = new URLSearchParams(window.location.search);
    const resultado = params.get('resultado');

    if (resultado === 'exito') {
        mostrarPopup(`
            <img src="img/happy.jpeg" style="max-width: 100px; display: block; margin: 0 auto;">
            <h3>¡Contacto modificado con éxito!</h3>
            <p>La información del contacto fue actualizada correctamente.</p>
        `, 'modificar.php'); // Redirige para limpiar la URL
    } else if (resultado === 'fallo') {
        mostrarPopup(`
            <img src="img/sad.jpeg" style="max-width: 100px; display: block; margin: 0 auto;">
            <h3>Error al modificar</h3>
            <p>No se pudo actualizar el contacto. Intenta de nuevo.</p>
        `, '', null);
    }
});
