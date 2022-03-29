<?php
session_start();
require('conexionDb.php');
mysqli_set_charset($conexion, "utf8");
//$empresa = $_POST['empresa'];
$idloc = $_POST['idloc'];
$localidade = $_POST['localidade'];
$sql="UPDATE `localidad` SET `localidad`='$localidade' WHERE `idloc`= '$idloc'";
echo  mysqli_query($conexion, $sql);
mysqli_close($conexion);