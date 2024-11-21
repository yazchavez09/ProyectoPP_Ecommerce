let talleSeleccionado = null;
let colorSeleccionado = null;




// Capturar el talle seleccionado
const botonesTalle = document.querySelectorAll('.boton-talle');
botonesTalle.forEach(boton => {
    boton.addEventListener('click', () => {
        // Desmarcar todos los botones
        botonesTalle.forEach(b => b.classList.remove('seleccionado'));
        // Marcar el botón clickeado
        boton.classList.add('seleccionado');
        talleSeleccionado = boton.getAttribute('data-talle');
    });
});

// Capturar el color seleccionado
const botonesColor = document.querySelectorAll('.boton-color');
botonesColor.forEach(boton => {
    boton.addEventListener('click', () => {
        // Desmarcar todos los botones
        botonesColor.forEach(b => b.classList.remove('seleccionado'));
        // Marcar el botón clickeado
        boton.classList.add('seleccionado');
        colorSeleccionado = boton.getAttribute('data-color');
    });
});

// Función para agregar al carrito
function agregarAlCarrito(idProducto) {
    if (!talleSeleccionado || !colorSeleccionado) {
        alert("Por favor selecciona un talle y un color.");
        return;
    }
    const nombreProducto = document.getElementById("nombre-producto").value;
    // Enviar los datos al servidor mediante AJAX
    const formData = new FormData();
    formData.append('nombre_producto', nombreProducto);
    formData.append('talle', talleSeleccionado);
    formData.append('color', colorSeleccionado);

    fetch('agregar_al_carrito.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Producto agregado al carrito");
        } else {
            alert(data.error || "Error al agregar el producto al carrito");
        }
    })
    .catch(error => console.error('Error:', error));
}




