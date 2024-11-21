<?php
include '../php/conexion.php';

if (isset($_GET['id'])) {
    $id_producto = $_GET['id'];

    // Preparar y ejecutar la consulta para eliminar los registros relacionados en la tabla intermediaria
    $stmt_intermediaria = $conexion->prepare("DELETE FROM intermediaria WHERE id_producto = ?");
    $stmt_intermediaria->bind_param("i", $id_producto);
    
    if ($stmt_intermediaria->execute()) {
        // Ahora eliminar los registros relacionados en la tabla carrito
        $stmt_carrito = $conexion->prepare("DELETE FROM carrito WHERE id_producto = ?");
        $stmt_carrito->bind_param("i", $id_producto);

        if ($stmt_carrito->execute()) {
            // Ahora eliminar el producto de la tabla producto
            $stmt_producto = $conexion->prepare("DELETE FROM producto WHERE id_producto = ?");
            $stmt_producto->bind_param("i", $id_producto);
            
            if ($stmt_producto->execute()) {
                // Redirige de vuelta a la página de origen (administrador.php o ver_productos.php)
                $referer = $_SERVER['HTTP_REFERER']; 
                header("Location: $referer?msg=Producto eliminado");
                exit();
            } else {
                echo "Error al eliminar el producto: " . $stmt_producto->error;
            }

            $stmt_producto->close();
        } else {
            echo "Error al eliminar los registros en carrito: " . $stmt_carrito->error;
        }

        $stmt_carrito->close();
    } else {
        echo "Error al eliminar los registros en intermediaria: " . $stmt_intermediaria->error;
    }

    $stmt_intermediaria->close();
} else {
    echo "ID del producto no especificado.";
}

$conexion->close();
?>
