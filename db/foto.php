<?php
session_start();
require('./conexionDb.php');
$idloc = $_SESSION['id_user'];
//----------------------------------------------EMPRESA
if (isset($_POST['nombre'])) {
    $nombre = $_POST['nombre'];
}
if (isset($_POST['logomod'])) {
    $logomod = $_POST['logomod'];
}
if (isset($_POST['fotoNombre'])) {
    $fotoNombre = $_POST['fotoNombre'];
}

if (isset($_FILES['logo']['name'])) {
    $temp = $_FILES['logo']['tmp_name'];
    if (move_uploaded_file($temp, "../db/images/" . $nombre)) {
        //echo "se subio la imagen";
    }
}
if (isset($_FILES['logomod']['name'])) {
    $temp = $_FILES['logo']['tmp_name'];
    if (move_uploaded_file($temp, "../db/images/" . $logomod)) {
        //echo "se subio la imagen";
    }
}

//----------------------------------------------USUARIO

if (isset($_FILES['foto']['name'])) {

    //Elimina la foto anterior
    $fotobd = mysqli_query($conexion, "SELECT foto FROM usuario WHERE idloc='$idloc'");
    $row = mysqli_fetch_array($fotobd);
    //echo "-----------" . mysqli_num_rows($fotobd);
    if ($row[0] != '') {
        //echo "entroo";
        if (unlink('../db/images/' . $row[0])) {
            // echo "se borro la foto guardada";
        }
    }
    //actualiza el reg
    $result = mysqli_query($conexion, "UPDATE `usuario` SET `foto`='$fotoNombre' WHERE idloc = $idloc");
    if (!$result) {
        $error = true;
        //echo $error;
    }

    //sube la nueva foto        
    $temp = $_FILES['foto']['tmp_name'];
    if (move_uploaded_file($temp, "../db/images/" . $fotoNombre)) {
        //echo "se subio la imagen";
    }
    print json_encode($fotoNombre); // returned data as json
}


mysqli_close($conexion);
