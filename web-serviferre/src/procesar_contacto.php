<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $mensaje = $_POST['mensaje'];

    // Guardar en base de datos (esto asume una conexión preestablecida)
    $conn = new mysqli("localhost", "root", "", "servi_ferre");
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO contacto (nombre, apellidos, email, mensaje) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nombre, $apellidos, $email, $mensaje);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    echo "Gracias por contactarnos, nos pondremos en contacto contigo pronto.";
}
?>
