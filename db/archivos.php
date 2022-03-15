<?php
session_start();
require('./conexionDb.php');
$idloc = $_SESSION['id_user'];

if (isset($_FILES['foto']['name'])) {
    $fotobd = mysqli_query($conexion, "SELECT foto FROM usuario WHERE idloc='$idloc'");
    $row = mysqli_fetch_array($fotobd);
    if ($row[0]) {
        if (unlink('../db/images/' . $row[0])) {
            echo "se borro la foto guardada";
        }
    }
    $foto = $_FILES['foto']['name'];
    $temp = $_FILES['foto']['tmp_name'];
    if (move_uploaded_file($temp, "../db/images/" . $foto)) {
        echo "se subio la imagen";
    }
    guardarFoto($idloc, $foto);
} else {
    $fotobd = mysqli_query($conexion, "SELECT foto FROM usuario WHERE idloc='$idloc'");
    $row = mysqli_fetch_array($fotobd);
    if ($row[0]) {
        $foto = $row[0];
    } else {
        $foto = NULL;
    }
    $res = guardarFoto($idloc, $foto);
}

function guardarFoto($idloc, $foto)
{
    $error = false;
    require('./conexionDb.php');
    $query = mysqli_query($conexion, "SELECT * FROM usuario WHERE idloc='$idloc'");
    if (mysqli_num_rows($query) == 0) {
        $result = mysqli_query($conexion, "INSERT INTO `usuario`(`foto`) VALUES ('$foto')");
        if ($result) {
            $error = false;
        } else {
            $error = true;
        }
    } else {
        $result = mysqli_query($conexion, "UPDATE `usuario` SET `foto`='$foto' WHERE idloc = $idloc");
        if ($result) {
        } else {
            $error = true;
        }
    }
    return $error;
}

if (isset($_FILES['pdf']['name'])) {
    $prueba = "entro";
    $pdfbd = mysqli_query($conexion, "SELECT pdf FROM usuario WHERE idloc='$idloc'");
    $row = mysqli_fetch_array($pdfbd);
    if ($row[0]) {
        if (unlink('../db/cv/' . $row[0])) {
            echo "se borro la pdf guardada";
        }
    }
    $pdf = $_FILES['pdf']['name'];
    $temp = $_FILES['pdf']['tmp_name'];
    if (move_uploaded_file($temp, "../db/cv/" . $pdf)) {
        echo "se subio el pdf";
    }
    guardarPdf($idloc, $pdf);
} else {
    $prueba = "else";
    $pdfbd = mysqli_query($conexion, "SELECT pdf FROM usuario WHERE idloc='$idloc'");
    $row = mysqli_fetch_array($pdfbd);
    if ($row[0]) {
        $pdf = $row[0];
    } else {
        $pdf = NULL;
    }
    $res = guardarPdf($idloc, $pdf);
}

function guardarPdf($idloc, $pdf)
{
    require('./conexionDb.php');
    $error = false;
    $query = mysqli_query($conexion, "SELECT * FROM usuario WHERE idloc='$idloc'");
    if (mysqli_num_rows($query) == 0) {
        $result = mysqli_query($conexion, "INSERT INTO `usuario`(`pdf`) VALUES ('$pdf')");
        if ($result) {
            $error = false;
        } else {
            $error = true;
        }
    } else {
        $result = mysqli_query($conexion, "UPDATE `usuario` SET `pdf`='$pdf' WHERE idloc = $idloc");
        if ($result) {
        } else {
            $error = true;
        }
    }
    return $error;
}

print json_encode($res); // returned data as json
mysqli_close($conexion);
