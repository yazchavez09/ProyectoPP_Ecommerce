<?php 
    include("conexion.php");

    $usuario = $_POST['usuario'];
    $contraseña = $_POST['pwd'];
    $correo = $_POST['correo'];

    
    $sql = "INSERT INTO cliente (usuario, pwd, correo) VALUES ('$usuario','$contraseña','$correo')";
    $consulta = $conexion->query($sql);
    header("Location:../login-registro/login.php");
?>



