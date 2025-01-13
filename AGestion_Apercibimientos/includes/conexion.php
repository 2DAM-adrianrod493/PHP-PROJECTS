<?php
    $servidor = "localhost";
    $usuario = "root";
    $contraseña = "usuario";
    $base_datos = "centroeducativo";

    // Crear conexión
    $conexion = mysqli_connect($servidor, $usuario, $contraseña, $base_datos);

    // Verificar conexión
    if (!$conexion) {
        die("Conexión fallida: " . mysqli_connect_error());    
    }
?>