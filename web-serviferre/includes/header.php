<?php
// Iniciar sesión sólo si no está activa
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
    <!-- Estilo personalizado -->
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <!-- Contenedor principal -->
    <div class="container-fluid">
        <!-- Barra de navegación -->
        <nav class="navbar navbar-expand-lg rounded-header py-3 px-4">
            <div class="container-fluid d-flex align-items-center justify-content-between">
                <!-- Logo y título -->
                <a class="navbar-brand d-flex align-items-center" href="../src/index.php">
                    <img src="../img/logo.png" alt="Logo de Servi-Ferre" width="40" height="40" class="me-2">
                    <span class="fs-4">Servi-Ferre</span>
                </a>

                <!-- Botón de Iniciar/Cerrar sesión -->
                <div>
                    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
                        <a href="../includes/logout.php" class="btn btn-custom-white">Cerrar Sesión</a>
                    <?php else: ?>
                        <button class="btn btn-custom-white" data-bs-toggle="modal" data-bs-target="#loginModal">Iniciar Sesión</button>
                    <?php endif; ?>
                </div>
            </div>
            <!-- Menú de navegación centrado -->
            <div class="navbar-collapse justify-content-center mt-3 mt-lg-0" id="navbarNav">
                <ul class="navbar-nav">
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
        <!-- Fin de la barra de navegación -->
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
                        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Modal Login -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
