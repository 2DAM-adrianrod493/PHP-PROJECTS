<?php
session_start();
require './includes/data.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtenemos los Datos del Formulario
    $nombre_usuario = $_POST['nombre_usuario'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validamos Credenciales
    if ($password !== $confirm_password) {
        $error = "No Coinciden las Contraseñas :(";
    } else {
        // Verificación Email Registrado o No
        $usuario_existente = verificarUsuarioPorEmail($conexion, $email);
        if ($usuario_existente) {
            $error = "Error, Correo ya Registrado :(";
        } else {
            // Registramos Usuario
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $registro_exitoso = registrarUsuario($conexion, $nombre_usuario, $email, $hashed_password);

            if ($registro_exitoso) {
                $_SESSION['usuario'] = $nombre_usuario; // Guardamos el nombre del usuario en la sesión
                $_SESSION['id_usuario'] = $conexion->insert_id; // Asignamos ID del usuario insertado
                header('Location: index.php'); // Redirigimos a la página principal
                exit();
            } else {
                $error = "Error al Registrar el Usuario :(";
            }
        }
    }
}
?>

<!-- Formulario de Registro -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Usuario</title>
</head>
<body>

<h1>Registrar Usuario</h1>

<?php
if (isset($error)) {
    echo "<p style='color: red;'>$error</p>";
}
?>

<form action="registro.php" method="POST">
    <label for="nombre_usuario">Nombre de Usuario:</label>
    <input type="text" name="nombre_usuario" id="nombre_usuario" required><br><br>

    <label for="email">Correo Electrónico:</label>
    <input type="email" name="email" id="email" required><br><br>

    <label for="password">Contraseña:</label>
    <input type="password" name="password" id="password" required><br><br>

    <label for="confirm_password">Confirmar Contraseña:</label>
    <input type="password" name="confirm_password" id="confirm_password" required><br><br>

    <button type="submit">Registrar</button>
</form>

</body>
</html>
