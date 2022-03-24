<?php
require('conexionDb.php');
$idbusqueda=$_POST['idbusqueda'];
$sql="DELETE FROM `buscaempleado` WHERE `idbusqueda`='$idbusqueda'";
echo mysqli_query($conexion, $sql);
mysqli_close($conexion);