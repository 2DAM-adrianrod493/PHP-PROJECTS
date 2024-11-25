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
    <h1>Nuestro Equipo</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <img src="../img/empleado1.jpg" class="card-img-top" alt="Empleado 1">
                <div class="card-body">
                    <h5 class="card-title">Juan Pérez</h5>
                    <p class="card-text">Especialista en redes y sistemas de seguridad.</p>
                </div>
            </div>
        </div>
        <!-- Agrega más empleados aquí -->
    </div>
</div>

<?php include('../includes/footer.php'); ?>
