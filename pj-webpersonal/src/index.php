<?php
    $pagina = "inicio"
?>

<?php require 'includes/header.php';

$persona = array(

    "nombre" => "Adrián",
    "apellido" => "Rodríguez",
    "correo" => "adrianrodry55@gmail.com"

);

$agenda = array(

    array(
        "nombre" => "Alejandro",
        "apellido" => "Delgado",
        "correo" => "aledel@gmail.com"
    ),
    array(
        "nombre" => "Dragos",
        "apellido" => "Telita",
        "correo" => "dragos@gmail.com"
    ),
    array(
        "nombre" => "Paula",
        "apellido" => "Cordero",
        "correo" => "paulcor@gmail.com"
    ),

);

foreach($agenda as $clave => $valor){
    foreach($valor as $c => $v){
        echo $v. "<br>";
    }
}

?>

<h2>Inicio</h2>

</body>

</html>