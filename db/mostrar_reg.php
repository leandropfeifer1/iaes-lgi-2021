<?php

include('conexionDb.php');
$id = $_POST['id'];

$query = "SELECT * FROM usuario WHERE idloc = '$id'";
$result = mysqli_query($conexion, $query);
if (!$result) {
    die('Query failed!');
}

$json = array();
while ($row = mysqli_fetch_array($result)) {
    $json[] = array(
        'usuario' => $row['usuario'],
        'apellido' => $row['apellido'],
        'fechanacimiento' => $row['fechanacimiento'],
        'dni' => $row['dni'],
        'genero' => $row['genero'],
        'discapacidades' => $row['discapacidades'],
        'correo' => $row['correo'],
        'contacto' => $row['contacto'],
        'ecivil' => $row['ecivil'],
        'domicilio' => $row['domicilio'],
        'localidad' => $row['localidad'],
        'departamento' => $row['departamento'],
        'provincia' => $row['provincia'],
        'idpais' => $row['idpais'],
        'cursos' => $row['cursos'],
        'pdf' => $row['pdf'],
        'licencia' => $row['licencia'],
        'auto' => $row['auto'],
        'situacionlab' => $row['situacionlab'],
        'modalidad' => $row['modalidad'],
        'area' => $row['area'],
        'salariomin' => $row['salariomin'],
        'dispoviajar' => $row['dispoviajar'],
        'dispomuda' => $row['dispomuda'],
        'progs' => $row['progs'],
        'habilidades' => $row['habilidades'],
        'foto' => $row['foto']
    );
}
if($json){
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}



?>