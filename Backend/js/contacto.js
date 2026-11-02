const abrir = document.getElementById("abrir-contacto");
const cerrar = document.getElementById("cerrar-contacto");
const ventana = document.getElementById("ventana-contacto");

abrir.addEventListener("click", function() {
    ventana.style.display = "flex";
});

cerrar.addEventListener("click", function() {
    ventana.style.display = "none";
});

ventana.addEventListener("click", function(evento) {
    if (evento.target === ventana) {
        ventana.style.display = "none";
    }
});