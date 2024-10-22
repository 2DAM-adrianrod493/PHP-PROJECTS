<<<<<<< HEAD
<?php
    $pagina = "sobremi"
?>

<?php require 'includes/header.php';?>

<h2>Sobre Mí</h2>

</body>

</html>
=======
<?php
    $pagina = "sobremi";

    require 'includes/header.php';

    $hobbies = array(
        array(
            "nombre" => "Fútbol",
            "descripcion" => "Un deporte de equipo en el que dos equipos compiten para meter un balón en la portería del rival.",
            "imagen" => "../src/img/futbol.jpg",
            "veces_por_semana" => 3
        ),
        array(
            "nombre" => "Pesca",
            "descripcion" => "Lanzar una caña con cebo al mar para pescar peces.",
            "imagen" => "../src/img/pesca.jpg",
            "veces_por_semana" => 1
        ),
        array(
            "nombre" => "Gym",
            "descripcion" => "Un deporte de musculación donde se levantan pesas y se hacen diversos ejercicios para la suma de masa muscular.",
            "imagen" => "../src/img/gym.jpg",
            "veces_por_semana" => 5
        )
    );

    function array_orderby($arrayToOrder, $field) {
        $columna = array_column($arrayToOrder, $field);
        array_multisort($columna, SORT_ASC, $arrayToOrder);
        return $arrayToOrder;
    }

    // Ordenar los hobbies por "veces_por_semana"
    $hobbies_ord = array_orderby($hobbies, "veces_por_semana");
?>

<div class="container">
    <h1 class="text-center mb-4">Sobre Mí</h1>
    <div class="row justify-content-center">
        <?php
            // Usar el array ordenado
            foreach($hobbies_ord as $hob) {
                $nombre = $hob["nombre"];
                $descripcion = $hob["descripcion"];
                $imagen = $hob["imagen"];
                $veces_por_semana = $hob["veces_por_semana"];

                echo "<div class='col-md-4 d-flex justify-content-center mb-4'>
                        <div class='card d-flex flex-column align-items-center text-center' style='width: 18rem; height: 100%;'>
                            <img src='$imagen' class='card-img-top' alt='$nombre' style='width: 75px; height: auto;'>
                            <div class='card-body d-flex flex-column'>
                                <h5 class='card-title'>$nombre</h5>
                                <p class='card-text'>$descripcion</p>
                                <a href='#' class='btn btn-primary mt-auto'>$veces_por_semana veces por semana</a>
                            </div>
                        </div>
                    </div>";
            }
        ?>
    </div>
</div>

</body>
</html>
>>>>>>> cf9a6c3de2b73270e0d2702585e71abd75daefa5
