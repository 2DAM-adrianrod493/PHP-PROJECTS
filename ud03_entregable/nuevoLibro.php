<?php
session_start();
require './includes/conexion.php';

// Vemos si se es Admin o No
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header('Location: index.php');
    exit;
}

// Comprobamos que se Envía el Formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $categoria = $_POST['categoria'];
    $imagen = $_FILES['imagen'];

    // Subimos la Imagen a img/
    $imagenNombre = $_FILES['imagen']['name'];
    $imagenTmp = $_FILES['imagen']['tmp_name'];
    $imagenDestino = 'img/' . basename($imagenNombre);

    if (move_uploaded_file($imagenTmp, $imagenDestino)) {
        // Metemos Libro en la Base de Datos
        $stmt = $conexion->prepare("INSERT INTO libros (titulo, autor, id_categoria, imagen) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $titulo, $autor, $categoria, $imagenNombre);

        if ($stmt->execute()) {
            header('Location: index.php');
            exit();
        } else {
            echo "Error al Registrar el Libro :(";
        }
    } else {
        echo "Error al Subir la Imagen :(";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Libro</title>
</head>
</body>
</html>
