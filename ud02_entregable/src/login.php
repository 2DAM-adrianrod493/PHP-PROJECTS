<?php
    // Login
    session_start();

    // Credenciales de Inicio de Sesión
    $usuario_valido = "rodry";
    $contrasena_valida = "1234";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $usuario = $_POST['usuario'];
        $contrasena = $_POST['contrasena'];

        // Comprobamos si las credenciales coincicen
        if ($usuario == $usuario_valido && $contrasena == $contrasena_valida) {
            // Usuario logueado
            $_SESSION['logueado'] = true;
            // Redirigimos al usuario al index después de iniciar sesión
            header("Location: index.php");
            exit();
        } else {
            // Credenciales Incorrectas
            $error = "Usuario o contraseña incorrectos";
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/cabecera.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Inicia Sesión</h1>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error; ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-3">
                <label for="usuario" class="form-label">Nombre de Usuario</label>
                <input type="text" class="form-control" id="usuario" name="usuario" required>
            </div>
            <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="contrasena" name="contrasena" required>
            </div>
            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
        </form>
    </div>
</body>
</html>