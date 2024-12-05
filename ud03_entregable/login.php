<?php
session_start();
require './includes/data.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['nombre_usuario']) && !empty($_POST['password'])) {
        $nombre_usuario = $_POST['nombre_usuario'];
        $password = $_POST['password'];

        $usuario = autenticarUsuario($conexion, $nombre_usuario, $password);

        if ($usuario) {
            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            $_SESSION['nombre_usuario'] = $usuario['nombre_usuario'];
            $_SESSION['is_admin'] = $usuario['is_admin'];
            header("Location: index.php");
            exit();
        } else {
            $error = "Nombre de Usuario o Contraseña Incorrectos.";
        }
    } else {
        $error = "Por Favor, Introduce un Nombre de Usuario y Contraseña.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
</body>
</html>
