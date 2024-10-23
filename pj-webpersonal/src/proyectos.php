<?php
    $pagina = "proyectos";
    require 'includes/header.php';

    $proyectos=["Desarrollo de Aplicación Móvil Inditex", "Migración de base de datos", "Web personal"]
?>


<h2>Proyectos</h2>

<body>

<div class="container-fluid">
    <h2 class="d-flex align-items-center justify-content-center">Proyectos</h2>

    <ul class="list-group">
        <?php
            foreach($proyectos as $p ) {
                echo "<li class='list-group-item'>$p</li>";
            }
        ?>
    </ul>

</div>

</body>
</html>