<?php
// Asegúrate de incluir la función session_start() antes de usar las variables de sesión
session_start();

// Función para cerrar la sesión
function cerrarSesion() {
    // Destruye la sesión
    session_destroy();

    // Redirige al usuario a la página de inicio de sesión
    header("Location: /login/login.html");
    exit();
}

if (isset($_GET['logout'])) {
    cerrarSesion();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/style.css">
    <title>FixerGo</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="#">
            <img class="nav-position" src="/img/nombre sin fondo.png" alt="nombre_logo" width="150">
        </a>
        
        <!-- Botón para activar el menú en dispositivos móviles -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Contenido del navbar -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarContent">
            <!-- Buscador centrado -->
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search Service" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
        
        <!-- Dropdown de usuario -->
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    ¡Hola, <?php echo $_SESSION['user_name']; ?>!
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="#">Correo Electrónico: <?php echo $_SESSION['user_email']; ?></a></li>
                    <li><a class="dropdown-item" href="#">Ubicación: <?php echo $_SESSION['user_location']; ?></a></li>
                    <li><a class="dropdown-item" href="#">Tipo de Cuenta: <?php echo ($_SESSION['account_type'] === 1) ? 'TRABAJADOR' : 'CLIENTE'; ?></a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item btn btn-danger" href="?logout=true">Cerrar sesión</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>












    <br>
    <div class="container">
    <?php
    
    if (isset($_SESSION['account_type'])) {
        $accountType = $_SESSION['account_type'];

      

       
        if ($accountType === 1) {
            echo '
                <div class="text-end crear-publicacion-btn" id="crearPublicacionBtn">
                    <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#crearPublicacionModal">
                        <i class="bi bi-plus"></i> Crear Publicación
                    </button>
                </div>
            ';
        }
    }
    ?>
    </div>

    

    <div id="publicacion"></div>

    <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="messageModalLabel">New Message</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Send a message to <span id="destinatarioNombre"></span>:</p>
        <textarea id="mensajeTexto" class="form-control" rows="4" placeholder="Type your message here..."></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-success me-2" >ENVIAR MENSAJE <i class="bi bi-send-fill"></i></button><br>

        <!-- Agregar esto antes de la inclusión de app.js o en una etiqueta <script> -->
<script>
  // Obtén el ID del usuario desde $_SESSION['user_id'] y asígnalo a una variable de JavaScript
  let remitenteId = <?php echo $_SESSION['user_id']; ?>;
</script>






      </div>
    </div>
  </div>
</div>


    <div class="modal fade" id="crearPublicacionModal" tabindex="-1" aria-labelledby="crearPublicacionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="crearPublicacionModalLabel">Crear Publicación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="crearPublicacionForm" action="publicaciones.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="precio" class="form-label">Precio</label>
                            <input type="text" class="form-control" id="precio" name="precio" required>
                        </div>
                        <div class="mb-3">
                            <label for="img" class="form-label">Imagen</label>
                            <input type="file" class="form-control" id="img" name="img" required>
                        </div>
                        <div class="mb-3">
                            <label for="img2" class="form-label">Imagen 2</label>
                            <input type="file" class="form-control" id="img2" name="img2" required>
                        </div>
                        <div class="mb-3">
                            <label for="img3" class="form-label">Imagen 3</label>
                            <input type="file" class="form-control" id="img3" name="img3" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="num_compl" class="form-label">Número de Completados</label>
                            <input type="text" class="form-control" id="num_compl" name="num_compl" required>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary"><i class="bi bi-plus"></i> Crear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="//code.tidio.co/fqn9rravvspjdo3x48tpno9qzh7pde0i.js" async></script>
    <script src="/js/app.js"></script>
</body>
</html>
