<?php
session_start();
require('./conexionDb.php');
mysqli_set_charset($conexion, "utf8");
// require('./db/verificarAdminSecretaria.php');
$data;
if(isset($_SESSION['id_user'])){
    $consulta = "SELECT `idbusqueda`, `idsucursal`, `edadmin`, `edadmax`, `carrera`, `genero`, `localidad`, `disponibilidad` FROM `buscaempleado` WHERE `idbusqueda` != 0";
    if(isset($_POST['empresa'])&& $_POST['empresa'] != 0){
        $consulta .= " AND empresa=".$_POST['empresa'];
    }

    if(isset($_POST['localidad'])&& $_POST['localidad'] != 0){
        $consulta .= " AND localidad=".$_POST['localidad'];
    }
    if(isset($_POST['vehiculo'])&& $_POST['vehiculo'] != 0){
        $consulta .= " AND auto=".$_POST['vehiculo'];
    }
    if(isset($_POST['edadMin']) && $_POST['edadMin'] != 0 && isset($_POST['edadMax']) && $_POST['edadMax'] != 0){
        $consulta .= " AND (TIMESTAMPDIFF(YEAR,fechanacimiento,CURDATE()) BETWEEN ".$_POST['edadMin']." AND ".$_POST['edadMax'].")";
    }
    if(isset($_POST['modalidad'])&& $_POST['modalidad'] != 0){
        $consulta .= " AND modalidad in(select idmodalidad from modalidades where idmodalidad =".$_POST['modalidad'].")";
    }
    if(isset($_POST['buscador']) && $_POST['buscador'] != ""){
        $busc = $_POST['buscador'];
        $consulta .= '  AND (habilidades LIKE "%'.$busc.'%"';
        $consulta .= ' OR area LIKE "%'.$busc.'%")';
    }
    if(isset($_POST['genero'])&& $_POST['genero'] != 0){
        // $consulta .= " AND genero=".$_POST['genero'];
        $consulta .= " AND genero in (select idgenero from genero where idgenero =".$_POST['genero'].")";
        
    }
    if(isset($_POST['disponible'])&& $_POST['disponible'] != 0){
        $consulta .= " AND (situacionlab=".$_POST['disponible'].")";
    }
        if(isset($_POST['carrera']) && $_POST['carrera'] != 0){
        $consulta .= " AND empresa in (SELECT carerra from carrera 
                where idcar = ".$_POST['carrera']."))";
    }
    // $consulta .= " ORDER BY iduser DESC";

    $res =  mysqli_query($conexion, $consulta);
    if(!empty($res) && mysqli_num_rows($res) != 0) {  
        while($fila = mysqli_fetch_assoc($res)) {  
            $data["data"][] = $fila;
        } 
       header('Content-Type: application/json; charset=utf-8');
       print_r(json_encode($data));
    }else{
        echo $data["data"][] = "undefined";
    }
} 
mysqli_close($conexion);


