<?php
include '../php/conexion.php';

// Consulta para cada categoría (esto lo tienes implementado en tu código actual)


$queryRemeras = "
    SELECT p.id_producto, p.nombre, p.precio, p.imagen, i.stock, c.color, t.talle 
    FROM producto p
    LEFT JOIN intermediaria i ON p.id_producto = i.id_producto
    LEFT JOIN colores c ON i.id_color = c.id_color
    LEFT JOIN talle t ON i.id_talle = t.id_talle
    WHERE p.categoria = 'remeras' 
        AND (c.color != '') 
        AND (t.talle != '') 
";
$resultRemeras = mysqli_query($conexion, $queryRemeras);

$queryPantalones = "
    SELECT p.id_producto, p.nombre, p.precio, p.imagen, i.stock, c.color, t.talle 
    FROM producto p
    LEFT JOIN intermediaria i ON p.id_producto = i.id_producto
    LEFT JOIN colores c ON i.id_color = c.id_color
    LEFT JOIN talle t ON i.id_talle = t.id_talle
    WHERE p.categoria = 'pantalones'
        AND (c.color != '') 
        AND (t.talle != '') 
        AND (i.stock != 0)
";
$resultPantalones = mysqli_query($conexion, $queryPantalones);

$queryZapatillas = "
    SELECT p.id_producto, p.nombre, p.precio, p.imagen, i.stock, c.color, t.talle 
    FROM producto p
    LEFT JOIN intermediaria i ON p.id_producto = i.id_producto
    LEFT JOIN colores c ON i.id_color = c.id_color
    LEFT JOIN talle t ON i.id_talle = t.id_talle
    WHERE p.categoria = 'zapatillas'
        AND (c.color != '') 
        AND (t.talle != '') 
        AND (i.stock != 0)
";
$resultZapatillas = mysqli_query($conexion, $queryZapatillas);

$queryConjuntos = "
    SELECT p.id_producto, p.nombre, p.precio, p.imagen, i.stock, c.color, t.talle 
    FROM producto p
    LEFT JOIN intermediaria i ON p.id_producto = i.id_producto
    LEFT JOIN colores c ON i.id_color = c.id_color
    LEFT JOIN talle t ON i.id_talle = t.id_talle
    WHERE p.categoria = 'conjuntos'
        AND (c.color != '') 
        AND (t.talle != '') 
        AND (i.stock != 0)
";
$resultConjuntos = mysqli_query($conexion, $queryConjuntos);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <title>Ver Productos</title>
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

    <div class="container mt-5">
        <h2 style="text-align:center; margin-bottom:40px;">Stock de Productos</h2>

        <!-- Remeras -->
        <h3 style="text-align:center;">Remeras</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Talle</th>
                    <th>Color</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($resultRemeras)): ?>
                <tr>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['precio']; ?></td>
                    <td><?php echo $row['talle']; ?></td>
                    <td><?php echo $row['color']; ?></td>
                    <td><?php echo $row['stock']; ?></td>
                    <td style="display:flex; justify-content:center;">
                        <!-- Botón de editar -->
                        <a href="#" 
                            class="btn btn-primary"
                            data-bs-toggle="modal" 
                            data-bs-target="#editModal" 
                            data-id="<?php echo $row['id_producto']; ?>"
                            data-stock="<?php echo $row['stock']; ?>"
                            data-talle="<?php echo $row['id_talle'] ?? ''; ?>"
                            data-color="<?php echo $row['id_color'] ?? ''; ?>">
                            <p class="elele">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                </svg>
                            </p>
                        </a>
                        <!-- Botón de eliminar -->
                        <a style="margin-left:10px;" href="eliminar_producto.php?id=<?php echo $row['id_producto']; ?>" onclick="return confirm('¿Está seguro de que desea eliminar este producto?')" class="btn btn-danger" >
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                            </svg>
                        </p>
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Repetir para las demás categorías -->
        <h3 style="text-align:center;">Pantalones</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Talle</th>
                    <th>Color</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($resultPantalones)): ?>
                <tr>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['precio']; ?></td>
                    <td><?php echo $row['talle']; ?></td>
                    <td><?php echo $row['color']; ?></td>
                    <td><?php echo $row['stock']; ?></td>
                    <td style="display:flex; justify-content:center;">
                    <a href="#" 
                            class="btn btn-primary"
                            data-bs-toggle="modal" 
                            data-bs-target="#editModal" 
                            data-id="<?php echo $row['id_producto']; ?>"
                            data-stock="<?php echo $row['stock']; ?>"
                            data-talle="<?php echo $row['id_talle'] ?? ''; ?>"
                            data-color="<?php echo $row['id_color'] ?? ''; ?>">
                            <p class="elele">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                </svg>
                            </p>
                        </a>
                        <a style="margin-left:10px;" href="eliminar_producto.php?id=<?php echo $row['id_producto']; ?>" onclick="return confirm('¿Está seguro de que desea eliminar este producto?')" class="btn btn-danger">
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                            </svg>
                        </p>
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <h3 style="text-align:center;">Zapatillas</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Talle</th>
                    <th>Color</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($resultZapatillas)): ?>
                <tr>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['precio']; ?></td>
                    <td><?php echo $row['talle']; ?></td>
                    <td><?php echo $row['color']; ?></td>
                    <td><?php echo $row['stock']; ?></td>
                    <td style="display:flex; justify-content:center;">
                    <a href="#" 
                            class="btn btn-primary"
                            data-bs-toggle="modal" 
                            data-bs-target="#editModal" 
                            data-id="<?php echo $row['id_producto']; ?>"
                            data-stock="<?php echo $row['stock']; ?>"
                            data-talle="<?php echo $row['id_talle'] ?? ''; ?>"
                            data-color="<?php echo $row['id_color'] ?? ''; ?>">
                            <p class="elele">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                </svg>
                            </p>
                    </a>
                        <a style="margin-left:10px;" href="eliminar_producto.php?id=<?php echo $row['id_producto']; ?>" onclick="return confirm('¿Está seguro de que desea eliminar este producto?')" class="btn btn-danger">
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                            </svg>
                        </p>
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <h3 style="text-align:center;">Conjuntos</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Talle</th>
                    <th>Color</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($resultConjuntos)): ?>
                <tr>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['precio']; ?></td>
                    <td><?php echo $row['talle']; ?></td>
                    <td><?php echo $row['color']; ?></td>
                    <td><?php echo $row['stock']; ?></td>
                    <td style="display:flex; justify-content:center;" >
                    <a href="#" 
                            class="btn btn-primary"
                            data-bs-toggle="modal" 
                            data-bs-target="#editModal" 
                            data-id="<?php echo $row['id_producto']; ?>"
                            data-stock="<?php echo $row['stock']; ?>"
                            data-talle="<?php echo $row['id_talle'] ?? ''; ?>"
                            data-color="<?php echo $row['id_color'] ?? ''; ?>">
                            <p class="elele">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                </svg>
                            </p>
                    </a>
                        </button>
                        <a style="margin-left:10px;" href="eliminar_producto.php?id=<?php echo $row['id_producto']; ?>" onclick="return confirm('¿Está seguro de que desea eliminar este producto?')" class="btn btn-danger">
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                            </svg>
                        </p>
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>




        <!-- Modal de Edición -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editForm" method="POST" action="editar_producto_ver.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Editar Producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Inputs para editar -->
                        <input type="hidden" name="id_producto" id="editProductId">

                        <div class="mb-3">
                            <label for="editStock" class="form-label">Stock</label>
                            <input type="number" class="form-control" id="editStock" name="stock" required>
                        </div>

                        <div class="mb-3">
                            <label for="editTalle" class="form-label">Talle</label>
                            <select class="form-control" id="editTalle" name="talle" required>
                                <?php
                                // Opciones de talles desde la base de datos
                                $queryTalle = "SELECT * FROM talle";
                                $resultTalle = mysqli_query($conexion, $queryTalle);
                                while ($talle = mysqli_fetch_assoc($resultTalle)) {
                                    echo "<option value='{$talle['id_talle']}'>{$talle['talle']}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="editColor" class="form-label">Color</label>
                            <select class="form-control" id="editColor" name="color" required>
                                <?php
                                // Opciones de colores desde la base de datos
                                $queryColor = "SELECT * FROM colores";
                                $resultColor = mysqli_query($conexion, $queryColor);
                                while ($color = mysqli_fetch_assoc($resultColor)) {
                                    echo "<option value='{$color['id_color']}'>{$color['color']}</option>";
                                }
                                ?>
                            </select>
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script>
        const editModal = document.getElementById('editModal');
        editModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Botón que activó el modal
            const productId = button.getAttribute('data-id');
            const stock = button.getAttribute('data-stock');
            const talle = button.getAttribute('data-talle');
            const color = button.getAttribute('data-color');

            // Llenar el formulario del modal con los valores del producto
            document.getElementById('editProductId').value = productId;
            document.getElementById('editStock').value = stock;
            document.getElementById('editTalle').value = talle;
            document.getElementById('editColor').value = color;
        });
    </script>

</body>
</html>
