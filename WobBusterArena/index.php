<?php
session_start();
require './includes/data.php';

// Verificamos si se Quiere Eliminar un Campeonato
if (isset($_GET['eliminar']) && isset($_SESSION['rol']) && $_SESSION['rol'] == 'administrador') {
    $id_campeonato = $_GET['eliminar'];

    // Obtener la Información del Campeonato para Obtener la Imagen
    $campeonato = obtenerCampeonatoPorID($conexion, $id_campeonato);
    if ($campeonato) {
        $imagen = $campeonato['imagen']; // Nombre de la Imagen

        // Eliminamos el Archivo de la Imagen
        $ruta_imagen = 'img/' . $imagen;
        if (file_exists($ruta_imagen)) {
            unlink($ruta_imagen);
        }
    }

    // Eliminamos el Campeonato de la Base de Datos
    $query = "DELETE FROM campeonatos WHERE id_campeonato = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $id_campeonato);
    
    if ($stmt->execute()) {
        // Después de Eliminar, Redirigimos al Index
        header("Location: index.php");
        exit;
    } else {
        echo "Error al Eliminar el campeonato.";
    }
}

// Filtro Provincias
$campeonatos = obtenerProvincia($conexion);

// Obtener Campeonatos por Provincias
$id_campeonato = isset($_GET['provincia']) ? $_GET['provincia'] : null;
$campeonatos = obtenerCampeonatos($conexion, $id_campeonato);

// Filtro Registro
$campeonatos = obtenerRegistro($conexion);

// Obtener Campeonatos por Registro
$id_campeonato = isset($_GET['registro']) ? $_GET['registro'] : null;
$campeonatos = obtenerCampeonatos($conexion, $id_campeonato);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WobBusterArena</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include('includes/header.php'); ?>

    <div class="container mt-5">
        <!-- Filtro por Provincia -->
        <form action="index.php" method="get" class="mb-4">
            <div class="mb-3">
                <label for="provincia" class="form-label">Filtrar por Provincia</label>
                <select name="provincia" id="provincia" class="form-select" onchange="this.form.submit()">
                    <option value="">Selecciona una Provincia</option>
                    <?php foreach ($campeonatos as $provincia): ?>
                        <option value="<?= htmlspecialchars($provincia['id_campeonato']) ?>" <?= isset($id_campeonato) && $id_campeonato == $provincia['id_campeonato'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($provincia['provincia']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </form>

        <!-- Filtro por Registro -->
        <form action="index.php" method="get" class="mb-4">
            <div class="mb-3">
                <label for="registro" class="form-label">Filtrar por Registro</label>
                <select name="registro" id="registro" class="form-select" onchange="this.form.submit()">
                    <option value="">Selecciona una Registro</option>
                    <?php foreach ($campeonatos as $registro): ?>
                        <option value="<?= htmlspecialchars($registro['id_campeonato']) ?>" <?= isset($id_campeonato) && $id_campeonato == $registro['id_campeonato'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($registro['cerrado']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </form>

        <!-- Botón Registrar Nuevo Campeonato para Admin -->
        <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'administrador'): ?>
            <button class="btn" 
                    style="background-color: #222222; 
                           border-color: #FFFFFF; 
                           color: #ffffff; 
                           width: 100%; 
                           border-radius: 15px; 
                           border-width: 2px;" data-bs-toggle="modal" data-bs-target="#registrarCampeonatoModal">Registrar Nuevo Campeonato</button>
        <?php endif; ?>

        <!-- Mostramos los Campeonatos -->
        <div class="row" style="margin-top: 30px;">
            <?php foreach ($campeonatos as $campeonato): ?>
                <div class="col-md-4 mb-4">
                    <div class="card" style="height: 100%; display: flex; flex-direction: column; background: linear-gradient(to right, #000000, #222222);">
                        <img src="img/<?= htmlspecialchars($campeonato['imagen']) ?>" class="card-img-top" alt="<?= htmlspecialchars($campeonato['nombre']) ?>" style="object-fit: cover; height: 300px;">
                        <div class="card-body d-flex flex-column" style="flex-grow: 1;">
                            <h5 class="card-title"
                            style="border-color: #FFFFFF; 
                                color: #FFFFFF; 
                                width: 160px; 
                                border-radius: 20px; 
                                border-width: 2px;"><?= htmlspecialchars($campeonato['nombre']) ?></h5>
                            <p class="card-text" style="border-color: #FFFFFF; 
                                color: #FFFFFF; 
                                width: 160px; 
                                border-radius: 20px; 
                                border-width: 2px;"><?= htmlspecialchars($campeonato['fecha']) ?></p>
                            <p class="card-text" style="border-color: #FFFFFF; 
                                color: #FFFFFF; 
                                width: 160px; 
                                border-radius: 20px; 
                                border-width: 2px;">Provincia: <?= htmlspecialchars($campeonato['provincia']) ?></p>

                            <div style="margin-top: auto;">
                                <!-- Usuario NO Logueado -->
                                <?php if (!isset($_SESSION['id_usuario'])): ?>
                                    <button class="btn" 
                                            style="background-color: #333333; 
                                                border-color: #FFFFFF; 
                                                color: #ffffff; 
                                                width: 100%; 
                                                border-radius: 15px; 
                                                border-width: 2px;" 
                                            disabled>Registro Cerrado</button>
                                    <button class="btn" 
                                            style="background-color: #333333; 
                                                border-color: #FFFFFF; 
                                                color: #ffffff; 
                                                width: 100%; 
                                                border-radius: 15px; 
                                                border-width: 2px;" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#loginModal">Inscribirse</button>
                                <!-- Admin -->   
                                <?php elseif ($_SESSION['rol'] == 'administrador'): ?>
                                    <?php if ($campeonato['cerrado'] == 0): ?>
                                        <button class="btn" 
                                                style="background-color: #333333; 
                                                    border-color: #FFFFFF; 
                                                    color: #ffffff; 
                                                    width: 100%; 
                                                    border-radius: 15px; 
                                                    border-width: 2px;" 
                                                disabled>Registro Cerrado</button>
                                    <?php else: ?>
                                        <a href="index.php?eliminar=<?= $campeonato['id_campeonato'] ?>" 
                                           class="btn" 
                                           style="background-color: #FFFFFF; 
                                                  border-color: #333333; 
                                                  color: #333333; 
                                                  width: 100%; 
                                                  border-radius: 15px; 
                                                  border-width: 2px;" 
                                           onclick="return confirm('¿Estás Seguro de que Quieres Eliminar este Campeonato?');">Eliminar</a>
                                    <?php endif; ?>
                                <!-- Usuario Logueado -->
                                <?php else: ?>
                                    <?php if ($campeonato['cerrado'] == 0): ?>
                                        <button class="btn" 
                                                style="background-color: #333333; 
                                                    border-color: #FFFFFF; 
                                                    color: #ffffff; 
                                                    width: 100%; 
                                                    border-radius: 15px; 
                                                    border-width: 2px;" 
                                                disabled>Registro Cerrado</button>
                                    <?php else: ?>
                                        <a href="inscripcion.php?id_campeonato=<?= $campeonato['id_campeonato'] ?>&nombre=<?= urlencode($campeonato['nombre']) ?>&fecha=<?= urlencode($campeonato['fecha']) ?>&provincia=<?= urlencode($campeonato['provincia']) ?>" 
                                           class="btn" 
                                           style="background-color: #333333; 
                                                  border-color: #FFFFFF; 
                                                  color: #ffffff; 
                                                  width: 100%; 
                                                  border-radius: 15px; 
                                                  border-width: 2px;">Inscribirse</a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Modal Registrar Campeonatos -->
    <div class="modal fade" id="registrarCampeonatoModal" tabindex="-1" aria-labelledby="registrarCampeonatoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registrarCampeonatosModalLabel">Registrar Nuevo Campeonato</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario -->
                    <form action="nuevoCampeonato.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input type="date" id="fecha" name="fecha" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="provincia" class="form-label">Provincia</label>
                            <select name="provincia" class="form-select" required>
                                <?php foreach ($campeonatos as $provincia): ?>
                                    <option value="<?= htmlspecialchars($provincia['id_campeonato']) ?>"><?= htmlspecialchars($provincia['provincia']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="imagen" class="form-label">Imagen</label>
                            <input type="file" id="imagen" name="imagen" class="form-control" required>
                        </div>
                        <button type="submit" class="btn" 
                                style="background-color: #333333; 
                                border-color: #FFFFFF; 
                                color: #FFFFFF; 
                                width: 150px; 
                                border-radius: 15px; 
                                border-width: 2px;">Añadir Campeonato</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
