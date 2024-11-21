<?php
include '../php/conexion.php';

// Recibir datos del formulario
$categoria = $_POST['categoria'];
$nombre = $_POST['nombre'];
$id_talle = $_POST['id_talle'];
$id_color = $_POST['id_color'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$stock = $_POST['stock'];
$imagen = $_FILES['imagen']['name'];

// Manejar la carga de la imagen
if ($imagen) {
    $ruta_imagen = '../imagenes/' . basename($imagen); // Ajusta la ruta donde se guardará la imagen
    if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_imagen)) {
        die("Error al subir la imagen. Por favor, verifica los permisos del directorio.");
    }
} else {
    $ruta_imagen = ''; // Si no se carga imagen, dejamos el campo vacío
}

// Insertar el producto en la tabla 'producto'
$queryProducto = "INSERT INTO producto (nombre, descr, precio, imagen, categoria) VALUES ('$nombre', '$descripcion', '$precio', '$ruta_imagen', '$categoria')";
if (mysqli_query($conexion, $queryProducto)) {
    $id_producto = mysqli_insert_id($conexion);

    // Insertar el detalle del producto en la tabla 'intermediaria'
    $queryIntermediaria = "INSERT INTO intermediaria (id_producto, id_talle, id_color, stock) VALUES ('$id_producto', '$id_talle', '$id_color', '$stock')";
    mysqli_query($conexion, $queryIntermediaria);
    header("Location: administrador.php?msg=Producto agregado");
} else {
    echo "Error al agregar el producto: " . mysqli_error($conexion);
}

mysqli_close($conexion);
?>
