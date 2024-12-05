<?php
session_start();
require './includes/data.php';

// Verificamos si se Quiere Eliminar un Libro
if (isset($_GET['eliminar']) && isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
    $id_libro = $_GET['eliminar'];

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
            <button class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#registrarLibroModal">Registrar Nuevo Libro</button>
        <?php endif; ?>

        <!-- Mostramos los Libros -->
        <div class="row" style="margin-top: 30px;">
            <?php foreach ($libros as $libro): ?>
                <div class="col-md-4 mb-4">
                    <div class="card mb-4" style="height: 100%; display: flex; flex-direction: column;">
                        <img src="img/<?= htmlspecialchars($libro['imagen']) ?>" class="card-img-top" alt="<?= htmlspecialchars($libro['titulo']) ?>" style="object-fit: cover; height: 300px;">
                        <div class="card-body" style="flex-grow: 1;">
                            <h5 class="card-title"><?= htmlspecialchars($libro['titulo']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($libro['autor']) ?></p>
                            <p class="card-text">Categoría: <?= htmlspecialchars($libro['categoria']) ?></p>

                            <!-- Usuario NO Logueado -->
                            <?php if (!isset($_SESSION['id_usuario'])): ?>
                                <p class="card-text">
                                    <button class="btn btn-secondary" disabled>Reservado</button>
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">Reservar</button>
                                </p>

                            <?php elseif ($_SESSION['is_admin'] == 1): ?>
                                <!-- Admin -->
                                <p class="card-text">
                                    <?php if ($libro['disponible'] == 0): ?>
                                        <button class="btn btn-secondary" disabled>Reservado</button>
                                    <?php else: ?>
                                        <a href="index.php?eliminar=<?= $libro['id_libro'] ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar este libro?');">Eliminar</a>
                                    <?php endif; ?>
                                </p>

                            <?php else: ?>
                                <!-- Usuario Logueado -->
                                <p class="card-text">
                                    <?php if ($libro['disponible'] == 0): ?>
                                        <button class="btn btn-secondary" disabled>Reservado</button>
                                    <?php else: ?>
                                        <a href="reserva.php?id_libro=<?= $libro['id_libro'] ?>&titulo=<?= urlencode($libro['titulo']) ?>&autor=<?= urlencode($libro['autor']) ?>&categoria=<?= urlencode($libro['categoria']) ?>" class="btn btn-primary">Reservar</a>
                                    <?php endif; ?>
                                </p>

                            <?php endif; ?>
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
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Login -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Iniciar Sesión</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="login.php" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Usuario</label>
                            <input type="text" id="username" name="username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
