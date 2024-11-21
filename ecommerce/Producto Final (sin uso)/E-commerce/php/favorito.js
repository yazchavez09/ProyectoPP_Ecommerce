document.addEventListener('DOMContentLoaded', () => {
    const btnsFavorito = document.querySelectorAll('.favorito');
    const productos = document.querySelectorAll('.producto');
    const contadorFavoritos = document.querySelector('.contador-favorito');

    let favoritos = [];

    const actualizarFavoritosEnLocalStorage = () => {
        localStorage.setItem('favoritos', JSON.stringify(favoritos));
    };

    const cargarFavoritosDeLocalStorage = () => {
        const favoritosGuardados = localStorage.getItem('favoritos');

        if (favoritosGuardados) {
            favoritos = JSON.parse(favoritosGuardados);
            mostrarFavoritos();
        }
    };

    const alternarFavorito = (e) => {
        const botonFavorito = e.currentTarget;
        const producto = botonFavorito.closest('.producto');
        const idProducto = producto.dataset.productId;

        botonFavorito.classList.toggle('activo');

        if (botonFavorito.classList.contains('activo')) {
            favoritos.push(idProducto);
        } else {
            favoritos = favoritos.filter(id => id !== idProducto);
        }

        actualizarFavoritosEnLocalStorage();
        mostrarFavoritos();
    };

    const mostrarFavoritos = () => {
        contadorFavoritos.textContent = favoritos.length;
    };

    btnsFavorito.forEach(btn => {
        btn.addEventListener('click', alternarFavorito);
    });

    cargarFavoritosDeLocalStorage();
});

