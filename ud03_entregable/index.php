<?php
session_start();
require './includes/data.php';

// Obtener categorías para el filtro
$categorias = obtenerCategorias($conexion);

// Obtener libros según el filtro de categoría
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
        <!-- Filtro por categorías -->
        <form action="index.php" method="get" class="mb-4">
            <div class="mb-3">
                <label for="categoria" class="form-label">Filtrar por categoría</label>
                <select name="categoria" id="categoria" class="form-select" onchange="this.form.submit()">
                    <option value="">Selecciona una categoría</option>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?= $categoria['id_categoria'] ?>" <?= isset($id_categoria) && $id_categoria == $categoria['id_categoria'] ? 'selected' : '' ?>>
                            <?= $categoria['nombre'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </form>

        <div class="row">
            <?php foreach ($libros as $libro): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="img/<?= $libro['imagen'] ?>" class="card-img-top" alt="<?= $libro['titulo'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $libro['titulo'] ?></h5>
                            <p class="card-text"><?= $libro['autor'] ?></p>
                            <p class="card-text">Categoría: <?= $libro['categoria'] ?></p>

                            <!-- Usuario NO logueado -->
                            <?php if (!isset($_SESSION['id_usuario'])): ?>
                                <p class="card-text">
                                    <button class="btn btn-secondary" disabled>Reservado</button>
                                    <a href="login.php" class="btn btn-primary">Iniciar sesión para reservar</a>
                                </p>
                            <?php elseif ($_SESSION['is_admin'] == 1): ?>
                                <!-- Usuario Administrador -->
                                <p class="card-text">
                                    <?php if ($libro['disponible'] == 0): ?>
                                        <button class="btn btn-secondary" disabled>Reservado</button>
                                    <?php else: ?>
                                        <a href="eliminar.php?id_libro=<?= $libro['id_libro'] ?>" class="btn btn-danger">Eliminar</a>
                                    <?php endif; ?>
                                </p>
                            <?php else: ?>
                                <!-- Usuario logueado (no administrador) -->
                                <p class="card-text">
                                    <?php if ($libro['disponible'] == 0): ?>
                                        <button class="btn btn-secondary" disabled>Reservado</button>
                                    <?php else: ?>
                                        <a href="reserva.php?id_libro=<?= $libro['id_libro'] ?>" class="btn btn-primary">Reservar</a>
                                    <?php endif; ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Modal para mostrar el listado de reservas (solo si el usuario está logueado) -->
        <?php if (isset($_SESSION['id_usuario']) && $_SESSION['is_admin'] == 0): ?>
            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#reservasModal">Ver mis reservas</button>

            <!-- Modal -->
            <div class="modal fade" id="reservasModal" tabindex="-1" aria-labelledby="reservasModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="reservasModalLabel">Mis Reservas</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Libro</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $reservas = obtenerReservasUsuario($conexion, $_SESSION['id_usuario']);
                                    foreach ($reservas as $reserva): ?>
                                        <tr>
                                            <td><?= $reserva['fecha_reserva'] ?></td>
                                            <td><?= $reserva['titulo'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Modal para registrar un nuevo libro (solo para administradores) -->
        <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#registrarLibroModal">Registrar Libro</button>

            <!-- Modal -->
            <div class="modal fade" id="registrarLibroModal" tabindex="-1" aria-labelledby="registrarLibroModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="registrarLibroModalLabel">Registrar Nuevo Libro</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
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
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
