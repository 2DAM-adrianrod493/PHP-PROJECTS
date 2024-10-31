<?php
    session_start();
    if (!isset($_SESSION['logueado'])) {
        header("Location: login.php");
        exit();
    }

    // Datos Alumnos
    $alumnos = [
        ["nombre" => "Alejandro Pérez", "correo" => "alepere@example.com", "curso" => "2º A"],
        ["nombre" => "Luis Miguel Fernández", "correo" => "luismfern@example.com", "curso" => "2º B"],
        ["nombre" => "Carlos Ortiz", "correo" => "carorti@example.com", "curso" => "2º A"],
    ];

    $pagina = "inicio";
    $resultado_busqueda = null;

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['buscar'])) {
        $nombre_buscar = $_POST['nombre'];
        foreach ($alumnos as $alumno) {
            if (stripos($alumno['nombre'], $nombre_buscar) !== false) {
                $resultado_busqueda = "Alumn@ {$alumno['nombre']}: está en la lista.";
                break;
            } else {
                $resultado_busqueda = "Alumn@ {$nombre_buscar}: no está en la lista.";
            }
        }
    }
?>

<?php
    // Datos Alumnos
    $alumnos = [
        ["nombre" => "Alejandro Pérez", "correo" => "alepere@example.com", "curso" => "2º A"],
        ["nombre" => "Luis Miguel Fernández", "correo" => "luismfern@example.com", "curso" => "2º B"],
        ["nombre" => "Carlos Ortiz", "correo" => "carorti@example.com", "curso" => "2º A"],
    ];

    $pagina = "inicio";
    $resultado_busqueda = null;

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['buscar'])) {
        $nombre_buscar = $_POST['nombre'];
        foreach ($alumnos as $alumno) {
            if (stripos($alumno['nombre'], $nombre_buscar) !== false) {
                $resultado_busqueda = "Alumn@ {$alumno['nombre']}: está en la lista.";
                break;
            } else {
                $resultado_busqueda = "Alumn@ {$nombre_buscar}: no está en la lista.";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Lista de Alumnos</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="./css/telita.css">
    </head>
    <body>
        <?php require 'includes/header.php'; ?>
        
        <div class="container-fluid mt-5">
            <h1 class="text-center mb-4">Alumnado</h1>

        <!-- Imágenes -->
        <div class="container">
            <div class="row justify-content-center">
                <?php
                    $directorio = "./img/";
                    $ficheros = scandir($directorio);

                    foreach ($ficheros as $file) {
                        $extension = pathinfo($file, PATHINFO_EXTENSION);
                        if ($extension == "jpg" || $extension == "jpeg" || $extension == "png") {
                            $ruta = $directorio . $file;
                            echo "<div class='col-4 text-center'>
                                <img class='img-fluid' src='$ruta' alt='$file'> 
                            </div>";
                        }
                    }
                ?>
            </div>
        </div>

            
            <!-- Cuadro de Búsqueda -->
            <form method="POST" class="row mb-3">
                <div class="col-12 col-md-10">
                    <input type="text" name="nombre" class="form-control" placeholder="Ej: Pascasio" required>
                </div>
                <div class="col-12 col-md-2">
                    <button type="submit" name="buscar" class="btn btn-primary w-100">Buscar</button>
                </div>
            </form>

            <!-- Resultado de la búsqueda -->
            <?php if ($resultado_busqueda): ?>
                <h3><?= $resultado_busqueda; ?></h3>
            <?php endif; ?>

            <!-- Tabla de Alumnos-->
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Curso</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($alumnos as $alumno): ?>
                            <tr>
                                <td><?= $alumno['nombre']; ?></td>
                                <td><?= $alumno['correo']; ?></td>
                                <td><?= $alumno['curso']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
