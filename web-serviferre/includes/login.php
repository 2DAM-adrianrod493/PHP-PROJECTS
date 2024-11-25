<?php
session_start();

// Credenciales Admin
$admin_user = "sonic555";
$admin_pass = "sonic555";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $admin_user && $password === $admin_pass) {
        // Iniciar sesión
        $_SESSION['logged_in'] = true;

        // Redirigir a empleados.php en src/
        header("Location: ../src/empleados.php");
        exit();
    } else {
        // Guardar mensaje de error en sesión
        $_SESSION['error'] = "Usuario o contraseña incorrectos.";

        // Redirigir de vuelta a index.php en src/
        header("Location: ../src/index.php");
        exit();
    }
}
?>
