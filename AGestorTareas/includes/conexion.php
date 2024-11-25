<?php
// Parámetros de Conexión a la Base de Datos
$servidor = "localhost";
$usuario = "root"; // Cambiado de "raíz" a "root"
$contraseña = "";
$base_datos = "gestion";

// Creamos Conexión a la Base de Datos
$db = mysqli_connect($servidor, $usuario, $contraseña, $base_datos);

// Verificamos que la Conexión haya sido Exitosa
if (!$db) {
    die("Error en la conexión: " . mysqli_connect_error());
}
?>
