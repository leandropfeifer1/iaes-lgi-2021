<?php
require('conexionDb.php');
mysqli_set_charset($conexion, "utf8");
$empresa = $_POST['empresa'];
$cuit = $_POST['cuit'];
$presidente = $_POST['presidente'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$logo = $_POST['logo'];
if($logo){
    $logo = "../db/images/".$logo;
    $sql = "INSERT INTO `empresas`(`empresa`, `cuit`, `presidente`, `correo`, `telefono`, `logo`) VALUES ('$empresa','$cuit','$presidente','$correo','$telefono','$logo')";
} else{
    $sql = "INSERT INTO `empresas`(`empresa`, `cuit`, `presidente`, `correo`, `telefono`) VALUES ('$empresa','$cuit','$presidente','$correo','$telefono')";
}




echo mysqli_query($conexion, $sql);

mysqli_close($conexion);
?>