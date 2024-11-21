<?php
session_start();
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['usuario']) || empty($_POST['pwd'])) {
        header("Location: ../login-registro/login.php?error=campos_vacios");
        exit();
    }

    $usuario = $conexion->real_escape_string($_POST['usuario']);
    $contraseña = $conexion->real_escape_string($_POST['pwd']);

    $sql = "SELECT * FROM cliente WHERE usuario = '$usuario' AND pwd = '$contraseña'";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['usuario'] = $usuario;
        header("Location: ../index.php?loggedin=true");
        exit();
    } else {
        header("Location: ../login-registro/login.php?error=datos_incorrectos");
        exit();
    }
}
$conexion->close();
?>
