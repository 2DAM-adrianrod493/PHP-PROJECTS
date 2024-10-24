<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ej1</title>
    </head>
    <body>
        <h1>Fecha Actual:</h1>
        <p>
            <?php
            // Locale en Español
            setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'esp');
            
            // Fecha actual con formato
            echo strftime("%A, %d de %B de %Y");
            ?>
        </p>
    </body>
</html>