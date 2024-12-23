<?php
include('conexion.php');

// Obtener Libros por Categoría
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

// Obtener Categorías
function obtenerCategorias($conexion) {
    $query = "SELECT * FROM categorias";
    $result = $conexion->query($query);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Autenticar Usuario
function autenticarUsuario($conexion, $nombre_usuario, $contraseña) {
    $sql = "SELECT * FROM usuarios WHERE nombre_usuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $nombre_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $usuario = $resultado->fetch_assoc();

    if ($usuario && password_verify($contraseña, $usuario['password'])) {
        return $usuario;
    } else {
        return false;
    }
}

// Obtener Nombre Usuario Logueado
function obtenerUsuarioLogueado() {
    if (isset($_SESSION['usuario'])) {
        return $_SESSION['usuario'];
    }
    return null;
}

function registrarReserva($conexion, $usuario_id, $id_libro, $fecha_reserva) {
    $query = "INSERT INTO reservas (id_usuario, id_libro, fecha_reserva) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("iis", $usuario_id, $id_libro, $fecha_reserva);
    
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// Obtener Reservas de un Usuario
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

// Obtener Reservas Admin
function obtenerTodasLasReservas($conexion) {
    $sql = "SELECT usuarios.nombre_usuario, libros.titulo, reservas.fecha_reserva
            FROM reservas
            JOIN usuarios ON reservas.id_usuario = usuarios.id_usuario
            JOIN libros ON reservas.id_libro = libros.id_libro";
    
    $resultado = $conexion->query($sql);
    return $resultado->fetch_all(MYSQLI_ASSOC);
}

// Obtener Libro por ID
function obtenerLibroPorId($conexion, $id_libro) {
    $query = "SELECT * FROM libros WHERE id_libro = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $id_libro);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

// Actualizamos la Disponibilidad el Libro
function actualizarDisponibilidadLibro($conexion, $id_libro, $disponibilidad) {
    $query = "UPDATE libros SET disponible = ? WHERE id_libro = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("ii", $disponibilidad, $id_libro);
    
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// Registrar Nuevo Usuario
function registrarUsuario($conexion, $nombre_usuario, $email, $password) {
    $query = "INSERT INTO usuarios (nombre_usuario, email, password) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("sss", $nombre_usuario, $email, $password);
    
    return $stmt->execute(); // Devuelve true si el registro fue exitoso
}

// Verificar si un correo ya está registrado
function verificarUsuarioPorEmail($conexion, $email) {
    $query = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    return $stmt->get_result()->num_rows > 0;
}
?>
