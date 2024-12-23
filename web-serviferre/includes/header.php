<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servi-Ferre</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <!-- 1º Contenedor -->
    <div class="container-fluid">
        <!-- Barra Navegación -->
        <nav class="navbar navbar-expand-lg rounded-header py-3 px-4 flex-column">
            <div class="container-fluid d-flex align-items-center justify-content-between">
                <!-- Logo y Título -->
                <a class="navbar-brand d-flex align-items-center" href="../src/index.php">
                    <img src="../img/logo.png" alt="Logo de Servi-Ferre" width="40" height="40" class="img-fluid">
                    <img src="../img/logo_horizontal.png" alt="Logo Horizontal de Servi-Ferre" width="230" height="170" class="img-fluid ms-1">
                </a>

                <!-- Botón Iniciar/Cerrar sesión -->
                <div>
                    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
                        <a href="../includes/logout.php" class="btn btn-custom-white">Cerrar Sesión</a>
                    <?php else: ?>
                        <button class="btn btn-custom-white" data-bs-toggle="modal" data-bs-target="#loginModal">Iniciar Sesión</button>
                    <?php endif; ?>
                </div>
            </div>
            <!-- Menú Navegación -->
            <div class="navbar-nav-container mt-3">
                <ul class="navbar-nav justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link" href="../src/index.php">
                            <img src="../img/icono_inicio.png" alt="Inicio" class="icon"> Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../src/servicios.php">
                            <img src="../img/icono_servicios.png" alt="Servicios" class="icon"> Servicios
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../src/tecnologias.php">
                            <img src="../img/icono_tecnologias.png" alt="Tecnologías" class="icon"> Tecnologías
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../src/contacto.php">
                            <img src="../img/icono_contacto.png" alt="Contacto" class="icon"> Contacto
                        </a>
                    </li>
                    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../src/empleados.php">
                                <img src="../img/icono_empleados.png" alt="Empleados" class="icon"> Empleados
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </div>

    <!-- Modal Login -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Inicio de Sesión</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="../includes/login.php">
                        <div class="mb-3">
                            <label for="username" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <!-- Botón centrado y tamaño intermedio -->
                        <div class="text-center">
                            <button type="submit" 
                                    class="btn btn-primary btn-medium btn-shadow" 
                                    style="background-color: #2913B0; border-color: #2913B0;">Iniciar Sesión</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
