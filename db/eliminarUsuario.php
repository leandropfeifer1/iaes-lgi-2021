<?php

require('conexionDb.php');
$iduser = $_POST['iduser'];

$idloc = mysqli_query($conexion, "SELECT idloc FROM usuario WHERE usuario.iduser='$iduser'");
if (!$idloc) {
    die('Query failed!' . mysqli_error($conexion));
}
$idloc = mysqli_fetch_row($idloc);

$fotobd = mysqli_query($conexion, "SELECT foto FROM usuario WHERE idloc='$idloc[0]'");
$row = mysqli_fetch_array($fotobd);
if (!$row) {
    die('Query failed!' . mysqli_error($conexion));
}
if ($row[0] != '') {
    //echo "entroo";
    if (unlink('../db/images/' . $row[0])) {
        // echo "se borro la foto guardada";
    }
}
//Elimina la pdf anterior
$pdfbd = mysqli_query($conexion, "SELECT pdf FROM usuario WHERE idloc='$idloc[0]'");
$row = mysqli_fetch_array($pdfbd);
if ($row[0] != '') {
   // echo "entroo";
    if (unlink('../db/cv/' . $row[0])) {
         //echo "se borro la pdf guardada";
    }
}

$query = "DELETE FROM usuario WHERE idloc='$idloc[0]'";
$result = mysqli_query($conexion, $query);
if (!$result) {
    die('Query failed!' . mysqli_error($conexion));
}

$query = "DELETE FROM idioxuser WHERE iduser='$idloc[0]'";
$result = mysqli_query($conexion, $query);
if (!$result) {
    die('Query failed!' . mysqli_error($conexion));
}

$query = "DELETE FROM experiencia WHERE iduser='$idloc[0]'";
$result = mysqli_query($conexion, $query);
if (!$result) {
    die('Query failed!' . mysqli_error($conexion));
}

$query = "DELETE FROM carxuser WHERE iduser='$idloc[0]'";
$result = mysqli_query($conexion, $query);
if (!$result) {
    die('Query failed!' . mysqli_error($conexion));
}

$query = "DELETE FROM `login` WHERE idlog='$idloc[0]'";
$result = mysqli_query($conexion, $query);
if (!$result) {
    die('Query failed!' . mysqli_error($conexion));
}

//print json_encode($iduser);
mysqli_close($conexion);
