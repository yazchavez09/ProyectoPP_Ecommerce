<?php
session_start(); // Asegúrate de que la sesión esté iniciada

// Verifica si el usuario ha iniciado sesión y obtiene el nombre de usuario
$loggedIn = isset($_SESSION['usuario']);
$nombreUsuario = $loggedIn ? $_SESSION['usuario'] : "Mi cuenta";

include '../php/conexion.php';

if (isset($_GET['id_producto'])) {
    $idProducto = intval($_GET['id_producto']);

    // Consulta el producto
    $queryProducto = "SELECT * FROM producto WHERE id_producto = $idProducto";
    $resultProducto = mysqli_query($conexion, $queryProducto);

    if ($resultProducto && mysqli_num_rows($resultProducto) > 0) {
        $producto = mysqli_fetch_assoc($resultProducto);
    } else {
        echo "Producto no encontrado";
        exit;
    }

    // Determina el tipo de talles según la categoría del producto
    $categoria = $producto['categoria'];
    if ($categoria === 'zapatillas') {
        // Si es zapatillas, selecciona los talles numéricos
        $queryTalles = "SELECT talle FROM talle WHERE talle REGEXP '^[0-9]+$'";
    } else {
        // Si es otra categoría, selecciona los talles con letras
        $queryTalles = "SELECT talle FROM talle WHERE talle REGEXP '^[A-Za-z]+$'";
    }
    $resultTalles = mysqli_query($conexion, $queryTalles);


    
    // Consulta los colores disponibles
    $queryColores = "SELECT color FROM colores";
    $resultColores = mysqli_query($conexion, $queryColores);
} else {
    echo "Producto no especificado";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/estilo-nav.css">
    <link rel="stylesheet" href="estilos/estilo-producto.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../dark.css">


    <title>Producto</title>
</head>
<body>
<input type="hidden" id="nombre-producto" value="<?php echo htmlspecialchars($producto['nombre']); ?>">
<header class="sticky-header">
        <div class="contenedor-h1">
          <h1 class="h1-H">Envios gratis a CABA</h1>
        </div>

    <nav style="background-color: rgb(187, 255, 0)!important;" class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
        <!--<a class="navbar-brand" href="#">OWN</a>-->
            <a href="" class="me-3"><img style="border-radius: 50%; height: 60px; " src="../own.jpg" alt="" ></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo htmlspecialchars($nombreUsuario); ?>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if ($loggedIn): ?>
                            <li><a class="dropdown-item" href="../php/cerrar_sesion.php">Cerrar sesión</a></li>
                        <?php else: ?>
                            <li><a class="dropdown-item" href="../login-registro/login.php">Iniciar sesión</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="../login-registro/login.php">Registrarme</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            </ul>

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../index.php">INICIO</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Nuestras Redes
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="https://www.instagram.com/ownstyle.cb/">Instagram</a></li>
                            <li><a class="dropdown-item" href="#">Facebook</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">WhatsApp</a></li>
                        </ul>
                    </li>
                </ul>

                <form class="d-flex align-items-center" role="search">
                    <div class="toggle-theme">
                        <input type="checkbox" class="checkbox" id="checkbox">
                        <label for="checkbox" class="label">
                            <i class="bi bi-sun-fill"></i>
                            <i class="bi bi-moon-fill"></i>
                            <i class="bi bi-circle-fill"></i>
                        </label>
                    </div>
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success me-2" type="submit">Search</button>
                    <div class="d-flex gap-3">
                    <a href="" style="color: red;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                        </svg>
                    </a>
                    <a href="carrito.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                        </svg>
                    </a>
                    </div>
                </form>
            </div>
        </div>
    </nav>
      

        <div class="secciones">
            <ul>
                <li><a href="../vista remeras/remeras.php"> Remeras</a></li>
                <li><a href="../vista pantalones/pantalones.php"> Pantalones</a></li>
                <li><a href="../vista zapatillas/zapatillas.php"> Zapatillas</a></li>
                <li><a href="../vista conjuntos/conjuntos.php"> Conjuntos</a></li>
            </ul>
        </div>
    </header>

    <main>

            <div class="producto">
                <div class="imagen-producto">
                    <img src="<?php echo $producto['imagen']; ?>"  alt="Remera OWN">
                </div>
                <div class="detalles-producto" data-product-id="0031">
                    <h1><?php echo htmlspecialchars($producto['nombre']); ?></h1>
                    <div class="pie-tarjeta-producto">
                        <span class="precio">$<?php echo number_format($producto['precio'], 2); ?></span>
    
                        <div class="contenedor-botones-tarjeta">
                            <button class="favorito">
                                <i class="fa-regular fa-heart" id="favorito-regular"></i>
                                <i class="fa-solid fa-heart" id="favorito-agregado"></i>
                            </button>
                        </div>
                    </div>
                    


                    <div class="talles">
                <span>Talle</span>
                <?php if ($resultTalles && mysqli_num_rows($resultTalles) > 0): ?>
                    <?php while ($talle = mysqli_fetch_assoc($resultTalles)): ?>
                        <button class="boton-talle" data-talle="<?php echo htmlspecialchars($talle['talle']); ?>">
                            <?php echo htmlspecialchars($talle['talle']); ?>
                        </button>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No hay talles disponibles</p>
                <?php endif; ?>
            </div>

            <div class="colores">
                <span>Color</span>
                <?php if ($resultColores && mysqli_num_rows($resultColores) > 0): ?>
                    <?php while ($color = mysqli_fetch_assoc($resultColores)): ?>
                        <button class="boton-color <?php echo strtolower(htmlspecialchars($color['color'])); ?>" 
                            data-color="<?php echo strtolower(htmlspecialchars($color['color'])); ?>">
                            <?php echo htmlspecialchars($color['color']); ?>
                        </button>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No hay colores disponibles</p>
                <?php endif; ?>
            </div>

            <button class="agregar-al-carrito" onclick="agregarAlCarrito(<?php echo $producto['id_producto']; ?>)">
                Agregar al carrito
            </button>
                    
                    <div class="descripcion">
                        <div class="barra">
                            <ul>
                                <div class="pestañas">
                                    <button class="botón-pestaña activo" onclick="mostrarPestaña('descripcion')">Descripción</button>
                                    <button class="botón-pestaña" onclick="mostrarPestaña('envios')">Envíos</button>
                                    <button class="botón-pestaña" onclick="mostrarPestaña('retiros')">Retiros</button>
                                    <div class="línea-pestaña"></div>
                                </div>
                                <div class="contenido-pestaña" id="descripcion">
                                    <p>ID de producto: <?php echo number_format($producto['id_producto']); ?></p>
                                    <p><?php echo htmlspecialchars($producto['descr']); ?></p>
                                </div>
                                <div class="contenido-pestaña" id="envios">
                                    <p>Información</p>
                                </div>
                                <div class="contenido-pestaña" id="retiros">
                                    <p>Acordar el retiro</p>
                                </div>
                                <script src="linea.js"></script>
                            </ul>
                        </div>
                </div>
            </div>
        </main>
        
        <script src="estilos/favorito.js"></script>
        <script src="estilos/linea.js"></script>
        <script src="agregarAlCarrito.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

        <script>                      
                    document.addEventListener("DOMContentLoaded", () => {
            const botonesTalle = document.querySelectorAll(".boton-talle");
            const botonesColor = document.querySelectorAll(".boton-color");

            // Manejador para los talles
            botonesTalle.forEach((boton) => {
                boton.addEventListener("click", () => {
                    // Remueve la clase 'seleccionado' de todos los talles
                    botonesTalle.forEach((b) => b.classList.remove("seleccionado"));
                    // Agrega la clase 'seleccionado' al botón clickeado
                    boton.classList.add("seleccionado");
                });
            });

            // Manejador para los colores
            botonesColor.forEach((boton) => {
                boton.addEventListener("click", () => {
                    // Remueve la clase 'seleccionado' de todos los colores
                    botonesColor.forEach((b) => b.classList.remove("seleccionado"));
                    // Agrega la clase 'seleccionado' al botón clickeado
                    boton.classList.add("seleccionado");
                });
            });
        });

        </script>

        <script src="../dark.js"></script>
    </body>
    </html>

