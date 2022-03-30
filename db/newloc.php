<?php
require('conexionDb.php');
mysqli_set_charset($conexion, "utf8");
$localidad=$_POST['localidada'];
$idep =$_POST['departamentoa'];
$provincia=$_POST['provincia'];
$idpais=$_POST['pais'];
$sql= "INSERT INTO `localidad`(`localidad`, `idep`, `idpro`, `idpais`) VALUES ('$localidad','$idep','$provincia','$idpais')";
echo mysqli_query($conexion, $sql);
mysqli_close($conexion);
?>