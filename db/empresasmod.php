<?php
require('conexionDb.php');
mysqli_set_charset($conexion, "utf8");
$idempresa=$_POST['idempresa'];
$empresa=$_POST['empresa'];
$cuit=$_POST['cuit'];
$presidente=$_POST['presidente'];
$correo=$_POST['correo'];
$telefono=$_POST['telefono'];

$sql="UPDATE `empresas` SET `empresa`='$empresa',`cuit`='$cuit',`presidente`='$presidente',`correo`='$correo',`telefono`='$telefono' WHERE `idempresa`='$idempresa'";

echo mysqli_query($conexion, $sql);
mysqli_close($conexion);