<?php
session_start();
require './includes/data.php';  // Asegúrate de tener este archivo con la conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener datos del formulario
    $nombre_usuario = $_POST['nombre_usuario'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validación básica
    if ($password !== $confirm_password) {
        $error = "Las contraseñas no coinciden.";
    } else {
        // Verificar si el email ya está registrado
        $usuario_existente = verificarUsuarioPorEmail($conexion, $email);
        if ($usuario_existente) {
            $error = "El correo electrónico ya está registrado.";
        } else {
            // Registrar usuario
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $registro_exitoso = registrarUsuario($conexion, $nombre_usuario, $email, $hashed_password);

            if ($registro_exitoso) {
                $_SESSION['id_usuario'] = $conexion->lastInsertId();
                $_SESSION['nombre_usuario'] = $nombre_usuario;
                $_SESSION['is_admin'] = 0;  // Asumimos que es un usuario normal
                header("Location: index.php");
                exit();
            } else {
                $error = "Hubo un problema al registrar el usuario.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Registro de Usuario</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger">
                <?= $error ?>
            </div>
        <?php endif; ?>
        <form action="registro.php" method="POST">
            <div class="mb-3">
                <label for="nombre_usuario" class="form-label">Nombre de Usuario</label>
                <input type="text" id="nombre_usuario" name="nombre_usuario" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirmar Contraseña</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
</body>
</html>
