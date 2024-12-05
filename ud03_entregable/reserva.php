<?php
session_start();
include('includes/data.php');

if (!isset($_SESSION['id_usuario'])) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['id_libro'])) {
    $id_libro = $_GET['id_libro'];
    $libro = obtenerLibroPorId($conexion, $id_libro);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $fecha_reserva = isset($_POST['fecha_reserva']) ? $_POST['fecha_reserva'] : null;
        $usuario_id = $_SESSION['id_usuario'];

        // Registrar la reserva
        registrarReserva($conexion, $usuario_id, $id_libro, $fecha_reserva);

        // Actualizar la disponibilidad del libro
        actualizarDisponibilidadLibro($conexion, $id_libro, 0);  // Cambiar disponibilidad a 0 (reservado)

        // Redirigir a la página principal
        header('Location: index.php');
        exit();
    }
} else {
    // Si no se pasa un ID de libro, redirigir a la página principal
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservar libro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include('includes/header.php'); ?>

    <div class="container mt-5">
        <h2>Reservar: <?= $libro['titulo'] ?></h2>
        <form method="POST">
            <div class="mb-3">
                <label for="autor" class="form-label">Autor</label>
                <input type="text" class="form-control" value="<?= $libro['autor'] ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoría</label>
                <input type="text" class="form-control" value="<?= $libro['categoria'] ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="fecha_reserva" class="form-label">Fecha de reserva</label>
                <input type="date" class="form-control" name="fecha_reserva" id="fecha_reserva">
                <!-- Este campo no es obligatorio, por lo tanto el usuario puede dejarlo en blanco -->
            </div>
            <button type="submit" class="btn btn-primary">Confirmar Reserva</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
