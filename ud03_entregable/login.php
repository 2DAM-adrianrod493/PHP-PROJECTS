<?php
session_start();
require './includes/data.php';  // Asegúrate de que este archivo se incluya correctamente

$error = ''; // Variable para errores

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['nombre_usuario']) && !empty($_POST['password'])) {
        $nombre_usuario = $_POST['nombre_usuario'];
        $password = $_POST['password'];

        // Autenticación con nombre de usuario
        $usuario = autenticarUsuario($conexion, $nombre_usuario, $password);

        if ($usuario) {
            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            $_SESSION['nombre_usuario'] = $usuario['nombre_usuario'];
            $_SESSION['is_admin'] = $usuario['is_admin'];
            header("Location: index.php");
            exit();
        } else {
            $error = "Nombre de usuario o contraseña incorrectos.";
        }
    } else {
        $error = "Por favor, ingrese nombre de usuario y contraseña.";
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
<body>
    <div class="container mt-5">
        <h2>Iniciar Sesión</h2>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form action="login.php" method="POST">
            <div class="mb-3">
                <label for="nombre_usuario" class="form-label">Nombre de Usuario</label>
                <input type="text" id="nombre_usuario" name="nombre_usuario" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
        </form>
    </div>
</body>
</html>
