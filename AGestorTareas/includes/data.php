<?php
// Archivo de Conexión a la Base de Datos
require 'conexion.php';

// Función de Obtener Tareas desde la Base de Datos
function getTareas($db) {
    // Preparamos la consulta SQL
    $sql = "SELECT id, titulo, descripcion, fecha_entrega, estado FROM tareas t;";
    
    // Ejecutamos la consulta SQL
    $tareas = mysqli_query($db, $sql);

    // Array vacío para almacenar las tareas
    $resultado = array();

    // Si la Consulta me da Resultados, entra
    if (mysqli_num_rows($tareas) > 0) {
        // Recorremos cada Fila
        while ($tarea = mysqli_fetch_assoc($tareas)) {
            // Agregamos cada Tarea al Array
            array_push($resultado, $tarea);
        }
    }
    // Devolvemos el Array con los Resultados
    return $resultado;
}
?>
