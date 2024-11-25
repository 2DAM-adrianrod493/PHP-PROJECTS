<?php
session_start();
require './includes/conexion.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $fecha_entrega = $_POST['fecha_entrega'];
    $estado = $_POST['estado'];

    $query = "UPDATE tareas 
              SET titulo = '$titulo', descripcion = '$descripcion', fecha_entrega = '$fecha_entrega', estado = '$estado' 
              WHERE id = $id";
    if (mysqli_query($db, $query)) {
        header("Location: index.php");
        exit();
    } else {
        $error = "Error al actualizar la tarea.";
    }
}

// Obtenemos los datos de la tarea a editar
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM tareas WHERE id = $id";
    $result = mysqli_query($db, $query);
    $tarea = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h2 class="text-center">Editar Tarea</h2>
    <?php if (isset($error)): ?>
        <p class="text-danger text-center"><?= $error ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?= $tarea['id'] ?>">
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" id="titulo" name="titulo" class="form-control" value="<?= $tarea['titulo'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea id="descripcion" name="descripcion" class="form-control" required><?= $tarea['descripcion'] ?></textarea>
        </div>
        <div class="mb-3">
            <label for="fecha_entrega" class="form-label">Fecha de Entrega</label>
            <input type="date" id="fecha_entrega" name="fecha_entrega" class="form-control" value="<?= $tarea['fecha_entrega'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select id="estado" name="estado" class="form-control">
                <option value="toDo" <?= $tarea['estado'] === 'toDo' ? 'selected' : '' ?>>TO DO</option>
                <option value="doing" <?= $tarea['estado'] === 'doing' ? 'selected' : '' ?>>DOING</option>
                <option value="done" <?= $tarea['estado'] === 'done' ? 'selected' : '' ?>>DONE</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
