<?php
session_start();
session_destroy(); // Destruye la sesión
header("Location: ../login-registro/login.php"); // Redirige al usuario a la página de login
exit();
?>