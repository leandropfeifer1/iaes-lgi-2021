<?php
session_start();
require('./conexionDb.php');
$idloc = $_SESSION['id_user'];

//----------------------------------------------EMPRESA
if (isset($_FILES['logo']['name'])) {    
    $logo = $_FILES['logo']['name'];
    $temp = $_FILES['logo']['tmp_name'];
    if (move_uploaded_file($temp, "../db/images/" . $logo)) {
        //echo "se subio la imagen";
    }
} 

//----------------------------------------------USUARIO
if (isset($_FILES['foto']['name'])) {
    $fotobd = mysqli_query($conexion, "SELECT foto FROM usuario WHERE idloc='$idloc'");
    $row = mysqli_fetch_array($fotobd);
    if ($row[0]) {
        if (unlink('../db/images/' . $row[0])) {
            //echo "se borro la foto guardada";
        }
    }
    $foto = $_FILES['foto']['name'];
    $temp = $_FILES['foto']['tmp_name'];
    if (move_uploaded_file($temp, "../db/images/" . $foto)) {
        //echo "se subio la imagen";
    }
    $guardar = guardarFoto($idloc, $foto);
    $res = $foto;
} else {
    $fotobd = mysqli_query($conexion, "SELECT foto FROM usuario WHERE idloc='$idloc'");
    $row = mysqli_fetch_array($fotobd);
    if ($row[0]) {
        $foto = $row[0];
    } 
    $guardar = guardarFoto($idloc, $foto);
    $res = $foto;


}

function guardarFoto($idloc, $foto)
{
    $error = false;
    require('./conexionDb.php');
    $query = mysqli_query($conexion, "SELECT foto FROM usuario WHERE idloc='$idloc'");
    if (mysqli_num_rows($query) != 0) {
        $result = mysqli_query($conexion, "UPDATE `usuario` SET `foto`='$foto' WHERE idloc = $idloc");
        if (!$result) {
            $error = true;
        } 
    }
    mysqli_close($conexion);
    return $error;
}

print json_encode($foto); // returned data as json
mysqli_close($conexion);
?>