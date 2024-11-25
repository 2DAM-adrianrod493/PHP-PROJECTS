<?php
session_start();
require './includes/conexion.php';
require './includes/data.php';
require './includes/header.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$tareas_doing = [];
$tareas_toDo = [];
$tareas_done = [];

// Obtenemos las tareas de la base de datos
$tareas = getTareas($db);

// Clasificamos las tareas por estado
foreach ($tareas as $tarea) {
    if ($tarea['estado'] === 'done') {
        $tareas_done[] = $tarea;
    } elseif ($tarea['estado'] === 'doing') {
        $tareas_doing[] = $tarea;
    } else {
        $tareas_toDo[] = $tarea;
    }
}

// Agregar nueva tarea
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nueva_tarea'])) {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $fecha_entrega = $_POST['fecha_entrega'];
    $estado = $_POST['estado'];

    $query = "INSERT INTO tareas (titulo, descripcion, fecha_entrega, estado) VALUES ('$titulo', '$descripcion', '$fecha_entrega', '$estado')";
    mysqli_query($db, $query);
    header("Location: index.php");
    exit();
}

// Editar tarea
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar_tarea'])) {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $fecha_entrega = $_POST['fecha_entrega'];
    $estado = $_POST['estado'];

    $query = "UPDATE tareas SET titulo='$titulo', descripcion='$descripcion', fecha_entrega='$fecha_entrega', estado='$estado' WHERE id=$id";
    mysqli_query($db, $query);
    header("Location: index.php");
    exit();
}
?>

<div class="container my-5">
    <div class="row">
        <div class="col-md-4">
            <h2 class="text-center bg-danger text-white p-2 rounded">TO DO</h2>
            <?php foreach ($tareas_toDo as $tarea): ?>
                <div class="card border-danger mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><?= $tarea['titulo'] ?></h5>
                        <p class="card-text"><?= $tarea['descripcion'] ?></p>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEditTarea" data-id="<?= $tarea['id'] ?>" data-titulo="<?= $tarea['titulo'] ?>" data-descripcion="<?= $tarea['descripcion'] ?>" data-fecha_entrega="<?= $tarea['fecha_entrega'] ?>" data-estado="<?= $tarea['estado'] ?>">Editar</button>
                    </div>
                </div>
            <?php endforeach; ?>
            <button class="btn btn-danger w-100 mt-3" data-bs-toggle="modal" data-bs-target="#modalTarea">Añadir Tarea</button>
        </div>

        <div class="col-md-4">
            <h2 class="text-center bg-warning text-dark p-2 rounded">DOING</h2>
            <?php foreach ($tareas_doing as $tarea): ?>
                <div class="card border-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><?= $tarea['titulo'] ?></h5>
                        <p class="card-text"><?= $tarea['descripcion'] ?></p>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEditTarea" data-id="<?= $tarea['id'] ?>" data-titulo="<?= $tarea['titulo'] ?>" data-descripcion="<?= $tarea['descripcion'] ?>" data-fecha_entrega="<?= $tarea['fecha_entrega'] ?>" data-estado="<?= $tarea['estado'] ?>">Editar</button>
                    </div>
                </div>
            <?php endforeach; ?>
            <button class="btn btn-warning w-100 mt-3" data-bs-toggle="modal" data-bs-target="#modalTarea">Añadir Tarea</button>
        </div>

        <div class="col-md-4">
            <h2 class="text-center bg-success text-white p-2 rounded">DONE</h2>
            <?php foreach ($tareas_done as $tarea): ?>
                <div class="card border-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><?= $tarea['titulo'] ?></h5>
                        <p class="card-text"><?= $tarea['descripcion'] ?></p>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEditTarea" data-id="<?= $tarea['id'] ?>" data-titulo="<?= $tarea['titulo'] ?>" data-descripcion="<?= $tarea['descripcion'] ?>" data-fecha_entrega="<?= $tarea['fecha_entrega'] ?>" data-estado="<?= $tarea['estado'] ?>">Editar</button>
                    </div>
                </div>
            <?php endforeach; ?>
            <button class="btn btn-success w-100 mt-3" data-bs-toggle="modal" data-bs-target="#modalTarea">Añadir Tarea</button>
        </div>
    </div>
</div>

<!-- Modal para Añadir Tarea -->
<div class="modal fade" id="modalTarea" tabindex="-1" aria-labelledby="modalTareaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTareaLabel">Nueva Tarea</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="nueva_tarea" value="1">
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" id="titulo" name="titulo" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea id="descripcion" name="descripcion" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_entrega" class="form-label">Fecha de Entrega</label>
                        <input type="date" id="fecha_entrega" name="fecha_entrega" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="estado" class="form-label">Estado</label>
                        <select id="estado" name="estado" class="form-control" required>
                            <option value="toDo">TO DO</option>
                            <option value="doing">DOING</option>
                            <option value="done">DONE</option>
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

<!-- Modal para Editar Tarea -->
<div class="modal fade" id="modalEditTarea" tabindex="-1" aria-labelledby="modalEditTareaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditTareaLabel">Editar Tarea</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="editar_tarea" value="1">
                    <input type="hidden" id="id" name="id">
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" id="titulo" name="titulo" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea id="descripcion" name="descripcion" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_entrega" class="form-label">Fecha de Entrega</label>
                        <input type="date" id="fecha_entrega" name="fecha_entrega" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="estado" class="form-label">Estado</label>
                        <select id="estado" name="estado" class="form-control" required>
                            <option value="toDo">TO DO</option>
                            <option value="doing">DOING</option>
                            <option value="done">DONE</option>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const modalEdit = document.getElementById('modalEditTarea');
    modalEdit.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; 
        const id = button.getAttribute('data-id');
        const titulo = button.getAttribute('data-titulo');
        const descripcion = button.getAttribute('data-descripcion');
        const fecha_entrega = button.getAttribute('data-fecha_entrega');
        const estado = button.getAttribute('data-estado');

        const modalTitle = modalEdit.querySelector('.modal-title');
        const modalId = modalEdit.querySelector('#id');
        const modalTitulo = modalEdit.querySelector('#titulo');
        const modalDescripcion = modalEdit.querySelector('#descripcion');
        const modalFecha = modalEdit.querySelector('#fecha_entrega');
        const modalEstado = modalEdit.querySelector('#estado');

        modalTitle.textContent = 'Editar Tarea';
        modalId.value = id;
        modalTitulo.value = titulo;
        modalDescripcion.value = descripcion;
        modalFecha.value = fecha_entrega;
        modalEstado.value = estado;
    });
</script>

</body>
</html>
