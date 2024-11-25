<?php
session_start();

// Destruir sesión
session_destroy();

// Redirigir al inicio (index.php en src/)
header("Location: ../src/index.php");
exit();
?>
