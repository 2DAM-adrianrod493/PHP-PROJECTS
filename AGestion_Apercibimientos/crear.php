<?php
session_start();
require './includes/conexion.php';

// Insertar Nuevo Apercibimiento
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $fecha = $_POST['fecha'];
    $motivo = $_POST['motivo'];
    $estado = $_POST['estado'];

    $query = "INSERT INTO apercibimientos (nombre, fecha, motivo, estado) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('ssss', $nombre, $fecha, $motivo, $estado);

    if ($stmt->execute()) {
        header('Location: index.php');
        exit();
    } else {
        echo "Error al crear el Apercibimiento.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Apercibimiento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Registrar Nuevo Apercibimiento</h1>

        <form>
            <!-- Selector de Alumno -->
            <div class="mb-3">
                <label for="alumno" class="form-label">Alumno</label>
                <select name="alumno" class="form-select" required>
                    <?php foreach ($alumnos as $alumno): ?>
                    <option value="<?= htmlspecialchars($alumno['alumno_id']) ?>">
                        <?= htmlspecialchars($alumno['nombre']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Fecha -->
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" name="fecha" class="form-control" id="fecha" required>
            </div>

            <!-- Motivo -->
            <div class="mb-3">
                <label for="motivo" class="form-label">Motivo</label>
                <input type="text" name="motivo" class="form-control" id="motivo" required>
            </div>

            <!-- Estado -->
            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select name="estado" id="estado" class="form-select" required>
                    <option value="" disabled selected>Seleccione un Estado</option>
                    <option value="pendiente">Pendiente</option>
                    <option value="resuelto">Resuelto</option>
                </select>
            </div>

            <!-- Botón Guardar -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary" style="background-color: #111111; 
                                                                            border-color: #999999; 
                                                                            color: #ffffff; 
                                                                            width: 100%; 
                                                                            border-radius: 15px; 
                                                                            border-width: 2px;">Guardar
                    Apercibimiento</button>
                <a class="btn btn-secondary" style="background-color: #111111; 
                                                                            border-color: #999999; 
                                                                            color: #ffffff; 
                                                                            width: 100%; 
                                                                            border-radius: 15px; 
                                                                            border-width: 2px;">Cancelar</a>
            </div>
        </form>
    </div>
</body>

</html>