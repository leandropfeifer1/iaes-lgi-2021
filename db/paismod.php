<?php
session_start();
require('conexionDb.php');
mysqli_set_charset($conexion, "utf8");
//$empresa = $_POST['empresa'];
$idpais = $_POST['idpais'];
$pais = $_POST['paise'];
$sql="UPDATE `pais` SET `pais`='$pais' WHERE `idpais`= '$idpais'";
echo  mysqli_query($conexion, $sql);
mysqli_close($conexion);