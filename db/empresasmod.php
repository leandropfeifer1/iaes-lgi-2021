<?php
require('conexionDb.php');
mysqli_set_charset($conexion, "utf8");
$idempresa = $_POST['idempresa'];
$empresa = $_POST['empresa'];
$cuit = $_POST['cuit'];
$presidente = $_POST['presidente'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$logo = $_POST['logo'];
if ($logo != "undefined" && $logo != 0) {   
    $logobd = mysqli_query($conexion, "SELECT logo FROM empresas WHERE idempresa='$idempresa'");
    $row = mysqli_fetch_array($logobd);
    //echo $row[0];
    if ($row[0]) {
        if (unlink("../db/images/" . $row[0])) {    
            //echo "se borro con exito";     
        }else{
        }
    }
    $sql = "UPDATE `empresas` SET `empresa`='$empresa',`cuit`='$cuit',`presidente`='$presidente',`correo`='$correo',`telefono`='$telefono',`logo`='$logo' WHERE `idempresa`='$idempresa'";
} else {
    $sql = "UPDATE `empresas` SET `empresa`='$empresa',`cuit`='$cuit',`presidente`='$presidente',`correo`='$correo',`telefono`='$telefono' WHERE `idempresa`='$idempresa'";
}

echo mysqli_query($conexion, $sql);
mysqli_close($conexion);
?>
