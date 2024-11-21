<?php
include '../php/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_producto = $_POST['id_producto'];
    $stock = $_POST['stock'];
    $talle = $_POST['talle'];
    $color = $_POST['color'];

    // Actualizar los valores en la tabla intermediaria
    $query = "
        UPDATE intermediaria 
        SET stock = ?, id_talle = ?, id_color = ? 
        WHERE id_producto = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("iiii", $stock, $talle, $color, $id_producto);

    if ($stmt->execute()) {
        header("Location: ver_productos.php?msg=Producto actualizado");
    } else {
        echo "Error al actualizar el producto: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
}
?>
