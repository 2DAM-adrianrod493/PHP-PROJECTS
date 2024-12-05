<?php
// Verificar si la sesión ya ha sido iniciada para evitar el error
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!-- Incluir Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

<header>
    <div class="container-fluid bg-primary text-white p-3">
        <div class="row align-items-center">
            <!-- Columna para la imagen y el título -->
            <div class="col-6 d-flex align-items-center">
                <!-- Imagen del logo a la izquierda del título -->
                <img src="../img/logo-biblio.png" alt="Logo Biblioteca" style="width: 50px; height: auto; margin-right: 15px;">
                <h1 class="mb-0">Biblioteca Virtual</h1>
            </div>

            <!-- Columna para el enlace de sesión -->
            <div class="col-6 text-end">
                <?php if (isset($_SESSION['id_usuario'])): ?>
                    <a href="logout.php" class="btn btn-danger">Cerrar sesión</a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-primary">Iniciar sesión</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>
