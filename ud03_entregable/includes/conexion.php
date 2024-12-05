<?php
// Conexión a la base de datos
$servidor = "localhost";
$usuario = "root";
$contraseña = "";
$bd = "biblioteca_virtual";

$conexion = new mysqli($servidor, $usuario, $contraseña, $bd);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
