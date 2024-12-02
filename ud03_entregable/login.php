<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

// Comprobamos si se Envió el Formulario
if (isset($_POST['nombre_usuario']) && isset($_POST['password'])) {
    $nombre_usuario = $_POST['nombre_usuario'];
    $password = $_POST['password'];

    // Aquí verificas si el nombre de usuario existe en la base de datos
    $query = "SELECT * FROM usuarios WHERE nombre_usuario = '$nombre_usuario'";
    $resultado = mysqli_query($conexion, $query);

    if ($usuario = mysqli_fetch_assoc($resultado)) {
        if (password_verify($password, $usuario['password'])) {
            // Iniciar sesión
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['nombre_usuario'] = $usuario['nombre_usuario'];
            $_SESSION['is_admin'] = $usuario['is_admin'];
            header("Location: index.php");
            exit;
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "El nombre de usuario no existe.";
    }
}

?>

<!-- Formulario Login -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <form action="login.php" method="POST">
    <div class="mb-3">
        <label for="nombre_usuario" class="form-label">Nombre de usuario</label>
        <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Iniciar sesión</button>
</form>

</body>
</html>
