<?php
session_start();
include('includes/data.php');

// Vemos si el Usuario es Admin
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['is_admin'] == 0) {
    header('Location: index.php');
    exit();
}

$categorias = obtenerCategorias($conexion);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $categoria = $_POST['categoria'];
    
    // Procesar la imagen
    $imagen = $_FILES['imagen'];
    $imagen_nombre = null;

    // Verificar si se ha subido una imagen
    if ($imagen && $imagen['error'] === UPLOAD_ERR_OK) {
        // Definir la ruta de destino y el nombre de la imagen
        $directorio_destino = 'img/';
        $imagen_nombre = uniqid() . '-' . basename($imagen['name']);
        $ruta_destino = $directorio_destino . $imagen_nombre;

        // Mover la imagen al directorio de destino
        if (move_uploaded_file($imagen['tmp_name'], $ruta_destino)) {
            // Imagen subida exitosamente
        } else {
            // Si hay algún error al subir la imagen
            echo "Error al subir la imagen.";
            exit();
        }
    }

    // Insertamos el Libro en la Base de Datos
    $sql = "INSERT INTO libros (titulo, autor, id_categoria, imagen) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssis", $titulo, $autor, $categoria, $imagen_nombre);
    $stmt->execute();

    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Nuevo libro</title>
</head>
<body>
    <h2>Registrar Nuevo Libro</h2>
    
    <!-- Modal Registrar Libro -->
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#registrarLibroModal">Registrar Nuevo Libro</button>

    <!-- Modal -->
    <div class="modal fade" id="registrarLibroModal" tabindex="-1" aria-labelledby="registrarLibroModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registrarLibroModalLabel">Registrar Nuevo Libro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario de registro de libro -->
                    <form action="nuevoLibro.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título</label>
                            <input type="text" id="titulo" name="titulo" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="autor" class="form-label">Autor</label>
                            <input type="text" id="autor" name="autor" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="categoria" class="form-label">Categoría</label>
                            <select name="categoria" class="form-select" required>
                                <?php foreach ($categorias as $categoria): ?>
                                    <option value="<?= $categoria['id_categoria'] ?>"><?= $categoria['nombre'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="imagen" class="form-label">Imagen</label>
                            <input type="file" id="imagen" name="imagen" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Archivos JS para Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
