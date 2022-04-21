<?php
    include 'conexionDb.php';
    $data;
    $query = "SELECT iduser, usuario, apellido, area, genero, situacionlab, modalidad, foto, TIMESTAMPDIFF(YEAR,fechanacimiento,CURDATE()) as 'edad' FROM usuario";

    $res =  mysqli_query($conexion, $query);
    if(!empty($res) && mysqli_num_rows($res) != 0) {  
        while($fila = mysqli_fetch_assoc($res)) {  
            $data["data"][] = $fila;
        } 
       header('Content-Type: application/json; charset=utf-8');
       print_r(json_encode($data));
    }else{
        echo $data["data"][] = "undefined";
    }
    mysqli_close($conexion);
?>
