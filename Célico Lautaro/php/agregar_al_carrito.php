<?php
session_start();
include 'conexion.php';

if (isset($_SESSION['usuario'], $_POST['nombre_producto'], $_POST['talle'], $_POST['color'])) {
    $usuario = $_SESSION['usuario'];
    $nombreProducto = $_POST['nombre_producto'];
    $talle = $_POST['talle'];
    $color = $_POST['color'];

    // Obtener ID del cliente logueado
    $consultaUsuario = $conexion->prepare("SELECT id_cli FROM cliente WHERE usuario = ?");
    $consultaUsuario->bind_param("s", $usuario);
    $consultaUsuario->execute();
    $resultadoUsuario = $consultaUsuario->get_result();
    $filaUsuario = $resultadoUsuario->fetch_assoc();
    $idCliente = $filaUsuario['id_cli'];

    // Verificar stock del producto
    $consultaProducto = $conexion->prepare("
        SELECT i.stock, p.id_producto 
        FROM intermediaria i
        JOIN producto p ON i.id_producto = p.id_producto
        JOIN colores c ON i.id_color = c.id_color
        JOIN talle t ON i.id_talle = t.id_talle
        WHERE p.nombre = ? AND t.talle = ? AND c.color = ?
    ");
    $consultaProducto->bind_param("sss", $nombreProducto, $talle, $color);
    $consultaProducto->execute();
    $resultadoProducto = $consultaProducto->get_result();

    if ($resultadoProducto->num_rows > 0) {
        $fila = $resultadoProducto->fetch_assoc();
        $idProducto = $fila['id_producto'];
        $stock = $fila['stock'];

        if ($stock > 0) {
            // Verificar si el producto ya está en el carrito
            $consultaCarrito = $conexion->prepare("
                SELECT cantidad FROM carrito WHERE id_cli = ? AND id_producto = ? AND talle = ? AND color = ?
            ");
            $consultaCarrito->bind_param("iiss", $idCliente, $idProducto, $talle, $color);
            $consultaCarrito->execute();
            $resultadoCarrito = $consultaCarrito->get_result();

            if ($resultadoCarrito->num_rows > 0) {
                // Si ya existe, actualizar la cantidad
                $conexion->query("
                    UPDATE carrito 
                    SET cantidad = cantidad + 1 
                    WHERE id_cli = $idCliente AND id_producto = $idProducto AND talle = '$talle' AND color = '$color'
                ");
            } else {
                // Si no existe, insertarlo
                $conexion->query("
                    INSERT INTO carrito (id_cli, id_producto, talle, color, cantidad)
                    VALUES ($idCliente, $idProducto, '$talle', '$color', 1)
                ");
            }
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Sin stock disponible.']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Producto no encontrado.']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Datos faltantes.']);
}

?>
