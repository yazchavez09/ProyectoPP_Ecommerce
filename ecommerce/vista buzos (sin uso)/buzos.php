<?php
session_start(); // Asegúrate de que la sesión esté iniciada

// Verifica si el usuario ha iniciado sesión y obtiene el nombre de usuario
$loggedIn = isset($_SESSION['usuario']);
$nombreUsuario = $loggedIn ? $_SESSION['usuario'] : "Mi cuenta";

include '../php/conexion.php';

$nombreBuzo1="select nombre from producto where categoria = 'buzos' and id_producto = 1";
$result=mysqli_query($conexion, $nombreBuzo1);
$mostrar=mysqli_fetch_array($result);

$queryBuzos = "SELECT nombre, talle, precio, imagen FROM producto WHERE categoria = 'buzos'";
$resultBuzos = mysqli_query($conexion, $queryBuzos);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../estilo.css">
    <title>Tienda de Ropa</title>
</head>
<body>

    <header class="sticky-header">
        <div class="contenedor-h1">
          <h1 class="h1-H">Envios gratis a CABA</h1>
        </div>
        
        <nav style="background-color: rgb(187, 255, 0)!important;" class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <!--<a class="navbar-brand" href="#">OWN</a>-->
        <a href="" class="me-3"><img style="border-radius: 50%; height: 60px; " src="../own.jpg" alt="" ></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav">
              <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <?php echo htmlspecialchars($nombreUsuario); ?>
                </a>
                  <ul class="dropdown-menu">
                      <?php if ($loggedIn): ?>
                          <li><a class="dropdown-item" href="../php/cerrar_sesion.php">Cerrar sesión</a></li>
                      <?php else: ?>
                          <li><a class="dropdown-item" href="../login-registro/login.php">Iniciar sesión</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="../login-registro/login.php">Registrarme</a></li>
                      <?php endif; ?>
                  </ul>
              </li>
          </ul>

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="../index.php">INICIO</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Nuestras Redes
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="https://www.instagram.com/ownstyle.cb/">Instagram</a></li>
                        <li><a class="dropdown-item" href="#">Facebook</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">WhatsApp</a></li>
                    </ul>
                </li>
            </ul>

            <form class="d-flex align-items-center" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success me-2" type="submit">Search</button>
                <div class="d-flex gap-3">
                  <a href="" style="color: red;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                    </svg>
                  </a>
                  <a href="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                      <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                    </svg>
                  </a>
                </div>
            </form>
        </div>
    </div>
</nav>
      
      
        <div class="secciones">
          <ul>
            <li><a href="../vista remeras/remeras.php"> Remeras</a></li>
            <li><a href="../vista pantalones/pantalones.php"> Pantalones</a></li>
            <li><a href="../vista zapatillas/zapatillas.php"> Zapatillas</a></li>
            <li><a href="../vista conjuntos/conjuntos.php"> Conjuntos</a></li>
            <li><a href="../vista buzos/buzos.php"> Buzos</a></li>
          </ul>
        </div>
      </header>
    
    
    
      <main class="todo">
    <h2 class="h2">Buzos</h2>
    <div class = "todoCards">
    <div class="cards">
        <?php
        // Generar dinámicamente las cards para cada buzo obtenida de la base de datos
        while($buzo = mysqli_fetch_array($resultBuzos)) { ?>
            <article class="card">
                <div class="foto">
                    <img src="<?php echo $buzo['imagen']; ?>">
                </div>

                <h2><b><?php echo $buzo['nombre']; ?></b></h2>
                <p class="descripcion">$<?php echo number_format($buzo['precio'], 2); ?></p>
                <a href="#">
                    <p class="titulo-secciones">Comprar</p>
                </a>
            </article>
        <?php } ?>
    </div>
    </div>

    <footer>
        <p>Contacto:+54 9 11 7651 8464</p>
        <p>Instagram: <a href="https://www.instagram.com/ownstyle.cb/"> @ownstyle.cb</a></p> 
        <p>Correo: ownstylecb@gmail.com</p>      
        <p style="color: rgb(149, 149, 149); font-size: 13px;" >Argentina, Buenos Aires, Capital Federal</p>
        <p style="color: rgb(149, 149, 149); font-size: 13px;" >OWN STYLE © 2018 - 2024 Reservados todos los derechos</p>         
    </footer>
</main>

    <div class="chat-bot-container">
        <button class="chat-bot-button" id="chatBotButton">?</button>
        <div class="chat-bot-content" id="chatBotContent">
            <h4>Elija una opcion</h4>
            <button onclick="showAnswer(1)">1 - ¿Como compro?</button>
            <button onclick="showAnswer(2)">2 - Politica de cambios</button>
            <button onclick="showAnswer(3)">3 - Metodos de pago</button>
            <button onclick="showAnswer(4)">4 - Quiero contactarme</button>
            <div id="chatBotAnswer"></div>
        </div>
    </div>


    <script>
        document.getElementById('chatBotButton').addEventListener('click', function() {
            var chatContent = document.getElementById('chatBotContent');
            if (chatContent.style.display === 'none' || chatContent.style.display === '') {
                chatContent.style.display = 'block';
            } else {
                chatContent.style.display = 'none';
            }
        });
    
        function showAnswer(option) {
            var answer = document.getElementById('chatBotAnswer');
            var currentAnswer = answer.innerText;
            var newAnswer = '';
            var buttons = document.querySelectorAll('.chat-bot-content button');
    
            switch (option) {
                case 1:
                    newAnswer = 'Dirigite a la seccion que queres (zapaillas, remeras o pantalones) y segui los pasos!';
                    break;
                case 2:
                    newAnswer = 'Los cambios los aceptamos hasta el dia 15 de tener el producto y se hacen si es un error de fabrica';
                    break;
                case 3:
                    newAnswer = 'Tarjetas de credito y efectivo';
                    break;
                case 4:
                    newAnswer = 'Hablanos a 11 22678 27383';
                    break;
                default:
                    newAnswer = '';
            }
    
            if (currentAnswer === newAnswer) {
                answer.style.display = 'none';
                answer.innerText = '';
                buttons.forEach(button => button.classList.remove('active'));
            } else {
                answer.innerText = newAnswer;
                answer.style.display = 'block';
                buttons.forEach(button => button.classList.remove('active'));
                buttons[option - 1].classList.add('active');
            }
        }
    </script>
    
    
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
