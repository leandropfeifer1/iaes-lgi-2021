<?php
session_start();
require('conexionDb.php');
mysqli_set_charset($conexion, "utf8");
//$empresa = $_POST['empresa'];
$idsucursal = $_POST['idsucursal'];
$direccion = $_POST['direccion'];
$localidad = $_POST['localidad'];
$departamento = $_POST['departamento'];
$provincia = $_POST['provincia'];
$pais = $_POST['pais'];
$telefono = $_POST['telefono'];
$gerente = $_POST['gerente'];
$central = $_POST['central'];
$r = 0;

$sql = "UPDATE `sucursales` SET `direccion`='$direccion',`localidad`='$localidad',`departamento`='$departamento',`provincia`='$provincia',`pais`='$pais',`telefono`='$telefono',`gerente`='$gerente',`central`='$central' WHERE `idsucursal`='$idsucursal'" ;
$result = mysqli_query($conexion, $sql);
if ($result) {
    $r = 1;
}
print json_encode($r);
mysqli_close($conexion);
?>