<?php
require('conexionDb.php');
$idempresa = $_POST['idempresa'];
$sql1 = "DELETE FROM `sucursales` WHERE `empresa`='$idempresa'";
$lista = mysqli_query($conexion, $sql1);
$sql = "DELETE FROM `empresas` WHERE `idempresa`='$idempresa'";

$fotobd = mysqli_query($conexion, "SELECT logo FROM empresas WHERE idempresa='$idempresa'");
$row = mysqli_fetch_array($fotobd);
if ($row[0]) {
    if (unlink('../db/images/' . $row[0])) {
        echo "se borro el logo";
    }
}


$result = mysqli_query($conexion, $sql);
mysqli_close($conexion);
?>