<?php

include('conexionDb.php');
$id = $_POST['id'];

$query = "SELECT * FROM usuario WHERE iduser = $id";
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
        'ecivil' => $row['ecivil'],
        'correo' => $row['correo'],
        'contacto' => $row['contacto'],
        'codpostal' => $row['codpostal'],
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
        'area' => $row['area'],
        'salariomin' => $row['salariomin'],
        'dispoviajar' => $row['dispoviajar'],
        'dispomuda' => $row['dispomuda'],
        'progs' => $row['progs'],
        'foto' => $row['foto'],
        'niveledu' => $row['niveledu'],
        'puestodeseado' => $row['puestodeseado']
    );
}

$jsonstring = json_encode($json[0]);
echo $jsonstring;
?>