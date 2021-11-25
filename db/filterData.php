<?php
    session_start();
    require('../db/conexionDb.php');
    $data;
    // // Si no tiene las credenciales no accede
    // if(isset($_SESSION['id_user']) && isset($_SESSION['id_rol'])){
    //     $sql = 'SELECT descripcion from roles where idrol in (SELECT rol from login where idlog ='.$_SESSION['id_user'].')';
    //     $resultado = mysqli_query($conexion, $sql);
    //     if (!empty($resultado) && mysqli_num_rows($resultado) != 0){
    //         $row = mysqli_fetch_assoc($resultado);
    //     }
    //     if(isset($row['descripcion']) && $row['descripcion']!='admin' || $row['descripcion']!='secretaria'){
    //         header('location: ../db/logout.php');
    //     }
    //     mysqli_close($conexion);
    // }else{
    //     header('location: ../db/logout.php');
    // }

if(isset($_SESSION['id_user'])){
    $consulta = "SELECT iduser, usuario, apellido, genero, situacionlab, cursos FROM usuario WHERE iduser!=0";

    if(isset($_POST['carrera']) && $_POST['carrera'] != 0){
        $consulta .= " AND iduser in(select  iduser from carxuser 
                where idcar in (SELECT idcar from carrera 
                where idcar = ".$_POST['carrera']."))";
    }
    if(isset($_POST['localidad'])&& $_POST['localidad'] != 0){
        $consulta .= " AND localidad=".$_POST['localidad'];
    }
    if(isset($_POST['licencia'])&& $_POST['licencia'] != 0){
        $consulta .= " AND licencia=".$_POST['licencia'];
    }
    if(isset($_POST['vehiculo'])&& $_POST['vehiculo'] != 0){
        $consulta .= " AND auto=".$_POST['vehiculo'];
    }
    if(isset($_POST['edad'])&& $_POST['edad'] != 0){
        $consulta .= " AND edad=".$_POST['edad'];
    }
    if(isset($_POST['modalidad'])&& $_POST['modalidad'] != 0){
        $consulta .= " AND modalidad=".$_POST['modalidad'];
    }
    if(isset($_POST['buscador']) && $_POST['buscador'] != ""){
        $busc = $_POST['buscador'];
        $consulta .= '  AND (cursos LIKE "%'.$busc.'%"';
        $consulta .= ' OR area LIKE "%'.$busc.'%")';
    }
    if(isset($_POST['genero'])&& $_POST['genero'] != 0){
        $consulta .= " AND genero='".$_POST['genero']."'";
    }
    if(isset($_POST['disponible'])&& $_POST['disponible'] != 0){
        $consulta .= " AND (situacionlab=".$_POST['disponible'].")";
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
