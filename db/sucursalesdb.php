<?php
require('./conexionDb.php');
$empresa=$_POST['empresa'];
$direccion=$_POST['direccion'];
$telefono=$_POST['telefono'];
$gerente=$_POST['gerente'];
$localidad=$_POST['localidad'];
$departamento=$_POST['departamento'];
$provincia=$_POST['provincia'];
$pais=$_POST['pais'];
$central=$_POST['central'];
$buscando=$_POST['buscando'];
        
$sql ="INSERT INTO `sucursales`(`idempresa`, `direccion`, `idloc`, `departamento`, `provincia`, `idpais`, `telefono`, `gerente`, `central`, `busca`) VALUES('".$empresa."','".$direccion."','".$telefono."','".$localidad."','".$departamento."','".$provincia."','".$pais."','".$telefono."','".$gerente."','".$central."','".$buscando."');";


if (mysqli_query($conexion, $sql)) {
        $data = array('empresa'=>$empresa);
        print $data;
    }else{
        $data = false;
    }
print json_encode($data);
mysqli_close($conexion);
?>