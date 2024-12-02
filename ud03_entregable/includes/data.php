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

// Función para obtener todos los libros
function obtenerLibros($conexion, $categoria = '') {
    $sql = "SELECT libros.id_libro, libros.titulo, libros.autor, libros.imagen, categorias.nombre as categoria
            FROM libros
            JOIN categorias ON libros.id_categoria = categorias.id_categoria";
    
    if ($categoria) {
        $sql .= " WHERE libros.id_categoria = ?";
    }
    
    $stmt = $conexion->prepare($sql);
    
    if ($categoria) {
        $stmt->bind_param("i", $categoria);
    }

    $stmt->execute();
    $resultado = $stmt->get_result();
    return $resultado->fetch_all(MYSQLI_ASSOC);
}

// Función para obtener las categorías
function obtenerCategorias($conexion) {
    $sql = "SELECT * FROM categorias";
    $resultado = $conexion->query($sql);
    return $resultado->fetch_all(MYSQLI_ASSOC);
}

// Función para registrar una reserva
function registrarReserva($conexion, $id_usuario, $id_libro, $fecha_reserva) {
    $sql = "INSERT INTO reservas (id_usuario, id_libro, fecha_reserva) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("iis", $id_usuario, $id_libro, $fecha_reserva);
    return $stmt->execute();
}

// Función para obtener las reservas de un usuario
function obtenerReservasUsuario($conexion, $id_usuario) {
    $sql = "SELECT libros.titulo, reservas.fecha_reserva 
            FROM reservas 
            JOIN libros ON reservas.id_libro = libros.id_libro
            WHERE reservas.id_usuario = ?";
    
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    return $resultado->fetch_all(MYSQLI_ASSOC);
}

// Función para registrar un nuevo libro
function registrarLibro($conexion, $titulo, $autor, $id_categoria, $imagen) {
    $sql = "INSERT INTO libros (titulo, autor, id_categoria, imagen) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssis", $titulo, $autor, $id_categoria, $imagen);
    return $stmt->execute();
}

// Función para eliminar un libro
function eliminarLibro($conexion, $id_libro) {
    $sql = "DELETE FROM libros WHERE id_libro = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_libro);
    return $stmt->execute();
}

// Función para obtener un libro por su ID
function obtenerLibroPorId($conexion, $id_libro) {
    $sql = "SELECT * FROM libros WHERE id_libro = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_libro);
    $stmt->execute();
    $resultado = $stmt->get_result();
    return $resultado->fetch_assoc();
}

// Función para obtener todas las reservas
function obtenerTodasLasReservas($conexion) {
    $sql = "SELECT usuarios.nombre, libros.titulo, reservas.fecha_reserva
            FROM reservas
            JOIN usuarios ON reservas.id_usuario = usuarios.id_usuario
            JOIN libros ON reservas.id_libro = libros.id_libro";
    
    $resultado = $conexion->query($sql);
    return $resultado->fetch_all(MYSQLI_ASSOC);
}

// Función para autenticar un usuario
function autenticarUsuario($conexion, $email, $contraseña) {
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $usuario = $resultado->fetch_assoc();

    if ($usuario && password_verify($contraseña, $usuario['contraseña'])) {
        return $usuario; // Usuario autenticado
    } else {
        return false; // Usuario no encontrado o contraseña incorrecta
    }
}

// Función para registrar un nuevo usuario
function registrarUsuario($conexion, $nombre, $email, $contraseña) {
    $contraseña_hash = password_hash($contraseña, PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuarios (nombre, email, contraseña) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sss", $nombre, $email, $contraseña_hash);
    return $stmt->execute();
}

// Función para verificar si un correo electrónico ya está registrado
function verificarEmail($conexion, $email) {
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();
    return $resultado->num_rows > 0;
}
?>
