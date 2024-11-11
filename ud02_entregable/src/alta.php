<?php
    // Login
    session_start();
    if (!isset($_SESSION['logueado'])) {
        header("Location: login.php");
        exit();
    }

    // Tipo de Usuario
    $tipo_usuario = isset($_GET['tipo_usuario']) ? $_GET['tipo_usuario'] : null;

    // Vemos si se clica en "Crear"
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['crear'])) {
        // Vemos si se selecciona un tipo de Usuario, si no, da Error
        if (!isset($_GET['tipo_usuario'])) {
            $error = "Por favor, selecciona un tipo de usuario."; // ERROR
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

            <!-- Tipo de Usuario -->
            <form method="GET">
                <div class="mb-3">
                    <label for="tipo_usuario" class="form-label">Selecciona el tipo de usuario que desea dar de
                        alta:</label>
                    <select class="form-select" id="tipo_usuario" name="tipo_usuario" required>
                        <option value="">Elige...</option>
                        <option value="alumno">Alumno</option>
                        <option value="profesor">Profesor</option>
                    </select>
                </div>
                <!-- Botón Crear Usuario -->
                <button type="submit" name="crear" class="btn btn-primary">Crear</button>
            </form>

            <!-- Si se elige el tipo de usuario, se muestra el resto del formulario -->
            <?php if ($tipo_usuario): ?>
            <form method="POST" class="mt-4">
                <!-- Título sobre los Datos dependiendo del tipo de Usuario -->
                <h3>Datos del <?= ucfirst($tipo_usuario); ?></h3>

                <!-- Nombre -->
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>

                <!-- Correo -->
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo</label>
                    <input type="email" class="form-control" id="correo" name="correo" required>
                </div>

                <!-- Si el tipo de usuario es Alumno, muestra "Curso" -->
                <?php if ($tipo_usuario === 'alumno'): ?>
                <div class="mb-3">
                    <label class="form-label">Curso</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="curso" id="curso1" value="1º DAM" required>
                        <label class="form-check-label" for="curso1">1º DAM</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="curso" id="curso2" value="2º DAM" required>
                        <label class="form-check-label" for="curso2">2º DAM</label>
                    </div>
                </div>

                <?php else: ?>
                <!-- Si el tipo de usuario es Profesor, muestra "Departamento" -->
                <div class="mb-3">
                    <label class="form-label">Departamento</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="departamento" id="comercio" value="Comercio"
                            required>
                        <label class="form-check-label" for="comercio">
                            Comercio
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="departamento" id="informatica"
                            value="Informática" required>
                        <label class="form-check-label" for="informatica">
                            Informática
                        </label>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Botón Registrar -->
                <button type="submit" class="btn btn-success">Registrar</button>
            </form>
            <?php endif; ?>
        </div>
    </body>

</html>