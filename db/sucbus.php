<?php
require('conexionDb.php');
$idsucursal=$_POST['idsucursal'];
$sql="SELECT * FROM `buscaempleado` WHERE idsucursal='$idsucursal'";
$result=mysqli_query($conexion, $sql);
while($row=mysql_fetch_array($result)) {
       $return[] = $row;
   }
   return $return;
mysqli_close($conexion);