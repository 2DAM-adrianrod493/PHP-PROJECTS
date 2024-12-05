<?php
session_start();
require './includes/data.php';

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
                        <option value="<?= $categoria['id_categoria'] ?>" <?= isset($id_categoria) && $id_categoria == $categoria['id_categoria'] ? 'selected' : '' ?>>
                            <?= $categoria['nombre'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </form>

        <!-- Botón "Registrar Nuevo Libro" solo visible para Administradores -->
        <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
            <a href="nuevoLibro.php" class="btn btn-success mb-4">Registrar Nuevo Libro</a>
        <?php endif; ?>

        <div class="row" style="margin-top: 30px;">
            <?php foreach ($libros as $libro): ?>
                <div class="col-md-4 mb-4">
                    <div class="card mb-4" style="height: 100%; display: flex; flex-direction: column;">
                        <img src="img/<?= $libro['imagen'] ?>" class="card-img-top" alt="<?= $libro['titulo'] ?>" style="object-fit: cover; height: 300px;">
                        <div class="card-body" style="flex-grow: 1;">
                            <h5 class="card-title"><?= $libro['titulo'] ?></h5>
                            <p class="card-text"><?= $libro['autor'] ?></p>
                            <p class="card-text">Categoría: <?= $libro['categoria'] ?></p>

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
                                        <a href="eliminar.php?id_libro=<?= $libro['id_libro'] ?>" class="btn btn-danger">Eliminar</a>
                                    <?php endif; ?>
                                </p>

                            <?php else: ?>
                                <!-- Usuario Logueado -->
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

        <!-- Modal Lista Reservas para Usuario Logueado -->
        <?php if (isset($_SESSION['id_usuario']) && $_SESSION['is_admin'] == 0): ?>
            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#reservasModal">Ver Mis Reservas</button>

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

    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
