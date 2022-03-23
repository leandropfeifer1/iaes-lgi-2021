

<?php

require('../conexionDb.php');
$id = $_POST['id'];

$query = "SELECT * FROM experiencia WHERE idexp = $id";
$result = mysqli_query($conexion, $query);
if (!$result) {
    die('Query failed!');
}

$json = array();
while ($row = mysqli_fetch_array($result)) {
    $json[] = array(
        'idexp' => $row['idexp'],
        'iduser' => $row['iduser'],
        'empresa' => $row['empresa'],
        'puesto' => $row['puesto'],
        'desde' => $row['desde'],
        'hasta' => $row['hasta'],
        'contacto' => $row['contacto']
    );
}
mysqli_close($conexion);
$jsonstring = json_encode($json[0]);
echo $jsonstring;
?>
