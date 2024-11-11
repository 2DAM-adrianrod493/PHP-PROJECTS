<?php
    // Login
    session_start();
    if (!isset($_SESSION['logueado'])) {
        header("Location: login.php");
        exit();
    }

    // Datos Alumnos
    $alumnos = [
        ["id" => 1, "nombre" => "Alejandro Pérez", "correo" => "alepere@gmail.com", "curso" => "2º A"],
        ["id" => 2, "nombre" => "Luis Miguel Fernández", "correo" => "luifern@gmail.com", "curso" => "2º B"],
        ["id" => 3, "nombre" => "Carlos Ortiz", "correo" => "carorti@gmail.com", "curso" => "2º A"],
    ];

    $resultado_busqueda = null;

    // Descargar TODOS los Alumnos
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['descargar_todos'])) {
        // Ruta de Descarga
        $ruta_archivo = './src/files_loaded/todos_alumnos.txt';
        
        // Creamos y abrimos el archivo de texto
        $archivo = fopen($ruta_archivo, 'w');
        
        // Escribimos toda la info de los Alumnos en el txt
        foreach ($alumnos as $alumno) {
            fwrite($archivo, "Nombre: {$alumno['nombre']}, Correo: {$alumno['correo']}, Curso: {$alumno['curso']}\n");
        }
        
        // Cerramos el archivo
        fclose($archivo);
        
        // Forzamos la descarga
        header('Content-Type: text/plain');
        header('Content-Disposition: attachment; filename="todos_alumnos.txt"');
        readfile($ruta_archivo);
        exit();
    }

    // Descargamos la info de un alumno en específico
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['export_single'])) {
        $alumno_id = $_POST['alumno_id'];
        
        // Buscamos el alumno por su ID
        $alumno = null;
        foreach ($alumnos as $a) {
            if ($a['id'] == $alumno_id) {
                $alumno = $a;
                break;
            }
        }
        
        if ($alumno) {
            // Ruta de Descarga
            $ruta_archivo = './src/files_loaded/alumno_' . $alumno_id . '.txt';
            
            // Creamos y abrimos el archivo de texto
            $archivo = fopen($ruta_archivo, 'w');
            
            // Escribimos la información del alumno en el txt
            fwrite($archivo, "Nombre: {$alumno['nombre']}, Correo: {$alumno['correo']}, Curso: {$alumno['curso']}\n");
            
            // Cerramos el archivo
            fclose($archivo);
            
            // Forzamos la descarga
            header('Content-Type: text/plain');
            header('Content-Disposition: attachment; filename="alumno_' . $alumno_id . '.txt"');
            readfile($ruta_archivo);
            exit();
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
        <link rel="stylesheet" href="../css/cabecera.css">
    </head>

    <body>
        <?php require 'includes/header.php'; ?>

        <div class="container-fluid mt-5">
            <h1 class="text-center mb-4">Alumnado</h1>

            <!-- Imágenes 
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
                                        <img class='img-fluid' src='$ruta' alt='$file' style='max-width: 100px; height: auto;'> 
                                    </div>";
                            }
                        }
                        ?>
                </div>
            </div>
            -->

            <!-- Cuadro de Búsqueda -->
            <form method="POST" class="row mb-3">
                <div class="col-12 col-md-10">
                    <input type="text" name="nombre" class="form-control" placeholder="Ej: Pascasio" required>
                </div>
                <div class="col-12 col-md-2">
                    <button type="submit" name="buscar" class="btn btn-primary w-100">Buscar</button>
                </div>
            </form>

            <!-- Resultado de Búsqueda -->
            <?php if ($resultado_busqueda): ?>
            <h3><?= $resultado_busqueda; ?></h3>
            <?php endif; ?>

            <!-- Formulario Descargar todos los Alumnos -->
            <form method="POST">
                <button type="submit" name="descargar_todos" class="btn btn-primary w-100">
                    Descargar Todo
                </button>
            </form>

            <!-- Tabla de Alumnos-->
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Curso</th>
                            <th>Descargar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($alumnos as $alumno): ?>
                        <tr>
                            <td><?= $alumno['nombre']; ?></td>
                            <td><?= $alumno['correo']; ?></td>
                            <td><?= $alumno['curso']; ?></td>
                            <td>
                                <!-- Botón de descarga de cada Alumno -->
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="alumno_id" value="<?= $alumno['id']; ?>">
                                    <button type="submit" name="export_single" class="btn btn-info">↓ Descargar</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>

</html>