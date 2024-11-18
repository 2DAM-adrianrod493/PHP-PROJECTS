<?php
    // Login
    session_start();
    if (!isset($_SESSION['logueado'])) {
        header("Location: login.php");
        exit();
    }

    // Datos de los Eventos
    $eventos = [
        ["id" => 1, "nombre" => "Boda de Ana y Luis", "fecha" => "2024-12-15", "ubicacion" => "Madrid", "descripcion" => "Ceremonia en el parque central con una recepción al aire libre en un jardín privado.", "fotografo" => "Sí", "pagado" => "Sí"],
        ["id" => 2, "nombre" => "Aniversario de Carla y Jorge", "fecha" => "2024-11-20", "ubicacion" => "Sevilla", "descripcion" => "Celebración en la playa con temática tropical y cena bajo las estrellas.", "fotografo" => "No", "pagado" => "Sí"],
        ["id" => 3, "nombre" => "Fiesta de Compromiso de Marta y José", "fecha" => "2024-10-10", "ubicacion" => "Sevilla", "descripcion" => "Evento íntimo en una terraza con vista al mar, decorado con luces cálidas.", "fotografo" => "No", "pagado" => "No"],
        ["id" => 4, "nombre" => "Boda de Claudia y Pablo", "fecha" => "2025-01-22", "ubicacion" => "Barcelona", "descripcion" => "Boda en un salón elegante con una ceremonia civil y recepción con cena formal.", "fotografo" => "Sí", "pagado" => "Sí"],
        ["id" => 5, "nombre" => "Cena de Navidad de la Empresa XYZ", "fecha" => "2024-12-23", "ubicacion" => "Madrid", "descripcion" => "Una cena formal para los empleados de XYZ en un restaurante exclusivo con temática navideña.", "fotografo" => "No", "pagado" => "Sí"],
        ["id" => 6, "nombre" => "Baby Shower de Sara", "fecha" => "2025-02-15", "ubicacion" => "Granada", "descripcion" => "Celebración de bienvenida para el bebé de Sara, con decoración temática y actividades familiares.", "fotografo" => "No", "pagado" => "No"],
    
    ];

    /*
    // Ordenar por Fecha los Eventos
    function array_orderby()
    {
        $args = func_get_args();
        $data = array_shift($args);
        foreach ($args as $arg) {
            $sort = [];
            foreach ($data as $key => $row) {
                $sort[$key] = $row[$arg];
            }
            array_multisort($sort, $data);
        }
        return $data;
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ordenar'])) {
        if ($_POST['ordenar'] == 'des') {
            $eventos = array_orderby($eventos, 'fecha');
        } elseif ($_POST['ordenar'] == 'asce') {
            $eventos = array_reverse(array_orderby($eventos, 'fecha'));
        }
    }
    */

    // Descargar TXT de cada Evento
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['export_single'])) {
        $evento_id = $_POST['evento_id'];
        
        // Buscamos Evento por ID
        $evento = null;
        foreach ($eventos as $a) {
            if ($a['id'] == $evento_id) {
                $evento = $a;
                break;
            }
        }
        
        if ($evento) {
            // Ruta Descarga
            $ruta_archivo = './detalles_eventos/evento_' . $evento_id . '.txt';
            
            // Creamos y abrimos el TXT
            $archivo = fopen($ruta_archivo, 'w');
            
            // Escribimos los Datos en el TXT
            fwrite($archivo, "Nombre del evento: {$evento['nombre']} 
            Lugar: {$evento['ubicacion']}, Fecha: {$evento['fecha']} 
            Fecha: {$evento['fecha']} 
            Descripción: {$evento['descripcion']} 
            Incluye Fotógrafo: {$evento['fotografo']} 
            Pagado: {$evento['pagado']}\n");

            // Cerramos TXT
            fclose($archivo);
            
            // Forzamos Descarga
            header('Content-Type: text/plain');
            header('Content-Disposition: attachment; filename="evento_' . $evento_id . '.txt"');
            readfile($ruta_archivo);
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Eventos</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/cabecera.css">
    </head>

    <body>
        <?php require 'includes/header.php'; ?>

        <div class="container-fluid mt-7">

            <!-- Filtrado por Ubicación y Pago -->
            <div>
                <!-- Ubicación -->
                <div class="mb-4">
                    <select class="form-select form-select-sm" aria-label="Small select example">
                        <option selected>Elija la ciudad...</option>
                        <option value="1">Madrid</option>
                        <option value="2">Sevilla</option>
                        <option value="3">Barcelona</option>
                        <option value="4">Granada</option>
                    </select>
                </div>

                <!-- Pagado -->
                <div class="mb-4">
                    <select class="form-select form-select-sm" aria-label="Small select example">
                        <option selected>Seleccione si está pagado...</option>
                        <option value="1">Sí</option>
                        <option value="2">No</option>
                    </select>
                </div>
            </div>

            <div class="row mt-5">
                <?php foreach ($eventos as $evento): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card text-left mb-3">
                            <!-- Título de la Card -->
                            <div class="card-header">
                                <h5 class="card-title"><?= $evento['nombre']; ?></h5>
                            </div>

                            <div class="card-body">
                                <!-- Detalles Botón -->
                                <h5 class="card-text"><?= $evento['ubicacion']; ?></h5>
                                <h5 class="card-text"><?= $evento['fecha']; ?></h5>
                                <p class="card-text"><?= $evento['descripcion']; ?></p>
                                <td>
                                    <!-- Botón Descarga de cada Evento -->
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="evento_id" value="<?= $evento['id']; ?>">
                                        <button type="submit" name="export_single" class="btn btn-info">Detalle</button>
                                    </form>
                                </td>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div> 
        </div>
    </body>

</html>