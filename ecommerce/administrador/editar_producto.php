<?php
include '../php/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentName = $_POST['current_name'];
    $newName = $_POST['new_name'];
    $newPrice = $_POST['new_price'];

    // Verificar si se ha subido una nueva imagen
    if (!empty($_FILES['new_image']['name'])) {
        $newImage = $_FILES['new_image']['name'];
        $ruta_imagen = '../imagenes/' . basename($newImage);
        move_uploaded_file($_FILES['new_image']['tmp_name'], $ruta_imagen); // Mover la imagen al directorio correcto
    } else {
        // Si no se ha subido una nueva imagen, no cambiar la imagen
        $ruta_imagen = null; 
    }

    // Actualizar el producto
    if ($ruta_imagen) {
        // Si hay una nueva imagen, actualizar también la columna 'imagen'
        $query = "UPDATE producto SET nombre = ?, precio = ?, imagen = ? WHERE nombre = ?";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("sdss", $newName, $newPrice, $ruta_imagen, $currentName);
    } else {
        // Solo actualizar nombre y precio
        $query = "UPDATE producto SET nombre = ?, precio = ? WHERE nombre = ?";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("sds", $newName, $newPrice, $currentName);
    }

    if ($stmt->execute()) {
        header("Location: administrador.php?msg=Producto actualizado");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
}
?>
