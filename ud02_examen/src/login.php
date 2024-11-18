<?php
    // Login
    session_start();

    // Credenciales de Inicio de Sesión
    $usuario_valido = "examen";
    $contrasena_valida = "examen";
    $contrasena2 = "examen";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $usuario = $_POST['usuario'];
        $contrasena = $_POST['contrasena'];

        // Vemos si las credenciales son correctas
        if ($usuario == $usuario_valido && $contrasena == $contrasena_valida & $contrasena2 == $contrasena) {
            // Usuario Logueado
            $_SESSION['logueado'] = true;
            // Llevamos al usuario al index si las credenciales son correctas
            header("Location: eventos.php");
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
    <!-- Formulario de Inicio de Sesión -->
    <div class="container mt-5">
        <h1 class="text-center mb-4">Inicia Sesión</h1>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error; ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-3">
                <label for="usuario" class="form-label">Nombre de Usuario</label>
                <input type="text" placeholder="Introduce tu nombre de usuario" class="form-control" id="usuario" name="usuario" required>
            </div>
            <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña</label>
                <input type="password" placeholder="Introduce tu contraseña" class="form-control" id="contrasena" name="contrasena" required>
            </div>
            <div class="mb-3">
                <label for="contrasena" class="form-label">Repite la contraseña</label>
                <input type="password" placeholder="Introduce de nuevo tu contraseña" class="form-control" id="contrasena2" name="contrasena2" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
        </form>
    </div>
</body>
</html>