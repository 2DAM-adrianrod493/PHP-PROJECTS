<?php
session_start();
require './includes/data.php';

// Verificamos si se Quiere Eliminar un Libro
if (isset($_GET['eliminar']) && isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
    $id_libro = $_GET['eliminar'];

    // Obtener la información del libro para obtener la imagen
    $libro = obtenerLibroPorId($conexion, $id_libro);
    if ($libro) {
        $imagen = $libro['imagen']; // Obtenemos el nombre de la imagen

        // Intentamos eliminar el archivo de la imagen
        $ruta_imagen = 'img/' . $imagen;
        if (file_exists($ruta_imagen)) {
            unlink($ruta_imagen); // Eliminamos el archivo de la imagen
        }
    }

    // Eliminamos el Libro de la Base de Datos
    $query = "DELETE FROM libros WHERE id_libro = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $id_libro);
    
    if ($stmt->execute()) {
        // Después de Eliminar, Redirigimos al Index
        header("Location: index.php");
        exit;
    } else {
        echo "Error al eliminar el libro.";
    }
}

// Filtro Categorías
$categorias = obtenerCategorias($conexion);

// Obtener Libro por Categoría
$id_categoria = isset($_GET['categoria']) ? $_GET['categoria'] : null;
$libros = obtenerLibros($conexion, $id_categoria);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Virtual</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include('includes/header.php'); ?>

    <div class="container mt-5">
        <!-- Filtro por Categoría -->
        <form action="index.php" method="get" class="mb-4">
            <div class="mb-3">
                <label for="categoria" class="form-label">Filtrar por categoría</label>
                <select name="categoria" id="categoria" class="form-select" onchange="this.form.submit()">
                    <option value="">Selecciona una Categoría</option>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?= htmlspecialchars($categoria['id_categoria']) ?>" <?= isset($id_categoria) && $id_categoria == $categoria['id_categoria'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($categoria['nombre']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </form>

        <!-- Botón Registrar Nuevo Libro para Admin -->
        <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
            <button class="btn" 
                    style="background-color: #352012; 
                           border-color: #FFFFFF; 
                           color: #ffffff; 
                           width: 100%; 
                           border-radius: 15px; 
                           border-width: 2px;" data-bs-toggle="modal" data-bs-target="#registrarLibroModal">Registrar Nuevo Libro</button>
        <?php endif; ?>

        <!-- Mostramos los Libros -->
        <div class="row" style="margin-top: 30px;">
            <?php foreach ($libros as $libro): ?>
                <div class="col-md-4 mb-4">
                    <div class="card" style="height: 100%; display: flex; flex-direction: column;">
                        <img src="img/<?= htmlspecialchars($libro['imagen']) ?>" class="card-img-top" alt="<?= htmlspecialchars($libro['titulo']) ?>" style="object-fit: cover; height: 300px;">
                        <div class="card-body d-flex flex-column" style="flex-grow: 1;">
                            <h5 class="card-title"><?= htmlspecialchars($libro['titulo']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($libro['autor']) ?></p>
                            <p class="card-text">Categoría: <?= htmlspecialchars($libro['categoria']) ?></p>

                            <div style="margin-top: auto;">
                                <!-- Usuario NO Logueado -->
                                <?php if (!isset($_SESSION['id_usuario'])): ?>
                                    <button class="btn" 
                                            style="background-color: #352012; 
                                                border-color: #FFFFFF; 
                                                color: #ffffff; 
                                                width: 100%; 
                                                border-radius: 15px; 
                                                border-width: 2px;" 
                                            disabled>Reservado</button>
                                    <button class="btn" 
                                            style="background-color: #352012; 
                                                border-color: #FFFFFF; 
                                                color: #ffffff; 
                                                width: 100%; 
                                                border-radius: 15px; 
                                                border-width: 2px;" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#loginModal">Reservar</button>
                                <!-- Admin -->   
                                <?php elseif ($_SESSION['is_admin'] == 1): ?>
                                    <?php if ($libro['disponible'] == 0): ?>
                                        <button class="btn" 
                                                style="background-color: #352012; 
                                                    border-color: #FFFFFF; 
                                                    color: #ffffff; 
                                                    width: 100%; 
                                                    border-radius: 15px; 
                                                    border-width: 2px;" 
                                                disabled>Reservado</button>
                                    <?php else: ?>
                                        <a href="index.php?eliminar=<?= $libro['id_libro'] ?>" 
                                           class="btn" 
                                           style="background-color: #FFFFFF; 
                                                  border-color: #352012; 
                                                  color: #352012; 
                                                  width: 100%; 
                                                  border-radius: 15px; 
                                                  border-width: 2px;" 
                                           onclick="return confirm('¿Estás Seguro de que Quieres Eliminar este Libro?');">Eliminar</a>
                                    <?php endif; ?>
                                <!-- Usuario Logueado -->
                                <?php else: ?>
                                    <?php if ($libro['disponible'] == 0): ?>
                                        <button class="btn" 
                                                style="background-color: #352012; 
                                                    border-color: #FFFFFF; 
                                                    color: #ffffff; 
                                                    width: 100%; 
                                                    border-radius: 15px; 
                                                    border-width: 2px;" 
                                                disabled>Reservado</button>
                                    <?php else: ?>
                                        <a href="reserva.php?id_libro=<?= $libro['id_libro'] ?>&titulo=<?= urlencode($libro['titulo']) ?>&autor=<?= urlencode($libro['autor']) ?>&categoria=<?= urlencode($libro['categoria']) ?>" 
                                           class="btn" 
                                           style="background-color: #352012; 
                                                  border-color: #FFFFFF; 
                                                  color: #ffffff; 
                                                  width: 100%; 
                                                  border-radius: 15px; 
                                                  border-width: 2px;">Reservar</a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Modal Registrar Libro -->
    <div class="modal fade" id="registrarLibroModal" tabindex="-1" aria-labelledby="registrarLibroModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registrarLibroModalLabel">Registrar Nuevo Libro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario -->
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
                                    <option value="<?= htmlspecialchars($categoria['id_categoria']) ?>"><?= htmlspecialchars($categoria['nombre']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="imagen" class="form-label">Imagen</label>
                            <input type="file" id="imagen" name="imagen" class="form-control" required>
                        </div>
                        <button type="submit" class="btn" 
                                style="background-color: #352012; 
                                border-color: #FFFFFF; 
                                color: #FFFFFF; 
                                width: 150px; 
                                border-radius: 15px; 
                                border-width: 2px;">Registrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
