<?php
require('./conexionDb.php');
$empresa=$_POST['empresa'];
$cuit=$_POST['cuit'];
$presidente=$_POST['presidente'];
$correo=$_POST['correo'];
$telefono=$_POST['telefono'];


$sql= "INSERT INTO `empresas`(`empresa`, `cuit`, `presidente`, `correo`, `telefono`) VALUES ('".$empresa."','".$cuit."','".$presidente."','".$correo."','".$telefono."');";
if (mysqli_query($conexion, $sql)) {
        $data = array('empresa'=>$empresa);
    }else{
        $data = false;
    }
print json_encode($data);
mysqli_close($conexion);
?>