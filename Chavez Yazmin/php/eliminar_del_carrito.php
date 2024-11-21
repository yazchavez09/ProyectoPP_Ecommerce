<?php
session_start();
include 'conexion.php';

if (isset($_GET['id'], $_SESSION['usuario'])) {
    $idProducto = $_GET['id'];
    $usuario = $_SESSION['usuario'];

    // Obtener ID del cliente logueado
    $consultaUsuario = $conexion->prepare("SELECT id_cli FROM cliente WHERE usuario = ?");
    $consultaUsuario->bind_param("s", $usuario);
    $consultaUsuario->execute();
    $resultadoUsuario = $consultaUsuario->get_result();
    $filaUsuario = $resultadoUsuario->fetch_assoc();
    $idCliente = $filaUsuario['id_cli'];

    // Eliminar producto del carrito
    $conexion->query("
        DELETE FROM carrito 
        WHERE id_cli = $idCliente AND id_producto = $idProducto
    ");
    header("Location: carrito.php");
    exit;
}

?>
