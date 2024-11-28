<?php
session_start();

// Destruimos sesión
session_destroy();

// Redirigimos al Index
header("Location: ../src/index.php");
exit();
?>
