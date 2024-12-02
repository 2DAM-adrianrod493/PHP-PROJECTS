<?php
session_start();
require './includes/data.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['id_libro'])) {
    $id_usuario = $_SESSION['id_usuario'];
    $id_libro = $_POST['id_libro'];
    $fecha_reserva = date("Y-m-d");

    if (registrarReserva($conexion, $id_usuario, $id_libro, $fecha_reserva)) {
        echo "Reserva realizada correctamente.";
    } else {
        echo "Error al realizar la reserva.";
    }
}

function registrarReserva($conexion, $id_usuario, $id_libro, $fecha_reserva) {
    $sql = "INSERT INTO reservas (id_usuario, id_libro, fecha_reserva) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("iis", $id_usuario, $id_libro, $fecha_reserva);
    return $stmt->execute();
}
?>
