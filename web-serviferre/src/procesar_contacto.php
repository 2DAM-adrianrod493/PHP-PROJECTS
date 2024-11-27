<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $mensaje = $_POST['mensaje'];

    // Conexión a la base de datos
    $conn = new mysqli("localhost", "root", "", "servi_ferre");

    // Verificar si la conexión fue exitosa
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Ruta donde se guardará el archivo SQL
    $filePath = '../bd-serviferre/datos-contacto.sql';

    // Datos a insertar en el archivo SQL (usamos mysqli_real_escape_string para evitar problemas con caracteres especiales)
    $sqlData = "INSERT INTO contacto (nombre, apellidos, email, mensaje) VALUES ('" . 
               mysqli_real_escape_string($conn, $nombre) . "', '" . 
               mysqli_real_escape_string($conn, $apellidos) . "', '" . 
               mysqli_real_escape_string($conn, $email) . "', '" . 
               mysqli_real_escape_string($conn, $mensaje) . "');\n";

    // Ejecutar la consulta directamente en la base de datos
    if ($conn->query("INSERT INTO contacto (nombre, apellidos, email, mensaje) VALUES ('" . 
               mysqli_real_escape_string($conn, $nombre) . "', '" . 
               mysqli_real_escape_string($conn, $apellidos) . "', '" . 
               mysqli_real_escape_string($conn, $email) . "', '" . 
               mysqli_real_escape_string($conn, $mensaje) . "')")) {
        // Abrir el archivo en modo de escritura (si no existe, lo crea)
        $file = fopen($filePath, 'a');
        
        if ($file) {
            fwrite($file, $sqlData);  // Escribir la consulta SQL en el archivo
            fclose($file);  // Cerrar el archivo
            // Redirigir con una variable en la URL para mostrar el modal
            header("Location: contacto.php?enviado=true");
            exit();
        } else {
            echo "Error al guardar los Datos. Inténtalo de nuevo más tarde.";
        }
    } else {
        echo "Error al insertar los datos en la base de datos.";
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
}
?>
