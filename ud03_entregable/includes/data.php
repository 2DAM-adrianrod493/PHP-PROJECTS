<?php
include('conexion.php');

// Función para obtener libros con opción de filtro por categoría
function obtenerLibros($conexion, $id_categoria = null) {
    $query = "SELECT libros.id_libro, libros.titulo, libros.autor, libros.imagen, libros.disponible, categorias.nombre AS categoria
              FROM libros
              JOIN categorias ON libros.id_categoria = categorias.id_categoria";
    
    if ($id_categoria) {
        $query .= " WHERE libros.id_categoria = $id_categoria";
    }

    $result = $conexion->query($query);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Función para obtener categorías
function obtenerCategorias($conexion) {
    $query = "SELECT * FROM categorias";
    $result = $conexion->query($query);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Función para autenticar un usuario con nombre de usuario (no email)
function autenticarUsuario($conexion, $nombre_usuario, $contraseña) {
    $sql = "SELECT * FROM usuarios WHERE nombre_usuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $nombre_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $usuario = $resultado->fetch_assoc();

    if ($usuario && password_verify($contraseña, $usuario['password'])) {
        return $usuario; // Usuario autenticado
    } else {
        return false; // Usuario no encontrado o contraseña incorrecta
    }
}


// Función para obtener el nombre del usuario logueado
function obtenerUsuarioLogueado() {
    if (isset($_SESSION['usuario'])) {
        return $_SESSION['usuario'];
    }
    return null;
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

// Función para obtener todas las reservas (para administradores)
function obtenerTodasLasReservas($conexion) {
    $sql = "SELECT usuarios.nombre_usuario, libros.titulo, reservas.fecha_reserva
            FROM reservas
            JOIN usuarios ON reservas.id_usuario = usuarios.id_usuario
            JOIN libros ON reservas.id_libro = libros.id_libro";
    
    $resultado = $conexion->query($sql);
    return $resultado->fetch_all(MYSQLI_ASSOC);
}

// Función para obtener un libro por su ID
function obtenerLibroPorId($conexion, $id_libro) {
    $query = "SELECT * FROM libros WHERE id_libro = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $id_libro);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}
?>
