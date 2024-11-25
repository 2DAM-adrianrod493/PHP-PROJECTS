<?php
session_start();
require './includes/conexion.php';
require './includes/data.php';
require './includes/header.php';

// Redirigir al login si no hay sesión activa
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Inicialización de arrays para las tareas
$tareas_doing = [];
$tareas_toDo = [];
$tareas_done = [];

// Obtenemos Tareas de la Base de Datos
$tareas = getTareas($db);

// Clasificamos las Tareas según su Estado
foreach ($tareas as $tarea) {
    if ($tarea['estado'] === 'done') {
        $tareas_done[] = $tarea;
    } elseif ($tarea['estado'] === 'doing') {
        $tareas_doing[] = $tarea;
    } else {
        $tareas_toDo[] = $tarea;
    }
}
?>

<div class="container my-5">
    <div class="row">
        <!-- Columna TO DO -->
        <div class="col-md-4">
            <h2 class="text-center bg-danger text-white p-2 rounded">TO DO</h2>
            <?php foreach ($tareas_toDo as $tarea): ?>
                <div class="card border-danger mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><?= $tarea['titulo'] ?></h5>
                        <p class="card-text"><?= $tarea['descripcion'] ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Columna DOING -->
        <div class="col-md-4">
            <h2 class="text-center bg-warning text-dark p-2 rounded">DOING</h2>
            <?php foreach ($tareas_doing as $tarea): ?>
                <div class="card border-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><?= $tarea['titulo'] ?></h5>
                        <p class="card-text"><?= $tarea['descripcion'] ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Columna DONE -->
        <div class="col-md-4">
            <h2 class="text-center bg-success text-white p-2 rounded">DONE</h2>
            <?php foreach ($tareas_done as $tarea): ?>
                <div class="card border-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><?= $tarea['titulo'] ?></h5>
                        <p class="card-text"><?= $tarea['descripcion'] ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
</body>
</html>
