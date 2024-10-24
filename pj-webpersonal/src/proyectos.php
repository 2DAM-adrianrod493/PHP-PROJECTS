<?php
    $pagina = "proyectos";
    require 'includes/header.php';

    $proyectos=["Desarrollo de Aplicación Móvil Inditex", "Migración de base de datos", "Web personal"]
?>

<body>

<div class="container-fluid">
<h1 class="text-center mb-4">Proyectos</h1>

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