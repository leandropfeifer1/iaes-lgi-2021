<?php
session_start();
require('../conexionDb.php');

if (isset($_SESSION['id_user']) && isset($_SESSION['id_rol'])) {
    $sql = 'SELECT idrol from roles where descripcion = "usuario"';
    $resultado = mysqli_query($conexion, $sql);
    if (!empty($resultado) && mysqli_num_rows($resultado) != 0) {
        $row = mysqli_fetch_assoc($resultado);
    }
    if (isset($row['idrol'])) {
        if ($_SESSION['id_rol'] != $row['idrol']) {
            header('location: ../db/logout.php');
        }
    }
    mysqli_close($conexion);
} else {
    header('location: ../logout.php');
}
?>

<?php
require('../conexionDb.php');
$iduser = $_SESSION['id_user'];

try {
    //Selecciona todas las experiencias de un usuario 
    $query = "SELECT * FROM experiencia WHERE iduser='$iduser'";
    $result = mysqli_query($conexion, $query);
    if (!$result) {
        die('Query failed!' . mysqli_error($conexion));
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
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
$jsonstring = json_encode($json);
echo $jsonstring;

?>