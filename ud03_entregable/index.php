<?php
require './includes/data.php';
require './includes/header.php';
?>
<div class="container">
    <div class="row m-4 justify-content-between">

        <!-- Reservas (Si Estamos Logueados) -->
        <div class="col-4 mb-4">
            <?php if (isset($_SESSION['id_usuario'])): ?>
                <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#reservasModal">Mis Reservas</a>
            <?php endif; ?>
        </div>

        <!-- Filtro Categoría -->
        <form class="col-8" method="get">
            <select class="form-select" name="categoria" aria-label="Seleccione una categoría" onchange="this.form.submit()">
                <option value="">Selecciona una categoría</option>
                <?php foreach (obtenerCategorias($conexion) as $categoria): ?>
                    <option value="<?= $categoria['id_categoria'] ?>" <?= isset($_GET['categoria']) && $_GET['categoria'] == $categoria['id_categoria'] ? 'selected' : '' ?>><?= $categoria['nombre'] ?></option>
                <?php endforeach; ?>
            </select>
        </form>
    </div>

    <div class="row">
        <?php
        $categoria_filtro = isset($_GET['categoria']) ? $_GET['categoria'] : '';
        foreach (obtenerLibros($conexion, $categoria_filtro) as $libro): ?>
            <div class="col-md-4 d-flex align-items-stretch pb-1">
                <div class="card shadow">
                    <img src="img/<?= $libro['imagen'] ?>" class="img-thumbnail w-50" alt="Imagen de libro">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= $libro['titulo'] ?></h5>
                        <p class="card-text">
                            <strong>Autor:</strong> <?= $libro['autor'] ?><br>
                            <strong>Categoría:</strong> <?= $libro['categoria'] ?>
                        </p>
                        <div class="mt-auto">
                            <?php if (isset($_SESSION['id_usuario'])): ?>
                                <form action="reserva.php" method="post">
                                    <input type="hidden" name="id_libro" value="<?= $libro['id_libro'] ?>">
                                    <button class="btn btn-primary w-100">Reservar</button>
                                </form>
                            <?php else: ?>
                                <button class="btn btn-primary w-100" disabled>Inicia sesión para reservar</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Modal Mostrar Reservas -->
<div class="modal fade" id="reservasModal" tabindex="-1" aria-labelledby="reservasModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reservasModalLabel">Mis Reservas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php if (isset($_SESSION['id_usuario'])): ?>
                    <?php $reservas = obtenerReservasUsuario($conexion, $_SESSION['id_usuario']); ?>
                    <?php if (count($reservas) > 0): ?>
                        <ul>
                            <?php foreach ($reservas as $reserva): ?>
                                <li><?= $reserva['titulo'] ?> (Reservado el: <?= $reserva['fecha_reserva'] ?>)</li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p>No Tienes Reservas.</p>
                    <?php endif; ?>
                <?php else: ?>
                    <p>Inicia Sesión para ver tus Reservas.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
