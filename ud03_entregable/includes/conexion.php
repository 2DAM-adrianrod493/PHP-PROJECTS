<?php
// Conexión Base de Datos
$servidor = "localhost";
$usuario = "root";
$contraseña = "";
$bd = "biblioteca_virtual";

$conexion = new mysqli($servidor, $usuario, $contraseña, $bd);

if ($conexion->connect_error) {
    die("Conexión Fallida: " . $conexion->connect_error);
}
?>
