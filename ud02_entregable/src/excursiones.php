<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Definir la ruta para las imágenes
$upload_dir = 'img/'; // El directorio 'img' debe estar dentro de 'src'

// Verificar si se ha enviado una imagen
if (isset($_POST['submit']) && isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
    $file = $_FILES['imagen'];
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    
    // Validar la extensión de la imagen
    $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $valid_extensions = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($file_extension, $valid_extensions)) {
        // Generar un nombre único para evitar colisiones
        $new_file_name = uniqid() . '.' . $file_extension;
        $upload_path = $upload_dir . $new_file_name;

        // Verificar si el directorio existe
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true); // Crear el directorio si no existe
        }

        // Mover la imagen al directorio de destino
        if (move_uploaded_file($file_tmp, $upload_path)) {
            echo "<div class='alert alert-success'>Imagen subida exitosamente. <a href='excursiones.php' class='btn btn-primary'>Recargar Página</a></div>";
            header("Location: excursiones.php");
            exit();
        } else {
            echo "<div class='alert alert-danger'>Error al mover la imagen.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Solo se permiten imágenes con extensiones .jpg, .jpeg, .png, .gif.</div>";
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excursiones</title>
    <link rel="stylesheet" href="../css/cabecera.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="d-flex justify-content-center">
        <h1 class="titulo">Gestión de Excursiones</h1>
    </header>

    <div class="container mt-5">
        <!-- Formulario para subir imágenes -->
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="imagen" class="form-label">Selecciona una imagen para subir</label>
                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Subir Imagen</button>
        </form>

        <!-- Mostrar las imágenes subidas -->
        <h2 class="mt-5">Galería de Excursiones</h2>
        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php
                // Mostrar imágenes subidas en el directorio img/
                $images = glob($upload_dir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
                if ($images) {
                    $active = true; // Para marcar la primera imagen como activa en el carrusel
                    foreach ($images as $image) {
                        echo '<div class="carousel-item ' . ($active ? 'active' : '') . '">';
                        echo '<img src="' . $image . '" class="d-block w-100" alt="Imagen de excursión">';
                        echo '</div>';
                        $active = false; // Después de la primera, desmarcar la imagen como activa
                    }
                } else {
                    echo "<p>No hay imágenes disponibles.</p>";
                }
                ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
