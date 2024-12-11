<?php
    include('conexion.php');

    // Obtener Campeonatos por Provincia
    function obtenerCampeonatosPorProvincia($conexion, $id_campeonato = null) {
        $query = "SELECT campeonatos.id_campeonato, campeonatos.nombre, campeonatos.fecha, campeonatos.imagen, campeonatos.cerrado, campeonatos.nombre AS campeonato
                FROM campeonatos
                JOIN campeonatos ON campeonatos.id_campeonato = campeonatos.id_campeonato";
        
        if ($id_categoria) {
            $query .= " WHERE campeonatos.id_campeonato = $id_campeonato";
        }

        $result = $conexion->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Obtener Campeonatos
    function obtenerCampeonatos($conexion) {
        $query = "SELECT * FROM campeonatos";
        $result = $conexion->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Obtener Provincias
    function obtenerProvincia($conexion) {
        $query = "SELECT provincia FROM campeonatos";
        $result = $conexion->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

     // Obtener Registro
     function obtenerRegistro($conexion) {
        $query = "SELECT cerrado FROM campeonatos";
        $result = $conexion->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Autenticar Usuario
    function autenticarUsuario($conexion, $nombre_usuario, $contraseña) {
        $sql = "SELECT * FROM usuarios WHERE nombre = ?";
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

    // Inscribirse a Campeonato
    function inscribirse($conexion, $usuario_id, $id_campeonato, $fecha) {
        $query = "INSERT INTO inscripciones (id_usuario, id_campeonato, fecha) VALUES (?, ?, ?)";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("iis", $usuario_id, $id_campeonato, $fecha);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Obtener Inscripciones de un Usuario
    function obtenerInscripcionesUsuario($conexion, $id_usuario) {
        $sql = "SELECT campeonatos.nombre, campeonatos.fecha 
                FROM inscripciones 
                JOIN campeonatos ON inscripciones.id_campeonato = campeonatos.id_campeonato
                WHERE inscripciones.id_usuario = ?";
        
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    // Obtener Campeonato por ID
    function obtenerCampeonatoPorID($conexion, $id_campeonato) {
        $query = "SELECT * FROM campeonatos WHERE id_campeonato = ?";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("i", $id_campeonato);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Actualizamos la Disponibilidad el Campeonato
    function actualizarDisponibilidadCampeonato($conexion, $id_campeonato, $cerrado) {
        $query = "UPDATE campeonatos SET cerrado = ? WHERE id_campeonato = ?";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("ii", $cerrado, $id_campeonato);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
?>