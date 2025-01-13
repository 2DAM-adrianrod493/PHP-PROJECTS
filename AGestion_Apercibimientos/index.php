<?php


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Apercibimientos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Listado de Apercibimientos</h1>
        <!-- Botón Nuevo Apercibimiento -->
        <a class="btn btn-primary" style="background-color: #111111; 
                    border-color: #999999; 
                    color: #ffffff; 
                    width: 100%; 
                    border-radius: 15px; 
                    border-width: 2px;" href="crear.php" role="button">Nuevo Apercibimiento</a>

        <!-- Buscador por Estado -->
        <form action="index.php" method="get" class="mb-4">
            <div class="mb-3">
                <label for="apercibimiento" class="form-label">Filtrar por Estado</label>
                <select name="apercibimiento" id="apercibimiento" class="form-select" onchange="this.form.submit()">
                    <option value="">Selecciona un Estado</option>
                    <?php foreach ($apercibimientos as $apercibimiento): ?>
                        <option value="<?= htmlspecialchars($apercibimiento['id']) ?>" <?= isset($id) && $id == $id['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($apercibimiento['nombre']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </form>

        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Alumno</th>
                    <th>Fecha</th>
                    <th>Motivo</th>
                    <th>Estado</th>
                    <th>Acciones</th>
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

    <!-- Modal para Editar Apercibimiento -->
    <div class="modal fade" id="modalEditApercibimiento" tabindex="-1" aria-labelledby="modalEditApercibimientoLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditApercibimientoLabel">Editar Apercibimiento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="editar_aperdibimiento" value="1">
                        <input type="hidden" id="id" name="id">
                        <div class="mb-3">
                            <label for="id" class="form-label">ID</label>
                            <input type="text" id="id" name="id" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Alumno</label>
                            <textarea id="nombre" name="nombre" class="form-control" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input type="date" id="fecha" name="fecha" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="motivo" class="form-label">Motivo</label>
                            <input type="date" id="motivo" name="motivo" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select name="estado" id="estado" class="form-select" required>
                                <option value="" disabled selected>Seleccione un Estado</option>
                                <option value="pendiente">Pendiente</option>
                                <option value="resuelto">Resuelto</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>