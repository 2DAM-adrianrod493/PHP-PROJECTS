<?php
session_start();
if (!isset($_SESSION['logueado'])) {
    header("Location: login.php");
    exit();
}

// Datos profesores
$profesores = [
    ["nombre" => "Adrián Rodríguez", "correo" => "adrirodr@example.com", "departamento" => "Informática"],
    ["nombre" => "Paula Cordero", "correo" => "paucord@example.com", "departamento" => "Informática"],
    ["nombre" => "Alejandro Delgado", "correo" => "aledelg@example.com", "departamento" => "Comercio"],
];

function array_orderby()
{
    $args = func_get_args();
    $data = array_shift($args);
    foreach ($args as $arg) {
        $sort = [];
        foreach ($data as $key => $row) {
            $sort[$key] = $row[$arg];
        }
        array_multisort($sort, $data);
    }
    return $data;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ordenar'])) {
    if ($_POST['ordenar'] == 'asc') {
        $profesores = array_orderby($profesores, 'nombre');
    } elseif ($_POST['ordenar'] == 'desc') {
        $profesores = array_reverse(array_orderby($profesores, 'nombre'));
    }
}

$pagina = "profesores";
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Lista de Profesores</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/cabecera.css">
    </head>
    <body>
        <?php require 'includes/header.php'; ?>
        
        <div class="container mt-5">
        <h1 class="text-center mb-4">Lista de Profesores</h1>
            <form method="POST">
                <button type="submit" name="ordenar" value="asc" class="btn btn-success">Ordenar A->Z</button>
                <button type="submit" name="ordenar" value="desc" class="btn btn-danger">Ordenar Z->A</button>
            </form>
            
            <div class="row mt-3">
                <?php foreach ($profesores as $profesor): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?= $profesor['nombre']; ?></h5>
                                <p class="card-text">Correo: <?= $profesor['correo']; ?></p>
                                <p class="card-text">Departamento: <?= $profesor['departamento']; ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </body>
</html>
