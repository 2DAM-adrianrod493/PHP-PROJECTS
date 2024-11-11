<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Asegurarnos de que `$pagina` está disponible
if (!isset($pagina)) {
    $pagina = basename($_SERVER['PHP_SELF']); // Si no está definida, la obtenemos aquí
}

// Establecer el título dependiendo de la página
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
        $titulo = 'Alta';
        break;
    case 'login.php':
        $titulo = 'Login';
        break;
    case 'excursiones.php':  // Añadir el caso para la página de excursiones
        $titulo = 'Excursiones';
        break;
    default:
        $titulo = 'Página Principal'; // Valor por defecto
        break;
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $titulo; ?></title>
        <link rel="stylesheet" href="../css/cabecera.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
                    <a class="nav-link <?= isset($pagina) && $pagina == "alta.php" ? "active" : "" ?>" href="alta.php">Alta</a>
                </li>
                <!-- Nueva pestaña para Excursiones -->
                <li class="nav-item">
                    <a class="nav-link <?= isset($pagina) && $pagina == "excursiones.php" ? "active" : "" ?>" href="excursiones.php">Excursiones</a>
                </li>
            </ul>
        </div>
    </body>
</html>
