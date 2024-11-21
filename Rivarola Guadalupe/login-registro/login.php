<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="style.css" />
    <title>Sign in & Sign up Form</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form method="post" action="../php/iniciar_sesion.php" class="sign-in-form">
            <h2 class="title">Iniciar Sesión</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Usuario" name="usuario" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Contraseña" name="pwd"/>
            </div>           
            <input type="submit" value="Login" class="btn solid" />
            <!--<p class="social-text">O ingresa con una red social</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>-->
          </form>
          <form method="post" action="../php/guardar_us.php" class="sign-up-form">
            <h2 class="title">Regístrate</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Usuario" name="usuario" />
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" placeholder="Email"  name="correo"/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Contraseña" name="pwd"/>
            </div>
            <input type="submit" class="btn" value="Registrar" />
            <!--<p class="social-text">O registrate con una red social</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div> -->
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>¿Sos nuevo?</h3>
            <p>
              Bienvenido a la tienda online de OWN. Registrate y empezá a vestirte con estilo.
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>
          </div>
          <img src="img/log.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>Ya tenes una cuenta?</h3>
            <p>
              Iniciá sesion con tu cuenta recien creada para poder usar todas las funciones de la página!
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
          <img src="img/register.svg" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="app.js"></script>
    <script>
  // Función para obtener parámetros de la URL
  function getQueryParam(param) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(param);
  }

  // Mostrar alerta si hay un mensaje de error
  const error = getQueryParam('error');
  if (error) {
    let mensaje = '';
    if (error === 'campos_vacios') {
      mensaje = 'Por favor, completa todos los campos.';
    } else if (error === 'datos_incorrectos') {
      mensaje = 'Usuario o contraseña incorrectos.';
    } else {
      mensaje = 'Ha ocurrido un error desconocido.';
    }
    alert(mensaje);
  }
</script>

  </body>
</html>