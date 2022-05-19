<?php
session_start();
require('./conexionDb.php');
$idloc = $_SESSION['id_user'];

//----------------------------------------------CV

if (isset($_POST['pdfNombre'])) {
    $pdfNombre = $_POST['pdfNombre'];
   // echo $pdfNombre . "------";
}

if (isset($_FILES['pdf']['name'])) {

    //Elimina la pdf anterior
    $pdfbd = mysqli_query($conexion, "SELECT pdf FROM usuario WHERE idloc='$idloc'");
    $row = mysqli_fetch_array($pdfbd);
    if ($row[0] != '') {
       // echo "entroo";
        if (unlink('../db/cv/' . $row[0])) {
             //echo "se borro la pdf guardada";
        }
    }
    //actualiza el reg
    $result = mysqli_query($conexion, "UPDATE `usuario` SET `pdf`='$pdfNombre' WHERE idloc = $idloc");
    if (!$result) {
        $error = true;
       // echo $error;
    }

    //sube la nueva pdf        
    $temp = $_FILES['pdf']['tmp_name'];
    if (move_uploaded_file($temp, "../db/cv/" . $pdfNombre)) {
       // echo "se subio la pdf";
    } else {
        //echo "no se subiooo0";
    }
    print json_encode($pdfNombre); // returned data as json
}

mysqli_close($conexion);
?>