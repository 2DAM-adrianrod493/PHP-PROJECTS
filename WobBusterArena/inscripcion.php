<?php
session_start();
include('includes/data.php');

// Vemos si el Usuario está Logueado
if (!isset($_SESSION['id_usuario'])) {
    header('Location: login.php');
    exit();
}

// Vemos si se Recibe el ID del Campeonato
if (isset($_GET['id_campeonato']) && isset($_GET['nombre']) && isset($_GET['fecha']) && isset($_GET['provincia'])) {
    $id_campeonato = $_GET['id_campeonato'];
    $nombre = $_GET['nombre'];
    $fecha = $_GET['fecha'];
    $provincia = $_GET['provincia'];

    // Verificamos que se Haya Enviado el Formulario
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : null;
        $usuario_id = $_SESSION['id_usuario'];
    
        // Registrar Reserva
        inscribirse($conexion, $usuario_id, $id_campeonato, $fecha);
    
        // Actualizamos Disponibilidad del Libro
        actualizarDisponibilidadCampeonato($conexion, $id_campeonato, 0);
    
        header('Location: index.php');
        exit();
    }
    
} else {
    // Si no se Recibe el ID de Campeonato, Redirigimos al Index
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscribirse en Campeonato</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include('includes/header.php'); ?>

    <div class="container mt-5">
        <h2>Inscribirse: <?= $nombre ?></h2>
        <!-- Formulario de Inscripción -->
        <form method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" value="<?= $nombre ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="provincia" class="form-label">Provincia</label>
                <input type="text" class="form-control" value="<?= $provincia ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha de Inscripción</label>
                <input type="date" class="form-control" name="fecha" id="fecha">
            </div>
            <button type="submit"
                    class="btn" 
                    style="background-color: #352012;
                    border-color: #FFFFFF; 
                    color: #ffffff; 
                    width: 100%; 
                    border-radius: 15px; 
                    border-width: 2px;">Confirmar Reserva</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
