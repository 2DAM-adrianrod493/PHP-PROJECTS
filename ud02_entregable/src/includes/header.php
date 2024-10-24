<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo isset($pagina) ? ucfirst($pagina) : 'ud02_entregable'; ?></title>
        <link rel="stylesheet" href="../css/cabecera.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <header class="d-flex justify-content-center">
            <h1 class="titulo">Gestión de Profesores</h1>
        </header>

        <div class="p-3">
            <ul class="nav nav-pills justify-content-between">
                <li class="nav-item">
                    <a class="nav-link <?= isset($pagina) && $pagina == "inicio" ? "active" : "" ?>" href="index.php">Alumnos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= isset($pagina) && $pagina == "profesores" ? "active" : "" ?>" href="profesores.php">Profesores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= isset($pagina) && $pagina == "login" ? "active" : "" ?>" href="login.php">Login</a>
                </li>
            </ul>
        </div>
    </body>
</html>
