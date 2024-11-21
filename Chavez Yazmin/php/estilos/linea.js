function mostrarPestaña(nombrePestaña) {
    var pestañas = document.querySelectorAll('.contenido-pestaña');
    pestañas.forEach(function(pestaña) {
        pestaña.classList.remove('activo');
    });


    var pestañaActiva = document.getElementById(nombrePestaña);
    pestañaActiva.classList.add('activo');


    var botones = document.querySelectorAll('.botón-pestaña');
    botones.forEach(function(boton) {
        boton.classList.remove('activo');
    });

    var botónActivo = document.querySelector(`.botón-pestaña[onclick="mostrarPestaña('${nombrePestaña}')"]`);
    botónActivo.classList.add('activo');

    var líneaPestaña = document.querySelector('.línea-pestaña');
    if (nombrePestaña === 'descripcion') {
        líneaPestaña.style.left = '0%';
    } else if (nombrePestaña === 'envios') {
        líneaPestaña.style.left = '33.33%';
    } else if (nombrePestaña === 'retiros') {
        líneaPestaña.style.left = '66.66%';
    }
}

mostrarPestaña('descripcion');



