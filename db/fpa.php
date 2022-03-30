<?php

session_start();
require('./conexionDb.php');
mysqli_set_charset($conexion, "utf8");
$data;
if (isset($_SESSION['id_user'])) {
    $consulta = "SELECT * FROM `localidad`";
    $pais = null;
    $b = 0;
    $p;
    if (isset($_POST['pais']) && $_POST['pais'] != 0) {
        $p = $_POST['pais'];
        $consulta .= " WHERE `idpais`=$p";
        $b = 1;
    }
    if (isset($_POST['provincia']) && $_POST['provincia'] != 0) {
        if ($b == 0) {
            $pro = $_POST['provincia'];
            $consulta .= " WHERE `idpro` =$pro";

            $b = 1;
        } else {
            $pro = $_POST['provincia'];
            $consulta .= " AND `idpro`=$pro";
        }
    }
    if (isset($_POST['departamento']) && $_POST['departamento'] != 0) {
        if ($b == 0) {
            $dep = $_POST['departamento'];
            $consulta .= " WHERE `idep` =$dep";

            $b = 1;
        } else {
            $dep = $_POST['departamento'];
            $consulta .= " AND `idep`=$dep";
        }
    }
    if (isset($_POST['localidad']) && $_POST['localidad'] != 0) {
        if ($b == 0) {
            $loc = $_POST['localidad'];
            $consulta .= " WHERE `idloc` =$loc";
            $b = 1;
        } else {
            $loc = $_POST['localidad'];
            $consulta .= " AND `idloc`=$loc";
        }
    }
}

$lista = mysqli_query($conexion, $consulta);
$json = array();
while ($fila = $lista->fetch_assoc()) {
    $sql3 = "SELECT departamento FROM `departamento` WHERE idep=" . $fila['idep'] . "";
    $result3 = mysqli_query($conexion, $sql3);
    $departamento = mysqli_fetch_array($result3);
    $sql4 = "SELECT `provincia` FROM `provincia` WHERE idpro=" . $fila['idpro'] . "";
    $result4 = mysqli_query($conexion, $sql4);
    $provincia = mysqli_fetch_array($result4);
    $sql5 = "SELECT pais FROM `pais` WHERE idpais=" . $fila['idpais'] . "";
    $result5 = mysqli_query($conexion, $sql5);
    $pais = mysqli_fetch_array($result5);
    $json[] = array(
        'idloc' => $fila['idloc'],
        'localidad' => $fila['localidad'],
        'idep' => $fila['idep'],
        'departamento' => $departamento[0],
        'idpro' => $fila['idpro'],
        'provincia' => $provincia[0],
        'idpais' => $fila['idpais'],
        'pais' => $pais[0]
    );
}
$jsonstring = json_encode($json);
echo $jsonstring;
mysqli_close($conexion);
?>
    