<?php
// Incluimos los archivos necesarios
require './includes/conexion.php';
require './includes/header.php';
require './includes/data.php';

// Inicialización de arrays para las tareas según su estado
$tareas_doing = [];
$tareas_toDo = [];
$tareas_done = [];

// Obtenemos Tareas de la Base de Datos
$resultado_tareas = getTareas($db);

// Recorremos Tareas y Clasificamos según su Estado
foreach($resultado_tareas as $tarea) {
    if($tarea['estado'] == 'done') {
        array_push($tareas_done, $tarea); // Tareas Completas
    } else if ($tarea['estado'] == 'doing') {
        array_push($tareas_doing, $tarea); // Tareas en Progreso
    } else {
        array_push($tareas_toDo, $tarea); // Tareas por Hacer
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <title>Kanban de tareas</title>
    <style>
        .logo{
            width: 5rem;
            height: 5rem;
        }
    </style>
</head>

<body>
    <header class="cabecera d-flex align-items-center justify-content-center p-4">      
        <img src="./img/logo_tareas.png" class="img-fluid logo me-2" alt="Logo IES">
        <h1 class="titulo">Kanban de tareas</h1>       
    </header>

<div class="container my-5">
    <div class="row">
        <!-- Columna Tareas por Hacer (TO DO) -->
        <div class="col-md-4">
            <h2 class="text-center bg-danger text-dark p-2 rounded">TO DO</h2>
            <div class="card-columns">
                <!-- Recorremos Tareas por Hacer y las Mostramos -->
                <?php foreach($tareas_toDo as $tarea): ?>
                    <div class="card border-danger mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><?= $tarea['titulo'] ?></h5>
                            <p class="card-text"><?= $tarea['descripcion'] ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Columna Tareas en Progreso (DOING) -->
        <div class="col-md-4">
            <h2 class="text-center bg-warning text-dark p-2 rounded">DOING</h2>
            <div class="card-columns">
                <!-- Recorremos Tareas en Progreso y las Mostramos -->
                <?php foreach($tareas_doing as $tarea): ?>
                    <div class="card border-warning mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><?= $tarea['titulo'] ?></h5>
                            <p class="card-text"><?= $tarea['descripcion'] ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Columna Tareas Completadas (DONE) -->
        <div class="col-md-4">
            <h2 class="text-center bg-success text-white p-2 rounded">DONE</h2>
            <div class="card-columns">
                <!-- Recorremos Tareas Completadas y las Mostramos -->
                <?php foreach($tareas_done as $tarea): ?>
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
</div>

</body>
</html>
