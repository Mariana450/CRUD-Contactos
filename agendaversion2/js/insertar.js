document.addEventListener('DOMContentLoaded', function () {
    const formulario = document.getElementById('formularioContacto');

    formulario.addEventListener('submit', function(e) {
        e.preventDefault(); // Evita la recarga de la página

        const formData = new FormData(formulario);

        fetch('controladores/agregar.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.text()) // Espera respuesta como texto plano
        .then(data => {
            if (data.trim() === 'exito') {
                mostrarPopup(`
                    <img src="img/happy.jpeg" style="max-width: 100px; display: block; margin: 0 auto;">
                    <h3>¡Contacto agregado!</h3>
                    <p>El contacto fue registrado correctamente.</p>
                `, '', null, () => {
                    formulario.reset();
                });
            } else {
                mostrarPopup(`
                    <img src="img/sad.jpeg" style="max-width: 100px; display: block; margin: 0 auto;">
                    <h3>Error al guardar</h3>
                    <p>No se pudo registrar el contacto.</p>
                `);
            }
        })
        .catch(error => {
            console.error("Error:", error);
            mostrarPopup(`
                <h3>Error inesperado</h3>
                <p>${error}</p>
            `);
        });
    });
});
