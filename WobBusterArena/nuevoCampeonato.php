<?php
session_start();
require './includes/conexion.php';

// Vemos si se es Admin o No
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'administrador') {
    header('Location: index.php');
    exit;
}

// Comprobamos que se Envía el Formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $fecha = $_POST['fecha'];
    $provincia = $_POST['provincia'];
    $imagen = $_FILES['imagen'];

    // Subimos la Imagen a img/
    $imagenNombre = $_FILES['imagen']['name'];
    $imagenTmp = $_FILES['imagen']['tmp_name'];
    $imagenDestino = 'img/' . basename($imagenNombre);

    if (move_uploaded_file($imagenTmp, $imagenDestino)) {
        // Metemos el Campeonato en la Base de Datos
        $stmt = $conexion->prepare("INSERT INTO campeonatos (nombre, fecha, id_campeonato, imagen) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $nombre, $fecha, $provincia, $imagenNombre);

        if ($stmt->execute()) {
            header('Location: index.php');
            exit();
        } else {
            echo "ERROR al Registrar el Campeonato";
        }
    } else {
        echo "ERROR al Subir la Imagen";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registrar Campeonato</title>
    </head>
    </body>
</html>
