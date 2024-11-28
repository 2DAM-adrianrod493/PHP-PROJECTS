<?php
session_start();

// Credenciales Admin
$admin_user = "serviferre";
$admin_pass = "serviferre";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $admin_user && $password === $admin_pass) {
        // Iniciar sesión
        $_SESSION['logged_in'] = true;

        // Redirigimos a Empleados
        header("Location: ../src/empleados.php");
        exit();
    } else {
        $_SESSION['error'] = "Usuario o contraseña incorrectos.";

        // Redirigimos de vuelta al Index
        header("Location: ../src/index.php");
        exit();
    }
}
?>