<?php
require('conexionDb.php');
mysqli_set_charset($conexion, "utf8");
$provincia=$_POST['pro'];
$idpais=$_POST['pais'];
$sql= "INSERT INTO `provincia`(`provincia`, `idpais`) VALUES ('$provincia','$idpais')";
echo mysqli_query($conexion, $sql);
mysqli_close($conexion);
?>