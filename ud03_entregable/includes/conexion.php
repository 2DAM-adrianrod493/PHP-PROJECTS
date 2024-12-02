<?php
$servidor = "localhost";
$usuario = "root";
$contraseña = "";
$base_datos = "biblioteca_virtual";

// Creamos Conexión
$conexion = new mysqli($servidor, $usuario, $contraseña, $base_datos);

// Verificamos Conexión
if ($conexion->connect_error) {
    die("Conexión Fallida: " . $conexion->connect_error);
}
?>
