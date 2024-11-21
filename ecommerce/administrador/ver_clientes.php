<?php
include("../php/conexion.php");

// Consulta SQL
$sql = "SELECT * FROM cliente where nombre !='' ";
$result = mysqli_query($conexion, $sql);

// Verifica si la consulta tiene errores
if (!$result) {
    die("Error en la consulta: " . mysqli_error($conexion));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <title>Ver Clientes</title>
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
    <h2 style="text-align:center; margin-bottom:40px;">Listado de Clientes</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Telefono</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['id_cli']; ?></td>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['correo']; ?></td>
                    <td><?php echo $row['celular']; ?></td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" style="text-align:center;">No se encontraron clientes.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php
// Cerrar conexión
mysqli_close($conexion);
?>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
