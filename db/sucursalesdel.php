<?php
require('conexionDb.php');
$idsucursal=$_POST['idsucursal'];
$sql="DELETE FROM `sucursales` WHERE `idsucursal`='$idsucursal'";
$result=mysqli_query($conexion, $sql);
mysqli_close($conexion);