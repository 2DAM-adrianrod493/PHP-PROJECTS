<?php
session_start();
include('includes/data.php');

// Verificar si el usuario es administrador
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['is_admin'] == 0) {
    header('Location: index.php');
    exit();
}

$categorias = obtenerCategorias($conexion);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $categoria = $_POST['categoria'];
    $imagen = $_POST['imagen'];

    // Insertar el libro en la base de datos
    $sql = "INSERT INTO libros (titulo, autor, id_categoria, imagen) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssis", $titulo, $autor, $categoria, $imagen);
    $stmt->execute();
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar nuevo libro</title>
</head>
<body>
    <h2>Registrar Nuevo Libro</h2>
    <form action="nuevoLibro.php" method="POST">
        <label for="titulo">Título</label>
        <input type="text" name="titulo" required><br><br>
        <label for="autor">Autor</label>
        <input type="text" name="autor" required><br><br>
        <label for="categoria">Categoría</label>
        <select name="categoria" required>
            <?php foreach ($categorias as $categoria): ?>
                <option value="<?= $categoria['id_categoria'] ?>"><?= $categoria['nombre'] ?></option>
            <?php endforeach; ?>
        </select><br><br>
        <label for="imagen">Imagen</label>
        <input type="text" name="imagen"><br><br>
        <button type="submit">Registrar</button>
    </form>
</body>
</html>
