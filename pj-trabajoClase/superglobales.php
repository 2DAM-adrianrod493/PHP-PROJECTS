<?php

    $nombre_Recibido= $_GET['nombre'];
    $apellido_Recibido= $_GET['apellido'];
    echo "<h2>Hola $nombre_Recibido $apellido_Recibido</h2> ";

    $x=5;
    echo $x--;
    echo "<br>";
    echo --$x;

?>