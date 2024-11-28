<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $mensaje = $_POST['mensaje'];

    // Conexión Base de Datos
    $conn = new mysqli("localhost", "root", "", "servi_ferre");

    // Vemos si la Conexión Funcionó
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Archivo SQL
    $filePath = '../bd-serviferre/datos-contacto.sql';

    // Datos a Insertar en el SQL
    $sqlData = "INSERT INTO contacto (nombre, apellidos, email, mensaje) VALUES ('" . 
               mysqli_real_escape_string($conn, $nombre) . "', '" . 
               mysqli_real_escape_string($conn, $apellidos) . "', '" . 
               mysqli_real_escape_string($conn, $email) . "', '" . 
               mysqli_real_escape_string($conn, $mensaje) . "');\n";

    // Ejecutamos la Consulta en la Base de Datos
    if ($conn->query("INSERT INTO contacto (nombre, apellidos, email, mensaje) VALUES ('" . 
               mysqli_real_escape_string($conn, $nombre) . "', '" . 
               mysqli_real_escape_string($conn, $apellidos) . "', '" . 
               mysqli_real_escape_string($conn, $email) . "', '" . 
               mysqli_real_escape_string($conn, $mensaje) . "')")) {
        // Abrimos el SQL en modo de escritura (si no existe, se crea)
        $file = fopen($filePath, 'a');
        
        if ($file) {
            // Escribimos la consulta SQL en el archivo
            fwrite($file, $sqlData);
            // Cerramos el archivo
            fclose($file);
            // Redirigimos con una variable en la URL para mostrar el modal
            header("Location: contacto.php?enviado=true");
            exit();
        } else {
            echo "Error al guardar los Datos. Inténtalo de nuevo más tarde.";
        }
    } else {
        echo "Error al insertar los datos en la Base de Datos.";
    }

    // Cerramos la conexión a la Base de Datos
    $conn->close();
}
?>
