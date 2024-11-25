<?php
// Archivo de Conexión a la Base de Datos
require_once 'conexion.php';

// Función para Obtener Tareas desde la Base de Datos
function getTareas($db) {
    $sql = "SELECT id, titulo, descripcion, fecha_entrega, estado FROM tareas;";
    $tareas = mysqli_query($db, $sql);
    $resultado = array();

    if ($tareas && mysqli_num_rows($tareas) > 0) {
        while ($tarea = mysqli_fetch_assoc($tareas)) {
            array_push($resultado, $tarea);
        }
    }
    return $resultado;
}
?>
