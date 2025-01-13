<?php
session_start();
require './includes/conexion.php';

// Verificamos si el usuario es administrador
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'administrador') {
    header('Location: index.php');
    exit;
}

// Comprobamos si se está editando el campeonato
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_campeonato = $_POST['id_campeonato'];
    $nombre = $_POST['nombre'];
    $fecha = $_POST['fecha'];
    $provincia = $_POST['provincia'];
    $imagen = $_FILES['imagen'];

    // Si se ha subido una nueva imagen, la procesamos
    if ($imagen['size'] > 0) {
        $imagenNombre = $_FILES['imagen']['name'];
        $imagenTmp = $_FILES['imagen']['tmp_name'];
        $imagenDestino = 'img/' . basename($imagenNombre);

        // Movemos la imagen subida al directorio 'img/'
        if (move_uploaded_file($imagenTmp, $imagenDestino)) {
            // Si la imagen se subió correctamente, actualizamos la base de datos
            $stmt = $conexion->prepare("UPDATE campeonatos SET nombre = ?, fecha = ?, provincia = ?, imagen = ? WHERE id_campeonato = ?");
            $stmt->bind_param("ssssi", $nombre, $fecha, $provincia, $imagenNombre, $id_campeonato);
        } else {
            echo "ERROR al Subir la Imagen";
            exit;
        }
    } else {
        // Si no se subió una nueva imagen, actualizamos los demás campos
        $stmt = $conexion->prepare("UPDATE campeonatos SET nombre = ?, fecha = ?, provincia = ? WHERE id_campeonato = ?");
        $stmt->bind_param("sssi", $nombre, $fecha, $provincia, $id_campeonato);
    }

    // Ejecutamos la consulta para actualizar el campeonato
    if ($stmt->execute()) {
        header("Location: index.php"); // Redirigimos al index después de la actualización
        exit;
    } else {
        echo "Error al Actualizar el Campeonato.";
    }
} else {
    // Si no es una petición POST, redirigimos al index
    header("Location: index.php");
    exit;
}
?>
