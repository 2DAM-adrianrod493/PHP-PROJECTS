<?php
// Archivo de Conexión a la Base de Datos
require_once 'conexion.php';

// Obtener los Alumnos
function getAlumnos($db) {
    $sql = "SELECT id, nombre, apellido, grado, curso FROM alumnos;";
    $alumnos = mysqli_query($db, $sql);
    $resultado = array();

    if ($alumnos && mysqli_num_rows($alumnos) > 0) {
        while ($alumno = mysqli_fetch_assoc($alumnos)) {
            array_push($resultado, $alumno);
        }
    }
    return $resultado;
}

// Obtener los Apercibimientos
function getApercibimientos($db) {
    $sql = "SELECT id, alumno_id, fecha, motivo, estado FROM apercibimientos;";
    $apercibimientos = mysqli_query($db, $sql);
    $resultado = array();

    if ($apercibimientos && mysqli_num_rows($apercibimientos) > 0) {
        while ($apercibimiento = mysqli_fetch_assoc($apercibimientos)) {
            array_push($resultado, $apercibimiento);
        }
    }
    return $resultado;
}

?>