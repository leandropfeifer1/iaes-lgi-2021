<?php
require('conexionDb.php');
$idempresa=$_POST['idempresa'];
$sql1="DELETE FROM `sucursales` WHERE `empresa`='$idempresa'";
$lista=mysqli_query($conexion, $sql1);
$sql="DELETE FROM `empresas` WHERE `idempresa`='$idempresa'";
$result=mysqli_query($conexion, $sql);
mysqli_close($conexion);