<?php
session_start();
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $datosCliente = json_decode(file_get_contents('php://input'), true);

    // Verificar si el usuario está logueado
    if (!isset($_SESSION['usuario'])) {
        echo json_encode(['exito' => false, 'mensaje' => 'Usuario no logueado.']);
        exit;
    }

    $usuario = $_SESSION['usuario'];
    $nombre = $datosCliente['nombre'];
    $apellido = $datosCliente['apellido'];
    $localidad = $datosCliente['localidad'];
    $calle = $datosCliente['calle'];
    $altura_calle = $datosCliente['altura_calle'];
    $piso = $datosCliente['piso'] ?? null; // Verificar si está presente
    $depto = $datosCliente['depto'] ?? null; // Verificar si está presente
    $celular = $datosCliente['celular'];

    // Obtener el ID del cliente actual
    $consultaUsuario = $conexion->prepare("SELECT id_cli FROM cliente WHERE usuario = ?");
    $consultaUsuario->bind_param("s", $usuario);
    $consultaUsuario->execute();
    $resultadoUsuario = $consultaUsuario->get_result();

    if ($resultadoUsuario->num_rows > 0) {
        $filaUsuario = $resultadoUsuario->fetch_assoc();
        $idCliente = $filaUsuario['id_cli'];

        // Actualizar los datos del cliente
        $update = $conexion->prepare("
            UPDATE cliente
            SET nombre = ?, apellido = ?, localidad = ?, calle = ?, altura_calle = ?, piso = ?, depto = ?, celular = ?
            WHERE id_cli = ?
        ");
        $update->bind_param("ssssssssi", $nombre, $apellido, $localidad, $calle, $altura_calle, $piso, $depto, $celular, $idCliente);

        if ($update->execute()) {
            echo json_encode(['exito' => true, 'mensaje' => 'Datos actualizados correctamente.']);
        } else {
            echo json_encode(['exito' => false, 'mensaje' => 'Error al actualizar los datos.']);
        }
    } else {
        echo json_encode(['exito' => false, 'mensaje' => 'Cliente no encontrado.']);
    }
}
?>
