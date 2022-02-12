<?php
require('conexionDb.php');
$idempresa=$_POST['idempresa'];
$sql="DELETE FROM `empresas` WHERE `idempresa`='$idempresa'";
$result=mysqli_query($conexion, $sql);
mysqli_close($conexion);