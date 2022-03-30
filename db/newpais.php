<?php
require('conexionDb.php');
mysqli_set_charset($conexion, "utf8");
$pais=$_POST['pai'];
$sql= "INSERT INTO `pais`(`pais`) VALUES ('$pais')";
echo mysqli_query($conexion, $sql);
mysqli_close($conexion);
?>
