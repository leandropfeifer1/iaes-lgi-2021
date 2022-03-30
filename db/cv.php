<?php
session_start();
require('./conexionDb.php');
$idloc = $_SESSION['id_user'];

//----------------------------------------------CV

if (isset($_FILES['pdf']['name'])) {
    $pdfbd = mysqli_query($conexion, "SELECT pdf FROM usuario WHERE idloc='$idloc'");
    $row = mysqli_fetch_array($pdfbd);
    if ($row[0]) {
        if (unlink('../db/cv/' . $row[0])) {
            echo "se borro el pdf guardado";
        }
    }
    $pdf = $_FILES['pdf']['name'];
    $temp = $_FILES['pdf']['tmp_name'];
    if (move_uploaded_file($temp, "../db/cv/" . $pdf)) {
        echo "se subio el pdf";
    }
    $res = guardarPdf($idloc, $pdf);
    echo "wwwwwwwww";
    echo $res . "<--";
} else {
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
    $error = false;
    require('./conexionDb.php');
    $query = mysqli_query($conexion, "SELECT pdf FROM usuario WHERE idloc='$idloc'");
    if (mysqli_num_rows($query) != 0) {
        $result = mysqli_query($conexion, "UPDATE `usuario` SET `pdf`='$pdf' WHERE idloc = $idloc");
        if (!$result) {
            $error = true;
        } 
    }
    mysqli_close($conexion);
    return $error;
}

print json_encode($res); // returned data as json
mysqli_close($conexion);
