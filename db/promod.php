<?php
session_start();
require('conexionDb.php');
mysqli_set_charset($conexion, "utf8");
//$empresa = $_POST['empresa'];
$idpro = $_POST['idpro'];
$provinciae = $_POST['provinciae'];
$sql="UPDATE `provincia` SET `provincia`='$provinciae' WHERE `idpro`= '$idpro'";
echo  mysqli_query($conexion, $sql);
mysqli_close($conexion);