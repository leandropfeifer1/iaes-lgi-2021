<?php
    session_start();
    require('./db/conexionDb.php');
    $consulta = "SELECT iduser, usuario FROM usuario WHERE iduser!=0
        and cursos LIKE '%No%'";

    $res =  mysqli_query($conexion, $consulta);
    if(!empty($res) && mysqli_num_rows($res) != 0) {  
        while($fila = mysqli_fetch_assoc($res)) {  
            // $data["data"][] = $fila;
            $data[] = $fila;

        } 
       print_r(json_encode($data));
    }else{
        echo "error";
    }

?>