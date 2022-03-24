<?php
session_start();
require('./conexionDb.php');
$id = $_POST['id'];

$query = "SELECT * FROM carxuser WHERE carxuser.iduser= '$id'";
$result = mysqli_query($conexion, $query);
if (!$result) {
    die('Query failed!');
}

$json = array();
while ($row = mysqli_fetch_array($result)) {
    $json[] = array(
        'idcar' => $row['idcar']
    );
}
if($json){
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}
mysqli_close($conexion);
?>