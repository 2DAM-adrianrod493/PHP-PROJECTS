<?php
session_start();

// Credenciales Admin
$admin_user = "sonic555";
$admin_pass = "sonic555";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $admin_user && $password === $admin_pass) {
        $_SESSION['logged_in'] = true;
        header("Location: ../src/empleados.php");
        exit();
    } else {
        $_SESSION['error'] = "Usuario o contraseña incorrectos.";
        header("Location: ../src/index.php");
        exit();
    }
}
?>
