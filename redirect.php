<?php 
session_start();
require('./db/conexionDb.php');

if(isset($_SESSION['id_user']) && isset($_SESSION['id_rol'])){
    $sql = 'SELECT idrol from roles where idrol in(SELECT rol from login where
     idlog ='.$_SESSION['id_user'].')';
    $resultado = mysqli_query($conexion, $sql);
    if (!empty($resultado) && mysqli_num_rows($resultado) != 0){
        $row = mysqli_fetch_assoc($resultado);
    }
    
    // Compruebo de que exista
    if(isset($row['idrol'])){
        if($row['idrol'] == 1){
            // header('location: /bolsa-empleo-php/iaes-lgi-2021/vistas/filtro.php');
            header('location: /vistas/filtro.php');
        } else if($row['idrol'] == 2){
            // header('location: /bolsa-empleo-php/iaes-lgi-2021/vistas/dashboardSecretaria.php');
            header('location: /vistas/dashboardSecretaria.php');
        } else if($row['idrol'] == 3){
            // header('location: /bolsa-empleo-php/iaes-lgi-2021/vistas/dashboardUser.php');
            header('location: /vistas/dashboardUser.php');
        }
    }
    mysqli_close($conexion);

}else{
    // header('location: /bolsa-empleo-php/iaes-lgi-2021/index.php');
    header('location: /index.php');
}









?>