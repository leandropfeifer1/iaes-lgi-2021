<?php
    include 'conexionDb.php';
    $data;
    $consulta = "SELECT `idbusqueda`, `idsucursal`, `edadmin`, `edadmax`, `carrera`, `genero`, `requisitos`, `disponibilidad` FROM `buscaempleado` WHERE `idbusqueda` != 0";
    
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


