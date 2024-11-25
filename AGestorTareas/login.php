<?php
session_start();
require './includes/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Consulta para verificar el usuario
    $sql = "SELECT * FROM usuarios WHERE email = '$username'";
    $resultado = mysqli_query($db, $sql);
    $user = mysqli_fetch_assoc($resultado);

    if ($user && password_verify($password, $user['contraseña'])) {
        // Inicio de sesión exitoso
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center">Iniciar Sesión</h2>
                    <?php if (isset($error)): ?>
                        <p class="text-danger text-center"><?= $error ?></p>
                    <?php endif; ?>
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Usuario</label>
                            <input type="text" id="username" name="username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
                    </form>
                    <hr>
                    <div class="text-center">
                        <p>¿No tienes cuenta?</p>
                        <a href="registro.php" class="btn btn-secondary">Crear Cuenta</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
