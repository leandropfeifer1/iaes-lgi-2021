<?php
require('conexionDb.php');
mysqli_set_charset($conexion, "utf8");
$empresa=$_POST['empresa'];
$direccion=$_POST['direccion'];
$telefono=$_POST['telefono'];
$gerente=$_POST['gerente'];
$localidad=$_POST['localidad'];
$departamento=$_POST['departamento'];
$provincia=$_POST['provincia'];
$pais=$_POST['pais'];
$central=$_POST['central'];
        
$sql ="INSERT INTO `sucursales`(`empresa`, `direccion`, `localidad`, `departamento`, `provincia`, `pais`, `telefono`, `gerente`, `central`) VALUES('$empresa','$direccion','$localidad','$departamento','$provincia','$pais','$telefono','$gerente','$central')";
echo mysqli_query($conexion, $sql);


mysqli_close($conexion);
?>