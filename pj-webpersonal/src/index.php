<?php
    $pagina = "inicio"
?>

<?php require 'includes/header.php';

$persona = array(

    "nombre" => "maria",
    "apellido" => "millan",
    "correo" => "aaaa@gmail.com"

);

foreach ($persona as $clave => $p) {

    echo $clave."-".$valor."<br>";

};

$agenda = array(

    array(
        "nombre" => "maria",
        "apellido" => "millan",
        "correo" => "aaaa@gmail.com"
    ),
    array(
        "nombre" => "sara",
        "apellido" => "perez",
        "correo" => "aaaa@gmail.com"
    ),
    array(
        "nombre" => "carlos",
        "apellido" => "gonzalez",
        "correo" => "aaaa@gmail.com"
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