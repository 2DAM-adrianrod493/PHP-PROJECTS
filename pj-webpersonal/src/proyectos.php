<<<<<<< HEAD
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
        <li class="list-group-item">An item</li>
    <?php
        foreach($proyectos as $p ) {
            echo "<li class='list-group-item'>$p</li>";
        }
    ?>
    </ul>

</div>

</body>

=======
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

>>>>>>> cf9a6c3de2b73270e0d2702585e71abd75daefa5
</html>