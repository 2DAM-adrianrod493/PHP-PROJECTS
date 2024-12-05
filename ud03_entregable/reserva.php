<?php
session_start();
include('includes/data.php');

// Vemos si el Usuario está Logueado
if (!isset($_SESSION['id_usuario'])) {
    header('Location: login.php');
    exit();
}

// Vemos si se Recibe el ID del Libro
if (isset($_GET['id_libro']) && isset($_GET['titulo']) && isset($_GET['autor']) && isset($_GET['categoria'])) {
    $id_libro = $_GET['id_libro'];
    $titulo = $_GET['titulo'];
    $autor = $_GET['autor'];
    $categoria = $_GET['categoria'];

    // Verificamos que se Haya Enviado el Formulario
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $fecha_reserva = isset($_POST['fecha_reserva']) ? $_POST['fecha_reserva'] : null;
        $usuario_id = $_SESSION['id_usuario'];
    
        // Registrar Reserva
        registrarReserva($conexion, $usuario_id, $id_libro, $fecha_reserva);
    
        // Actualizamos Disponibilidad del Libro
        actualizarDisponibilidadLibro($conexion, $id_libro, 0);
    
        header('Location: index.php');
        exit();
    }
    
} else {
    // Si no se Recibe el ID de Libro, Redirigimos al Index
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
        <h2>Reservar: <?= $titulo ?></h2>
        <!-- Formulario de Reserva -->
        <form method="POST">
            <div class="mb-3">
                <label for="autor" class="form-label">Autor</label>
                <input type="text" class="form-control" value="<?= $autor ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoría</label>
                <input type="text" class="form-control" value="<?= $categoria ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="fecha_reserva" class="form-label">Fecha de reserva</label>
                <!-- La Fecha no es Obligatoria -->
                <input type="date" class="form-control" name="fecha_reserva" id="fecha_reserva">
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
