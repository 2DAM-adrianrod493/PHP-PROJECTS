<?php
session_start();
require './includes/data.php';

if (!isset($_SESSION['id_usuario']) || $_SESSION['id_usuario'] !== 1) { // Solo el admin puede registrar
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $id_categoria = $_POST['id_categoria'];
    $imagen = $_POST['imagen'];

    if (registrarLibro($conexion, $titulo, $autor, $id_categoria, $imagen)) {
        $mensaje = "Libro registrado con éxito.";
    } else {
        $mensaje = "Error al registrar el libro.";
    }
}

$categorias = obtenerCategorias($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Libro</title>
</head>
<body>
    <h1>Registrar Nuevo Libro</h1>
    <?php if (isset($mensaje)): ?>
        <p><?= $mensaje ?></p>
    <?php endif; ?>
    <form action="nuevoLibro.php" method="post">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" id="titulo" required><br>
        
        <label for="autor">Autor:</label>
        <input type="text" name="autor" id="autor" required><br>
        
        <label for="id_categoria">Categoría:</label>
        <select name="id_categoria" id="id_categoria" required>
            <?php foreach ($categorias as $categoria): ?>
                <option value="<?= $categoria['id_categoria'] ?>"><?= $categoria['nombre'] ?></option>
            <?php endforeach; ?>
        </select><br>
        
        <label for="imagen">Imagen:</label>
        <input type="text" name="imagen" id="imagen" required><br>
        
        <button type="submit">Registrar Libro</button>
    </form>
</body>
</html>
