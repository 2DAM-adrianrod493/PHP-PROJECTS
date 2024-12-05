<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

<header>
    <div class="container-fluid" style="background-color: #fd995b; color: white; padding: 15px;">
        <div class="row align-items-center">
            <!-- Título e Imagen -->
            <div class="col-6 d-flex align-items-center">
                <!-- Logo -->
                <img src="./img/logo-biblio.png" alt="Logo Biblioteca" style="width: 50px; height: auto; margin-right: 15px;">
                <h1 class="mb-0">Biblioteca Virtual</h1>
            </div>

            <!-- Sesión -->
            <div class="col-6 text-end">
                <?php if (isset($_SESSION['id_usuario'])): ?>
                    <a href="logout.php" class="btn btn-danger">Cerrar sesión</a>
                <?php else: ?>
                    <!-- Login Modal -->
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">Iniciar sesión</button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>

<!-- Modal Iniciar Sesión -->
<?php if (!isset($_SESSION['id_usuario'])): ?>
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Iniciar Sesión</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="login.php" method="POST">
                    <div class="mb-3">
                        <label for="nombre_usuario" class="form-label">Nombre de Usuario</label>
                        <input type="text" id="nombre_usuario" name="nombre_usuario" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
