<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Web Personal</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="../css/cabecera.css">

    </head>
    <body>

        <header class="d-flex justify-content-center bg-success-subtle text-success-emphasis">
            <h1 class="titulo">Adrián Rodríguez Rodríguez</h1>
        </header>

        <div class="p-3">
            <ul class="nav nav-pills justify-content-between">
                <li class="nav-item">
                    <a class="nav-link <?=$pagina == "inicio" ? "active" : "" ?>" aria-current="page" href="index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?=$pagina == "proyectos" ? "active" : "" ?>" href="proyectos.php">Proyectos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?=$pagina == "sobremi" ? "active" : "" ?>" href="sobremi.php">Sobre Mí</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?=$pagina == "contacto" ? "active" : "" ?>" href="contacto.php">Contacto</a>
                </li>
            </ul>
        </div>

    </body>
</html>