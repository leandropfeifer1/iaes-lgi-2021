<?php
require('conexionDb.php');
$idsucursal=$_POST['idsucursal'];
$direccion=$_POST['direccion'];
$localidad=$_POST['localidad'];
$departamento=$_POST['departamento'];
$provincia=$_POST['provincia'];
$pais=$_POST['pais'];
$telefono=$_POST['telefono'];
$gerente=$_POST['gerente'];
$central=$_POST['central'];

$sql="UPDATE `sucursales` SET `direccion`=[$direccion],`localidad`=[$localidad],`departamento`=[$departamento],`provincia`=[$provincia],`pais`=[$pais],`telefono`=[$telefono],`gerente`=[$gerente],`central`=[$central] WHERE idsucursal=".$idsucursal;
echo mysqli_query($conexion, $sql);
mysqli_close($conexion);