<?php
session_start();
if (!isset($_SESSION['logueado'])) {
    header("Location: login.php");
    exit();
}

$tipo_usuario = isset($_GET['tipo_usuario']) ? $_GET['tipo_usuario'] : null;

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['crear'])) {
    if (!isset($_GET['tipo_usuario'])) {
        $error = "Por favor, selecciona un tipo de usuario.";
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/cabecera.css">
</head>
<body>
    <?php require 'includes/header.php'; ?>
    
    <div class="container mt-5">
        <h1 class="text-center mb-4">Alta de Usuarios</h1>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error; ?></div>
        <?php endif; ?>

        <form method="GET">
            <div class="mb-3">
                <label for="tipo_usuario" class="form-label">Selecciona el tipo de usuario</label>
                <select class="form-select" id="tipo_usuario" name="tipo_usuario" required>
                    <option value="">Seleccione...</option>
                    <option value="alumno">Alumno</option>
                    <option value="profesor">Profesor</option>
                </select>
            </div>
            <button type="submit" name="crear" class="btn btn-primary">Crear</button>
        </form>

        <?php if ($tipo_usuario): ?>
            <form method="POST" class="mt-4">
                <h3>Datos del <?= ucfirst($tipo_usuario); ?></h3>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo</label>
                    <input type="email" class="form-control" id="correo" name="correo" required>
                </div>
                <?php if ($tipo_usuario === 'alumno'): ?>
                    <div class="mb-3">
                        <label for="curso" class="form-label">Curso</label>
                        <select class="form-select" id="curso" name="curso" required>
                            <option value="">Seleccione...</option>
                            <option value="1º DAM">1º DAM</option>
                            <option value="2º DAM">2º DAM</option>
                        </select>
                    </div>
                <?php else: ?>
                    <div class="mb-3">
                        <label for="departamento" class="form-label">Departamento</label>
                        <select class="form-select" id="departamento" name="departamento" required>
                            <option value="">Seleccione...</option>
                            <option value="Comercio">Comercio</option>
                            <option value="Informática">Informática</option>
                        </select>
                    </div>
                <?php endif; ?>
                <button type="submit" class="btn btn-success">Registrar</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>