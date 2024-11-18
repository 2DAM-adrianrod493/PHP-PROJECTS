<?php
    // Login
    session_start();
    if (!isset($_SESSION['logueado'])) {
        header("Location: login.php");
        exit();
    }

    /*
    $imagen_id = $_POST['imagen_id'];

    // Buscamos Imagen por ID
    $imagen = null;
    foreach ($imagenes as $a) {
        if ($a['id'] == $imagen_id) {
            $imagen = $a;
            break;
        }
    }
    */
    // Ruta Imágenes
    $directorioActualizado = 'img/';

    // Vemos si se ha subido una imagen
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $archivo = $_FILES['imagen'];
        $extensionArchivo = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));
        $extensionesValidas = ['png', 'jpg', 'jpeg'];

        if (in_array($extensionArchivo, $extensionesValidas)) {
            // ID Nombre del Archivo
            $idImagen = uniqid() . '.' . $extensionArchivo;
            $rutaActualizada = $directorioActualizado . $idImagen;

            // Creamos el directorio si no existe y movemos la imagen
            if (!is_dir($directorioActualizado)) {
                mkdir($directorioActualizado, 0755, true);
            }

            if (move_uploaded_file($archivo['tmp_name'], $rutaActualizada)) {
                header("Location: galeria.php");
                exit();
            } else {
                $mensajeError = "ERROR al mover la imagen.";
            }
        } else {
            $mensajeError = "Solo se permiten las extensiones: .jpg, .jpeg, .png, .gif.";
        }
    }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galería</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/cabecera.css">
</head>

<body>
    <?php require 'includes/header.php'; ?>

    <div class="container mt-5">
        <!-- Formulario subir Imágenes -->
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">Subir Imagen</button>
        </form>

        <!-- Mensaje de Error -->
        <?php if (isset($mensajeError)) { echo "<div class='alert alert-danger'>$mensajeError</div>"; } ?>

        <div class="row mt-5">
                <?php foreach ($imagenes as $imagen): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card text-left mb-3">

                            <div class="card-body">
                                <h5 class="card-text"><?= $imagen['ubicacion']; ?></h5>
                            </div>
                            <!-- Botón Borrado de Imagen -->
                            <div class="card-header">
                                <button type="button" class="btn-close" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
        </div> 
</body>

</html>
