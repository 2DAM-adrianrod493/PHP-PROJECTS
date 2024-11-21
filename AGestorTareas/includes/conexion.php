<?php
// Parámetros de Conexión a la Base de Datos
$servidor = "localhost";
$usuario = "root";
$contraseña = "";
$base_datos = "gestion";

// FORMA 1: CONEXIÓN PROCEDURAL
// Creamos Conexión a la Base de Datos
$db = mysqli_connect($servidor, $usuario, $contraseña, $base_datos);

// Verificamos que la Conexión haya sido Exitosa
if (!$db) {
    // Si da error, detenemos la conexión y se muestra un error
    die("Error en la conexión: " . mysqli_connect_error());
}

/*
// Consulta SQL para obtener Tareas
$sql = "SELECT id, titulo, descripcion, fecha_entrega, estado FROM tareas t;";

// Ejecutamos la Consulta en la Base de Datos
$resultado = mysqli_query($db, $sql);

// Verificamos que la Consulta devuelva Resultados
if (mysqli_num_rows($resultado) > 0) {
    // Si existen resultados, recorremos las fila y mostramos los Datos
    while ($fila = mysqli_fetch_assoc($resultado)) {
        // Mostramos los Datos
        echo "ID tarea: " . $fila["id"] . "<br>";
        echo "Título: " . $fila["titulo"] . "<br>";
        echo "Descripción: " . $fila["descripcion"] . "<br>";
        echo "================<br>";
    }
} else {
    // Si no existen datos, se muestra un mensaje
    echo "No se encontraron tareas.";
}
*/
?>