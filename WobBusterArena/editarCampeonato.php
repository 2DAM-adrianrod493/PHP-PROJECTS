<?php
session_start();
require './includes/data.php';

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'administrador') {
    header("Location: index.php");
    exit;
}

if (isset($_GET['id_campeonato'])) {
    $id_campeonato = $_GET['id_campeonato'];
    $campeonato = obtenerCampeonatoPorID($conexion, $id_campeonato);

    if (!$campeonato) {
        echo "Campeonato no encontrado.";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $fecha = $_POST['fecha'];
    $provincia = $_POST['provincia'];
    $cerrado = $_POST['cerrado'];
    $imagen = $_FILES['imagen'];

    // Procesar la imagen
    if ($imagen['error'] == 0) {
        $imagenNombre = uniqid() . '_' . $imagen['name'];
        move_uploaded_file($imagen['tmp_name'], 'img/' . $imagenNombre);
    } else {
        $imagenNombre = $campeonato['imagen']; // Mantener la imagen existente
    }

    // Actualizar campeonato
    $query = "UPDATE campeonatos SET nombre = ?, fecha = ?, provincia = ?, imagen = ?, cerrado = ? WHERE id_campeonato = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("ssssii", $nombre, $fecha, $provincia, $imagenNombre, $cerrado, $id_campeonato);
    
    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error al actualizar el campeonato.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Campeonato</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include('includes/header.php'); ?>

    <div class="container mt-5">
        <h1>Editar Campeonato</h1>
        <form action="editarCampeonato.php?id_campeonato=<?= $campeonato['id_campeonato'] ?>" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Campeonato</label>
                <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($campeonato['nombre']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha del Campeonato</label>
                <input type="date" name="fecha" class="form-control" value="<?= htmlspecialchars($campeonato['fecha']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="provincia" class="form-label">Provincia</label>
                <input type="text" name="provincia" class="form-control" value="<?= htmlspecialchars($campeonato['provincia']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen del Campeonato</label>
                <input type="file" name="imagen" class="form-control">
            </div>
            <div class="mb-3">
                <label for="cerrado" class="form-label">Registro Cerrado</label>
                <select name="cerrado" class="form-select" required>
                    <option value="0" <?= $campeonato['cerrado'] == 0 ? 'selected' : '' ?>>No</option>
                    <option value="1" <?= $campeonato['cerrado'] == 1 ? 'selected' : '' ?>>Sí</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Campeonato</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
</body>
</html>
