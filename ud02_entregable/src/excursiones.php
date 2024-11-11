<?php
    // Login
    session_start();
    if (!isset($_SESSION['logueado'])) {
        header("Location: login.php");
        exit();
    }

    // Definimos la ruta para las imágenes
    $upload_dir = 'img/';

    // Verificamos si se ha subido una imagen
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $file = $_FILES['imagen'];
        $file_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $valid_extensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($file_extension, $valid_extensions)) {
            // ID único para el nombre del archivo
            $new_file_name = uniqid() . '.' . $file_extension;
            $upload_path = $upload_dir . $new_file_name;

            // Creamos el directorio si no existe y movemos la imagen
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            if (move_uploaded_file($file['tmp_name'], $upload_path)) {
                header("Location: excursiones.php");
                exit();
            } else {
                $error_message = "ERROR al mover la imagen.";
            }
        } else {
            $error_message = "Solo se permiten las extensiones: .jpg, .jpeg, .png, .gif.";
        }
    }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excursiones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/cabecera.css">

    <style>
        /* Oculta los números de los indicadores del carrusel */
        .carousel-indicators li {
            font-size: 0; /* Oculta los números */
        }
    </style>
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
        <?php if (isset($error_message)) { echo "<div class='alert alert-danger'>$error_message</div>"; } ?>

        <!-- Mostramos las Imágenes -->
        <h2 class="mt-5">Galería de Excursiones</h2>
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <ol class="carousel-indicators">
                <?php
                $images = glob($upload_dir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
                if ($images) {
                    foreach ($images as $i => $image) {
                        echo '<li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="' . $i . '" class="' . ($i == 0 ? 'active' : '') . '"></li>';
                    }
                }
                ?>
            </ol>
            <div class="carousel-inner">
                <?php
                if ($images) {
                    foreach ($images as $i => $image) {
                        echo '<div class="carousel-item ' . ($i == 0 ? 'active' : '') . '">';
                        echo '<img src="' . $image . '" class="d-block w-100" alt="Imagen de excursión">';
                        echo '</div>';
                    }
                } else {
                    echo "<p>No hay imágenes disponibles.</p>";
                }
                ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
    </div>

    <!-- Scripts necesarios para el Carrusel de Imágenes -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>

</html>
