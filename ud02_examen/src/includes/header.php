<?php
    // Login
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Aseguramos que "$pagina" esté disponible
    if (!isset($pagina)) {
        $pagina = basename($_SERVER['PHP_SELF']);
    }

    // Título dependiendo de la página
    switch ($pagina) {
        case 'login.php':
            $titulo = 'Login';
            break;
        case 'eventos.php':
            $titulo = 'Eventos';
            break;
        case 'galeria.php':
            $titulo = 'Galería';
            break;
        default:
            $titulo = 'PlanificaT';
            break;
    }
?>

<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PlanificaT</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/cabecera.css">
    </head>

    <body>
        <header class="d-flex justify-content-center">
            <img class='img-fluid' src='./img/logo_eventos.png' style='max-width: 100px; height: auto;'>
            <h1 class="titulo">PlanificaT</h1>
        </header>

        <div class="p-3">
            <ul class="nav nav-pills justify-content-between">
                <li class="nav-item">
                    <a class="nav-link <?= isset($pagina) && $pagina == "eventos.php" ? "active" : "" ?>" href="eventos.php">Eventos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= isset($pagina) && $pagina == "galeria.php" ? "active" : "" ?>" href="galeria.php">Galería</a>
                </li>
            </ul>
        </div>
    </body>

</html>