const checkbox = document.getElementById('checkbox');

// Al cargar la página, verifica el estado del modo oscuro
if (localStorage.getItem('darkMode') === 'enabled') {
    document.body.classList.add('dark');
    checkbox.checked = true; // Marca el checkbox si el modo oscuro está activo
}

// Escucha cambios en el checkbox y guarda el estado
checkbox.addEventListener('change', () => {
    if (checkbox.checked) {
        document.body.classList.add('dark');
        localStorage.setItem('darkMode', 'enabled'); // Guarda estado en localStorage
    } else {
        document.body.classList.remove('dark');
        localStorage.setItem('darkMode', 'disabled'); // Guarda estado en localStorage
    }
});
