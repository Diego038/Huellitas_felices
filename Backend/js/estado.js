fetch('/huellitas_felices/Backend/php/estado_sesion.php')
    .then(respuesta => respuesta.json())
    .then(datos => {

        if (datos.iniciada) {

            document.querySelectorAll('.icono-usuario').forEach(icono => {
                icono.style.display = 'none';
            });

        }

    })
    .catch(error => console.log("Error al comprobar sesión:", error));