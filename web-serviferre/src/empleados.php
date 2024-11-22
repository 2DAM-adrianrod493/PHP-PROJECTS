<?php
include('../includes/header.php');

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: index.php");
    exit();
}
?>

<div class="container my-5">
    <h1>Nuestro Equipo</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <img src="../images/empleado1.jpg" class="card-img-top" alt="Empleado 1">
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
