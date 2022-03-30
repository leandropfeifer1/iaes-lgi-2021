<?php
session_start();
require('conexionDb.php');
mysqli_set_charset($conexion, "utf8");
//$empresa = $_POST['empresa'];
$idep = $_POST['idep'];
$departamentoe = $_POST['departamentoe'];
$sql="UPDATE `departamento` SET `departamento`='$departamentoe' WHERE `idep`= '$idep'";
echo  mysqli_query($conexion, $sql);
mysqli_close($conexion);