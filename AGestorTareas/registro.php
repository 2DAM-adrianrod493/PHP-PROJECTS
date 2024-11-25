<?php
require './includes/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

    // Insertamos el nuevo usuario
    $sql = "INSERT INTO usuarios (email, contraseña) VALUES ('$username', '$password')";
    if (mysqli_query($db, $sql)) {
        $success = "Usuario registrado con éxito.";
    } else {
        $error = "Error al registrar usuario.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center">Registrarse</h2>
                    <?php if (isset($success)): ?>
                        <p class="text-success text-center"><?= $success ?></p>
                    <?php elseif (isset($error)): ?>
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
                        <button type="submit" class="btn btn-success w-100">Registrar</button>
                    </form>
                    <hr>
                    <div class="text-center">
                        <p>¿Ya tienes cuenta?</p>
                        <a href="login.php" class="btn btn-secondary">Iniciar Sesión</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-wUPOMFZGsIWAEvJSojlE8qw3dGONxUg9AIkIQr5yYXT14mTn9tAz5fqYo4x4JNdA" crossorigin="anonymous"></script>
</body>
</html>
