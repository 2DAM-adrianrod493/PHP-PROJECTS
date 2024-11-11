<?php
    // Login
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Nos aseguramos de que "$pagina" está disponible
    if (!isset($pagina)) {
        $pagina = basename($_SERVER['PHP_SELF']);
    }

    // Título dependiendo de la página
    switch ($pagina) {
        case 'index.php':
            $titulo = 'Gestión de Alumnos';
            break;
        case 'profesores.php':
            $titulo = 'Gestión de Profesores';
            break;
        case 'alumnos.php':
            $titulo = 'Gestión de Alumnos';
            break;
        case 'alta.php':
            $titulo = 'Alta Usuarios';
            break;
        case 'login.php':
            $titulo = 'Login';
            break;
        case 'excursiones.php':
            $titulo = 'Gestión de Galería';
            break;
        default:
            $titulo = 'Página Principal';
            break;
    }
?>

<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $titulo; ?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/cabecera.css">
    </head>

    <body>
        <header class="d-flex justify-content-center">
            <h1 class="titulo"><?php echo $titulo; ?></h1>
        </header>

        <div class="p-3">
            <ul class="nav nav-pills justify-content-between">
                <li class="nav-item">
                    <a class="nav-link <?= isset($pagina) && $pagina == "index.php" ? "active" : "" ?>" href="index.php">Alumnos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= isset($pagina) && $pagina == "profesores.php" ? "active" : "" ?>" href="profesores.php">Profesores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= isset($pagina) && $pagina == "alta.php" ? "active" : "" ?>" href="alta.php">Alta Usuarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= isset($pagina) && $pagina == "excursiones.php" ? "active" : "" ?>" href="excursiones.php">Galería</a>
                </li>
            </ul>
        </div>
    </body>

</html>