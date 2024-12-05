<?php
session_start();
include('includes/data.php');

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['id_libro'])) {
    $id_libro = $_GET['id_libro'];
    $libro = obtenerLibroPorId($conexion, $id_libro);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $usuario = $_SESSION['usuario'];
        $fecha_reserva = date('Y-m-d H:i:s');
        registrarReserva($conexion, $usuario['id_usuario'], $id_libro, $fecha_reserva);
        header('Location: index.php');
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservar libro</title>
    <!-- Incluir Bootstrap CSS -->
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
            <button type="submit" class="btn btn-primary">Confirmar Reserva</button>
        </form>
    </div>

    <!-- Incluir Bootstrap JS y dependencias -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
