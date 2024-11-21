<?php

include '../php/conexion.php';

//--------------------CONSULTA REMERAS------------------------
$queryRemeras = "
    SELECT p.id_producto, p.nombre, p.precio, p.imagen 
    FROM producto p
    LEFT JOIN intermediaria i ON p.id_producto = i.id_producto
    LEFT JOIN colores c ON i.id_color = c.id_color
    LEFT JOIN talle t ON i.id_talle = t.id_talle
    WHERE p.categoria = 'remeras' 
      AND (c.color = '' OR c.color IS NULL) 
      AND (t.talle = '' OR t.talle IS NULL) 
      AND (i.stock = 0 OR i.stock IS NULL)
";
$resultRemeras = mysqli_query($conexion, $queryRemeras);

//--------------------CONSULTA PANTALONES------------------------
$queryPantalones = "
    SELECT p.id_producto, p.nombre, p.precio, p.imagen 
    FROM producto p
    LEFT JOIN intermediaria i ON p.id_producto = i.id_producto
    LEFT JOIN colores c ON i.id_color = c.id_color
    LEFT JOIN talle t ON i.id_talle = t.id_talle
    WHERE p.categoria = 'pantalones' 
      AND (c.color = '' OR c.color IS NULL) 
      AND (t.talle = '' OR t.talle IS NULL) 
      AND (i.stock = 0 OR i.stock IS NULL)
";
$resultPantalones = mysqli_query($conexion, $queryPantalones);

//--------------------CONSULTA ZAPATILLAS------------------------
$queryZapatillas = "
    SELECT p.id_producto, p.nombre, p.precio, p.imagen 
    FROM producto p
    LEFT JOIN intermediaria i ON p.id_producto = i.id_producto
    LEFT JOIN colores c ON i.id_color = c.id_color
    LEFT JOIN talle t ON i.id_talle = t.id_talle
    WHERE p.categoria = 'zapatillas' 
      AND (c.color = '' OR c.color IS NULL) 
      AND (t.talle = '' OR t.talle IS NULL) 
      AND (i.stock = 0 OR i.stock IS NULL)
";
$resultZapatillas = mysqli_query($conexion, $queryZapatillas);

//--------------------CONSULTA CONJUNTOS------------------------

$queryConjuntos = "
    SELECT p.id_producto, p.nombre, p.precio, p.imagen 
    FROM producto p
    LEFT JOIN intermediaria i ON p.id_producto = i.id_producto
    LEFT JOIN colores c ON i.id_color = c.id_color
    LEFT JOIN talle t ON i.id_talle = t.id_talle
    WHERE p.categoria = 'conjuntos'
      AND (c.color = '' OR c.color IS NULL) 
      AND (t.talle = '' OR t.talle IS NULL) 
      AND (i.stock = 0 OR i.stock IS NULL)
";
$resultConjuntos = mysqli_query($conexion, $queryConjuntos);


//--------------------CONSULTA TALLES------------------------

$queryTalle = "select * from talle";
$resultTalle =  mysqli_query($conexion, $queryTalle);
$mostrar = mysqli_fetch_array($resultTalle);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilosAdmin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        nav {
            background-color: black !important;
        }
        .container-center {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 56px); /* Ajusta la altura al tamaño de la pantalla menos la altura del nav */
        }
        .principal {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Administrador</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Página principal</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Acciones
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="ver_productos.php">Ver productos</a></li>
                            <li><a class="dropdown-item" href="administrador.php">Agregar productos</a></li>
                            <li><a class="dropdown-item" href="ver_clientes.php">Ver clientes</a></li>
                    </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-center">
        <div class="principal col-sm-6">
            <h1 style="text-align: center;">Agregar un producto</h1>
            <form action="procesar_producto.php" method="POST" enctype="multipart/form-data">
    <!-- Campos para capturar categoría, nombre, talle, color, descripción, precio, stock e imagen del producto -->
                <label for="inputState"><b>Producto</b></label>
                <select class="form-select mb-3" name="categoria" aria-label="Default select example">
                    <option value="remeras">Remeras</option>
                    <option value="pantalones">Pantalones</option>
                    <option value="zapatillas">Zapatillas</option>
                    <option value="conjuntos">Conjuntos</option>
                    <option value="buzos">Buzo</option>
                </select>

                <label for="inputState"><b>Nombre</b></label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="nombre" placeholder="Nombre del producto" required>
                </div>

                <label for="inputState"><b>Talle</b></label>
                    <select class="form-select mb-3" name="id_talle" aria-label="Default select example">
                    <option value="19" selected>Seleccione talle</option>
                        <?php 
                        // Asegurarse de que el puntero del resultado esté en el inicio
                        mysqli_data_seek($resultTalle, 0);

                        // Bucle para mostrar todas las opciones
                        while ($talle = mysqli_fetch_array($resultTalle)) { ?>
                            <option value="<?php echo $talle['id_talle']; ?>"><?php echo $talle['talle']; ?></option>
                        <?php } ?>
                    </select>


    <label for="inputState"><b>Color</b></label>
    <select class="form-select mb-3" name="id_color" aria-label="Default select example">
    <option value="9" selected>Seleccione color</option>
        <?php
        $queryColor = "SELECT * FROM colores";
        $resultColor = mysqli_query($conexion, $queryColor);
        while ($color = mysqli_fetch_array($resultColor)) {
            echo "<option value='" . $color['id_color'] . "'>" . $color['color'] . "</option>";
        }
        ?>
    </select>

    <label for="inputState"><b>Descripción</b></label>
    <div class="input-group mb-3">
        <textarea class="form-control" name="descripcion" placeholder="Descripción del producto"></textarea>
    </div>

    <label for="inputState"><b>Precio</b></label>
    <div class="input-group mb-3">
        <span class="input-group-text">$</span>
        <input type="number" class="form-control" name="precio" placeholder="Precio del producto" required>              
    </div>

    <label for="inputState"><b>Stock</b></label>
    <div class="input-group mb-3">
        <input type="number" class="form-control" name="stock" placeholder="Cantidad de stock del producto">              
    </div>

    <label for="inputState"><b>Imagen</b></label>
    <div class="input-group mb-3">
        <input type="file" class="form-control" name="imagen">
    </div>
    
    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary">Agregar Producto</button>
    </div>
</form>

        </div>
    </div>

    <h2 class="h2" >Remeras</h2>
    <div class = "todoCards">
    <div class="cards">
        <?php
        // Generar dinámicamente las cards para cada remera obtenida de la base de datos
        while($remera = mysqli_fetch_array($resultRemeras)) { ?>
            <article class="card">
                <div class="foto">
                    <img src="<?php echo $remera['imagen']; ?>" alt="Imagen del producto">
                </div>
            
                <h2><b><?php echo $remera['nombre']; ?></b></h2>
                <p class="descripcion">$<?php echo number_format($remera['precio'], 2); ?></p>
                <div class="caja-botones">
                    <!-- Botón para editar -->
                    <a class="botones1" href="#" 
                        data-bs-toggle="modal" 
                        data-bs-target="#editModal"
                        data-name="<?php echo $remera['nombre']; ?>"
                        data-price="<?php echo $remera['precio']; ?>">
                            <p class="elele">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                </svg>
                            </p>
                    </a>
            
                    <!-- Botón para eliminar -->
                    <a class="botones2" href="eliminar_producto.php?id=<?php echo htmlspecialchars($remera['id_producto']); ?> "onclick="return confirm('¿Está seguro de que desea eliminar este producto?')">
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                            </svg>
                        </p>
                    </a>
                </div>
            </article>    
            <?php } ?>
    </div>
    </div>

    <h2 class="h2">Pantalones</h2>
        <div class = "todoCards">
        <div class="cards">
        <?php
        // Generar dinámicamente las cards para cada pantalon obtenida de la base de datos
        while($pantalones = mysqli_fetch_array($resultPantalones)) { ?>
            <article class="card">
                <div class="foto">
                    <img src="<?php echo $pantalones['imagen']; ?>" alt="Imagen del producto">
                </div>
            
                <h2><b><?php echo $pantalones['nombre']; ?></b></h2>
                <p class="descripcion">$<?php echo number_format($pantalones['precio'], 2); ?></p>
                <div class="caja-botones">
                    <!-- Botón para editar -->
                    <a class="botones1" href="#" 
                        data-bs-toggle="modal" 
                        data-bs-target="#editModal"
                        data-name="<?php echo $pantalones['nombre']; ?>"
                        data-price="<?php echo $pantalones['precio']; ?>">
                            <p class="elele">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                </svg>
                            </p>
                    </a>
            
                    <!-- Botón para eliminar -->
                    <a class="botones2" href="eliminar_producto.php?id=<?php echo htmlspecialchars($pantalones['id_producto']); ?>" onclick="return confirm('¿Está seguro de que desea eliminar este producto?')">
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                            </svg>
                        </p>
                    </a>
                </div>
            </article>
        <?php } ?>
    </div>
    </div>

    <h2 class="h2">Zapatillas Alexander MC.Queen</h2>
        <div class="todoCards">
        <div class="cards">
        <?php
        // Generar dinámicamente las cards para cada zapatilla obtenida de la base de datos
        while($zapatilla = mysqli_fetch_array($resultZapatillas)) { ?>
            <article class="card">
                <div class="foto">
                    <img src="<?php echo $zapatilla['imagen']; ?>" alt="Imagen del producto">
                </div>
            
                <h2><b><?php echo $zapatilla['nombre']; ?></b></h2>
                <p class="descripcion">$<?php echo number_format($zapatilla['precio'], 2); ?></p>
                <div class="caja-botones">
                    <!-- Botón para editar -->
                    <a class="botones1" href="#" 
                        data-bs-toggle="modal" 
                        data-bs-target="#editModal"
                        data-name="<?php echo $zapatilla['nombre']; ?>"
                        data-price="<?php echo $zapatilla['precio']; ?>">
                            <p class="elele">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                </svg>
                            </p>
                    </a>
            
                    <!-- Botón para eliminar -->
                    <a class="botones2" href="eliminar_producto.php?id=<?php echo htmlspecialchars($zapatilla['id_producto']); ?>" onclick="return confirm('¿Está seguro de que desea eliminar este producto?')">
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                            </svg>
                        </p>
                    </a>
                </div>
            </article>
        <?php } ?>
    </div>
    </div>

    <h2 class="h2">Conjuntos</h2>
    <div class="todoCards">
        <div class="cards">
        <?php
        // Generar dinámicamente las cards para cada zapatilla obtenida de la base de datos
        while($conjunto = mysqli_fetch_array($resultConjuntos)) { ?>
            <article class="card">
                <div class="foto">
                    <img src="<?php echo $conjunto['imagen']; ?>" alt="Imagen del producto">
                </div>
            
                <h2><b><?php echo $conjunto['nombre']; ?></b></h2>
                <p class="descripcion">$<?php echo number_format($conjunto['precio'], 2); ?></p>
                <div class="caja-botones">
                    <!-- Botón para editar -->
                    <a class="botones1" href="#" 
                        data-bs-toggle="modal" 
                        data-bs-target="#editModal"
                        data-name="<?php echo $conjunto['nombre']; ?>"
                        data-price="<?php echo $conjunto['precio']; ?>">
                            <p class="elele">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                </svg>
                            </p>
                    </a>
            
                    <!-- Botón para eliminar -->
                    <a class="botones2" href="eliminar_producto.php?id=<?php echo htmlspecialchars($conjunto['id_producto']); ?>" onclick="return confirm('¿Está seguro de que desea eliminar este producto?')">
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                            </svg>
                        </p>
                    </a>
                </div>
            </article>
        <?php } ?>
    </div>
    </div>





<!-- Modal de Edición -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editForm" method="POST" action="editar_producto.php" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Editar Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Inputs para editar -->
                    <input type="hidden" name="current_name" id="currentName">
                    <div class="mb-3">
                        <label for="newName" class="form-label">Nuevo Nombre</label>
                        <input type="text" class="form-control" id="newName" name="new_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="newPrice" class="form-label">Nuevo Precio</label>
                        <input type="number" class="form-control" id="newPrice" name="new_price" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="newImage" class="form-label">Nueva Imagen</label>
                        <input type="file" class="form-control" id="newImage" name="new_image" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>


    

    
    <script>
        const editModal = document.getElementById('editModal');
        editModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Botón que activó el modal
        const name = button.getAttribute('data-name');
        const price = button.getAttribute('data-price');
        const image = button.getAttribute('data-image'); // Asegúrate de pasar la imagen actual desde el botón
        
        // Actualizar los valores en el modal
        document.getElementById('currentName').value = name;
        document.getElementById('newName').value = name;
        document.getElementById('newPrice').value = price;
        document.getElementById('newImage').value = ''; // Esto es para que el campo de imagen esté vacío al abrir el modal
        // Si quieres mostrar la imagen actual, puedes agregarla como un elemento en el modal
        // Ejemplo:
        const imagePreview = document.getElementById('imagePreview');
        imagePreview.src = image; // Ajusta según tu lógica
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
