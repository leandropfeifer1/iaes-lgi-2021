
<?php

require('conexionDb.php');
mysqli_set_charset($conexion, "utf8");
$query = "SELECT `idcar`, `carrera` FROM `carrera`";
$result = mysqli_query($conexion, $query);
$json = array();
while ($row = mysqli_fetch_array($result)) {
    $json[] = array(
        'idcar' => $row['idcar'],
        'carrera' => $row['carrera']
    );
}
$jsonstring = json_encode($json);
echo $jsonstring;
mysqli_close($conexion);

?>