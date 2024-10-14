<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ej2</title>
    <style>
        table {
            width: 50%;
            margin: 20px auto;
        }
        td {
            border: 2px solid black;
            padding: 10px;
            text-align: center;
        }
    </style>
    
    </head>
    <body>
        <h1 style="text-align:center;">Ej2</h1>
        <table>
            <?php
            $num = 1;
            // Generar las filas de la tabla
            for ($fil = 1; $fil <= 10; $fil++) {
                echo "<tr>";
                // Generar las columnas de la tabla
                for ($column = 1; $column <= 10; $column++) {
                    echo "<td>$num</td>";
                    $num++;
                }
                echo "</tr>";
            }
            ?>
        </table>
    </body>
</html>