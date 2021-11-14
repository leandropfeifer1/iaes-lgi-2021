<?php
    session_start();
    require('../db/conexionDb.php');
    
    // VERIFICAR SI FUNCA ESTO

    if(isset($_SESSION['id_user']) && isset($_SESSION['id_rol'])){
        $sql = 'SELECT descripcion from roles where idrol.roles = idrol.login';
        $resultado = mysqli_query($conexion, $sql);
        if (!empty($resultado) && mysqli_num_rows($resultado) != 0){
            $row = mysqli_fetch_assoc($resultado);
        }
        if(isset($row['descripcion']) && $row['descripcion']!='secretaria'||$row['descripcion']!='admin'){
            header('location: ../db/logout.php');
        }
        mysqli_close($conexion);
    }else{
        header('location: ../db/logout.php');
    }

    // MODIFICAR LA CONSULTA A LOS NOMBRES QUE USA LA BASE DE DATOS

    $carrera=""; $localidad=""; $licencia=""; $vehiculo=""; $edad=""; 
    $modalidad=""; $genero=""; $disponible="";$buscador="";
    $consulta = "SELECT * FROM usuarios WHERE iduser!=0";

    if(isset($_POST['carrera']) && $_POST['carrera'] != 0){
        $consulta .= "AND carrera=".$_POST['carrera'];
    }
    if(isset($_POST['localidad'])&& $_POST['localidad'] != 0){
        $consulta .= "AND localidad=".$_POST['localidad'];
    }
    if(isset($_POST['licencia'])&& $_POST['licencia'] != 0){
        $consulta .= "AND licencia=".$_POST['licencia'];
    }
    if(isset($_POST['vehiculo'])&& $_POST['vehiculo'] != 0){
        $consulta .= "AND vehiculo=".$_POST['vehiculo'];
    }
    if(isset($_POST['edad'])&& $_POST['edad'] != 0){
        $consulta .= "AND edad=".$_POST['edad'];
    }
    if(isset($_POST['modalidad'])&& $_POST['modalidad'] != 0){
        $consulta .= "AND modalidad=".$_POST['modalidad'];
    }
    if(isset($_POST['genero'])&& $_POST['genero'] != 0){
        $consulta .= "AND genero=".$_POST['genero'];
    }
    if(isset($_POST['disponible'])&& $_POST['disponible'] != 0){
        $consulta .= "AND disponible=".$_POST['disponible'];
    }
    if(isset($_POST['buscador'])&& $_POST['buscador'] != 0){
        $consulta .= "AND buscador=".$_POST['buscador'];
    }
?>