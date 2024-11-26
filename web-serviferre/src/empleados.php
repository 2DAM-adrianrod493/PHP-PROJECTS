<?php
session_start(); // Asegúrate de iniciar la sesión

// Verificar si el usuario está autenticado
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    // Redirigir al inicio si no hay sesión activa
    header("Location: index.php");
    exit();
}

// Incluir el encabezado (desde includes/)
include('../includes/header.php');
?>

<div class="container my-5">
    <!-- Hero Section -->
    <div class="hero-section text-center py-5" style="color: #2913B0;">
        <h1 class="display-4 fw-bold">Nuestro Equipo</h1>
    </div>

    <!-- Row para los empleados -->
    <div class="row d-flex justify-content-center">
        <!-- Empleado 1 -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 card-custom-shadow" style="height: 400px;"> <!-- Establecer un tamaño fijo -->
                <img src="../img/empleados/lolo.jpg" class="card-img-top" alt="Empleado 1">
                <div class="card-body">
                    <h5 class="card-title" style="color: #2913B0;">Ferrera</h5>
                    <p class="card-text text-muted" style="height: 150px; overflow-y: auto;">Jefe de la Empresa, creador de la electricidad.</p>
                </div>
            </div>
        </div>

        <!-- Empleado 2 -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 card-custom-shadow" style="height: 400px;"> <!-- Establecer un tamaño fijo -->
                <img src="../img/empleados/ale.jpg" class="card-img-top" alt="Empleado 2">
                <div class="card-body">
                    <h5 class="card-title" style="color: #2913B0;">Alejandro González</h5>
                    <p class="card-text text-muted" style="height: 150px; overflow-y: auto;">Especialista soldando leds y montando cámaras.</p>
                </div>
            </div>
        </div>

                <!-- Empleado 3 -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 card-custom-shadow" style="height: 400px;"> <!-- Establecer un tamaño fijo -->
                <img src="../img/empleados/juanma.jpg" class="card-img-top" alt="Empleado 2">
                <div class="card-body">
                    <h5 class="card-title" style="color: #2913B0;">Juanma</h5>
                    <p class="card-text text-muted" style="height: 150px; overflow-y: auto;">Experto en electricidad de viviendas.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>
