<?php
session_start();
include 'conexion.php';

$loggedIn = isset($_SESSION['usuario']);
$nombreUsuario = $loggedIn ? $_SESSION['usuario'] : "Mi cuenta";

$total = 0;

if ($loggedIn) {
    $usuario = $_SESSION['usuario'];

    // Obtener ID del cliente logueado
    $consultaUsuario = $conexion->prepare("SELECT id_cli FROM cliente WHERE usuario = ?");
    $consultaUsuario->bind_param("s", $usuario);
    $consultaUsuario->execute();
    $resultadoUsuario = $consultaUsuario->get_result();
    $filaUsuario = $resultadoUsuario->fetch_assoc();
    $idCliente = $filaUsuario['id_cli'];

    // Obtener los productos del carrito
    $productosCarrito = $conexion->query("
        SELECT c.id_producto, p.nombre, p.precio, c.talle, c.color, c.cantidad 
        FROM carrito c
        JOIN producto p ON c.id_producto = p.id_producto
        WHERE c.id_cli = $idCliente
    ");
} else {
    echo "Por favor, inicia sesión.";
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilo.css">
    <link rel="stylesheet" href="../dark.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
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
                      <?php echo htmlspecialchars($usuario); ?>
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
                <div class="toggle-theme">
                    <input type="checkbox" class="checkbox" id="checkbox">
                    <label for="checkbox" class="label">
                        <i class="bi bi-sun-fill"></i>
                        <i class="bi bi-moon-fill"></i>
                        <i class="bi bi-circle-fill"></i>
                    </label>
                </div>
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
          </ul>
        </div>     
      </header>

    

    <div class="contenedorTabla">
    <h2>Tu carrito</h2>
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
        <thead>
            <tr style="background-color: #f4f4f4;">
                <th style="padding: 10px; text-align: left; border-bottom: 2px solid #ddd;">Producto ID</th>
                <th style="padding: 10px; text-align: left; border-bottom: 2px solid #ddd;">Precio</th>
                <th style="padding: 10px; text-align: left; border-bottom: 2px solid #ddd;">Nombre</th>
                <th style="padding: 10px; text-align: left; border-bottom: 2px solid #ddd;">Talle</th>
                <th style="padding: 10px; text-align: left; border-bottom: 2px solid #ddd;">Color</th>
                <th style="padding: 10px; text-align: left; border-bottom: 2px solid #ddd;">Cantidad</th>
                <th style="padding: 10px; text-align: left; border-bottom: 2px solid #ddd;">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($item = $productosCarrito->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $item['id_producto']; ?></td>
                    <td><?php echo $item['precio']; ?></td>
                    <td><?php echo htmlspecialchars($item['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($item['talle']); ?></td>
                    <td><?php echo htmlspecialchars($item['color']); ?></td>
                    <td><?php echo htmlspecialchars($item['cantidad']); ?></td>
                    <td><a href="eliminar_del_carrito.php?id=<?php echo $item['id_producto']; ?>" class="btn btn-danger">Eliminar</a></td>
                </tr>
                <?php $total += $item['precio'] * $item['cantidad']; ?>
            <?php endwhile; ?>
        </tbody>
    </table>
    <h4>Total: $<?php echo number_format($total, 2); ?></h4>

    

    <div class="boton-modal" style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; cursor: pointer;">
        <label for="btn-modal" style="text-align: center; background-color: #4CAF50;cursor: pointer; height: 25px; width: 100px;">
            Ir a pagar
        </label>
    </div>
    
    </div>

    <!--Ventana Modal-->
    <input type="checkbox" id="btn-modal">
<div class="container-modal">
    <div class="container">
        <div class="header">Datos de compra</div>

        <div class="payment-methods">
            <div>
                <h3>Tarjeta de crédito</h3>
                <img src="../imagenes/imagenesPAGO/visa.png" alt="Visa">
                <img src="../imagenes/imagenesPAGO/mastercard.png" alt="MasterCard">
                <img src="../imagenes/imagenesPAGO/amex.png" alt="American Express">
                <img src="../imagenes/imagenesPAGO/uala.png" alt="Ualá">
                <img src="../imagenes/imagenesPAGO/mercado_pago.png" alt="Mercado Pago">
            </div>
            <div>
                <h3>Tarjeta de débito</h3>
                <img src="../imagenes/imagenesPAGO/itau.png" alt="Itau">
                <img src="../imagenes/imagenesPAGO/bbva.png" alt="BBVA">
                <img src="../imagenes/imagenesPAGO/icbc.png" alt="ICBC">
                <img src="../imagenes/imagenesPAGO/patagonia.png" alt="Banco Patagonia">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="name">Nombre del titular</label>
                <input type="text" id="name" placeholder="Nombre del titular">
            </div>
            <div class="form-group">
                <label for="card-number">Número de tarjeta</label>
                <input type="password" id="card-number" placeholder="Número de tarjeta">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="expiry">Fecha de expiración</label>
                <div class="expiration-date">
                    <input type="text" id="expiry-month" placeholder="Mes">
                    <input type="text" id="expiry-year" placeholder="Año">
                </div>
            </div>
            <div class="form-group">
                <label for="cvv">Código de seguridad</label>
                <input type="text" id="cvv" placeholder="Código de seguridad">
            </div>
        </div>
        
        <div class="botones">
            <div class="btn-cerrar">
                <label for="btn-modal">Cancelar</label>
            </div>
            <div class="siguiente">
                <!-- Botón para abrir el segundo modal -->
                <button id="btn-siguiente" class="btn">Siguiente</button>
            </div>
        </div>
    </div>
    <label for="btn-modal" class="cerrar-modal"></label>
</div>
<!--Fin de Ventana Modal-->

<div class="modal fade" id="modalCliente" tabindex="-1" aria-labelledby="modalClienteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalClienteLabel">Datos del cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nombreCliente">Nombre</label>
                    <input type="text" id="nombreCliente" class="form-control" placeholder="Nombre">
                </div>
                <div class="form-group mt-2">
                    <label for="apellidoCliente">Apellido</label>
                    <input type="text" id="apellidoCliente" class="form-control" placeholder="Apellido">
                </div>
                <div class="form-group mt-2">
                    <label for="localidadCliente">Localidad</label>
                    <input type="text" id="localidadCliente" class="form-control" placeholder="Localidad">
                </div>
                <div class="form-group mt-2">
                    <label for="direccionCliente">Calle</label>
                    <input type="text" id="direccionCliente" class="form-control" placeholder="Calle">
                </div>
                <div class="form-group mt-2">
                    <label for="alturaCalle">Altura</label>
                    <input type="text" id="alturaCalle" class="form-control" placeholder="Altura">
                </div>
                <div class="form-group mt-2">
                <label for="pisoCliente">Piso</label>
                <input type="text" id="pisoCliente" class="form-control" placeholder="Piso">
                </div>
                <div class="form-group mt-2">
                <label for="deptoCliente">Departamento</label>
                <input type="text" id="deptoCliente" class="form-control" placeholder="Departamento">
                </div>
                <div class="form-group mt-2">
                    <label for="celularCliente">Celular</label>
                    <input type="text" id="celularCliente" class="form-control" placeholder="Celular">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="btnFinalizarCompra">Finalizar</button>
            </div>
        </div>
    </div>
</div>


    
    <!-- Tabla de productos en el carrito -->
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../dark.js"></script>
    <script>
    document.getElementById("btn-siguiente").addEventListener("click", function() {
        // Ocultar el modal personalizado del primer paso
        document.getElementById("btn-modal").checked = false;

        // Mostrar el segundo modal usando Bootstrap
        const modalCliente = new bootstrap.Modal(document.getElementById("modalCliente"));
        modalCliente.show();
    });

    document.getElementById("btnFinalizarCompra").addEventListener("click", function() {
        alert("¡Gracias por tu compra!");
        // Opcional: redirigir o reiniciar la página aquí
    });
    </script>

    <script>
            document.getElementById("btnFinalizarCompra").addEventListener("click", async function () {
            const datosCliente = {
                nombre: document.getElementById("nombreCliente").value,
                apellido: document.getElementById("apellidoCliente").value,
                localidad: document.getElementById("localidadCliente").value,
                calle: document.getElementById("direccionCliente").value,
                altura_calle: document.getElementById("alturaCalle").value,
                piso: document.getElementById("pisoCliente").value,
                depto: document.getElementById("deptoCliente").value,
                celular: document.getElementById("celularCliente").value,
            };

        try {
            const response = await fetch("procesar_cliente.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(datosCliente),
            });

            const resultado = await response.json();

            if (resultado.exito) {
                alert("¡Compra finalizada correctamente!");
                window.location.reload();
            } else {
                alert("Ocurrió un error: " + resultado.mensaje);
            }
        } catch (error) {
            console.error("Error al procesar la solicitud:", error);
            alert("Ocurrió un error al finalizar la compra.");
        }
    });

    </script>
</body>
</html>


<!-- Estilos en línea -->
<style>
    body {
        margin: 20px;
        background-color: #f9f9f9;
        margin:0;
    }

    .contenedorTabla{
        display:grid;
        place-items: center;
    }
    
    h2 {
        margin-top:20px;
        margin-bottom:20px;
        color: #333;
    }

    table {
        width: 70% !important;
        border-collapse: collapse;
        }

    th, td {
        padding: 12px;
        text-align: center!important;
        border: 1px solid #ddd;
    }

    th {
        background-color: rgb(190, 255, 125)!important;
        color: #333;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    

    

    a {
        text-decoration: none;
        color: white;
    }



    /*----------------------CARRITO------------------*/


#btn-modal{
  display: none;
}
.container-modal{
  width: 100%;
  height: 100vh;
  position: fixed;
  top: 0; left: 0;
  background-color: rgba(144, 148, 150, 0.8);
  display: none;
  justify-content: center;
  align-items: center;
  z-index: 100;
}
#btn-modal:checked ~ .container-modal{
  display: flex;
}
.content-modal{
  width: 100%;
  max-width: 400px;
  padding: 20px;
  background-color: #fff;
  border-radius: 4px;
}
.content-modal h2{
  margin-bottom: 15px;
}
.content-modal p{
  padding: 15px 0px;
  border-top: 1px solid #dbdbdb;
  border-bottom: 1px solid #dbdbdb;
}

.container .btn-cerrar{
  justify-content: flex-end;
}

.container .btn-cerrar label{
  padding: 7px 10px;
  background-color: #ff0000;
  color: #fff;
  border-radius: 4px;
  cursor: pointer;
  transition: all 300ms ease;
}


.container .btn-cerrar label:hover{
  background-color:#9c0606;
}



.container .siguiente{
  justify-content: flex-end;
}

.container .siguiente label{
  padding: 7px 10px;
  background-color: #c4ff0d;
  color: black;
  border-radius: 4px;
  cursor: pointer;
  transition: all 300ms ease;
}

.container .siguiente label:hover{
  background-color:#aee213;
}

.cerrar-modal{
  width:100%;
  height: 100vh;
  position: absolute;
  top:0; left: 0;
  z-index: -1;
}

@media screen and (max-width:800px) {
  .content-modal{
      width: 90%;
  }
}


/*---------------------------------------------------------------*/

.container {
    background-color: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 850px;
    margin: auto;
    min-width: 300px; /* Limita el tamaño mínimo del contenedor */
}
.header {
    background-color: #ccff00;
    padding: 10px;
    border-radius: 10px 10px 0 0;
    text-align: center;
    font-size: 24px;
    font-weight: bold;
}
.payment-methods {
    display: flex;
    justify-content: space-around;
    margin: 20px 0;
}
.payment-methods img {
    max-height: 40px;
}
.form-row {
    display: flex;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 15px;
}
.form-group {
    flex: 1;
    display: flex;
    flex-direction: column;
}
.form-group label {
    margin-bottom: 5px;
}
.form-group input {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: calc(100% - 20px); /* Ajusta el ancho del input */
}
.expiration-date {
    display: flex;
    gap: 10px;
}
.expiration-date input {
    width: 50%; /* Ajusta el ancho del input */
}


.botones{
    display: flex;
    justify-content: space-between;
}
</style>
