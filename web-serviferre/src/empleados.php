<?php
session_start();

// Verificamos si el usuario está logueado
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    // Redirigimos al Inicio si no se está logueado
    header("Location: index.php");
    exit();
}

include('../includes/header.php');
?>

<div class="container my-5">
    <!-- 1º Campo: Título -->
    <div class="hero-section text-center py-5" style="color: #2913B0;">
        <h1 class="display-4 fw-bold">Nuestro Equipo</h1>
    </div>

    <!-- 2º Campo: Empleados -->
    <div class="row d-flex justify-content-center">
        <!-- Empleado 1 -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 card-custom-shadow" style="height: 400px;">
                <div class="card-img-top-container" style="height: 180px; overflow: hidden; display: flex; justify-content: center; align-items: center;">
                    <img src="../img/empleados/lolo.jpg" class="card-img-top" alt="Empleado 1" style="max-height: 100%; max-width: 100%; object-fit: cover;">
                </div>
                <div class="card-body">
                    <h5 class="card-title" style="color: #2913B0;">Ferrera</h5>
                    <p class="card-text text-muted" style="height: 150px; overflow-y: auto;">Jefe de la Empresa, creador de la electricidad.</p>
                </div>
            </div>
        </div>

        <!-- Empleado 2 -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 card-custom-shadow" style="height: 400px;">
                <div class="card-img-top-container" style="height: 180px; overflow: hidden; display: flex; justify-content: center; align-items: center;">
                    <img src="../img/empleados/ale.jpg" class="card-img-top" alt="Empleado 2" style="max-height: 100%; max-width: 100%; object-fit: cover;">
                </div>
                <div class="card-body">
                    <h5 class="card-title" style="color: #2913B0;">Alejandro González</h5>
                    <p class="card-text text-muted" style="height: 150px; overflow-y: auto;">Especialista soldando leds y montando cámaras.</p>
                </div>
            </div>
        </div>

        <!-- Empleado 3 -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 card-custom-shadow" style="height: 400px;">
                <div class="card-img-top-container" style="height: 180px; overflow: hidden; display: flex; justify-content: center; align-items: center;">
                    <img src="../img/empleados/juanma.jpg" class="card-img-top" alt="Empleado 2" style="max-height: 100%; max-width: 100%; object-fit: cover;">
                </div>
                <div class="card-body">
                    <h5 class="card-title" style="color: #2913B0;">Juanma</h5>
                    <p class="card-text text-muted" style="height: 150px; overflow-y: auto;">Experto en electricidad de viviendas.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>
