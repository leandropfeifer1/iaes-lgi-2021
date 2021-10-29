<?php 
session_start();
require('./db/conexionDb.php');

if(isset($_SESSION['id_user']) && isset($_SESSION['id_rol'])){
    $sql = 'SELECT idrol from roles where idrol in(SELECT rol from usuarios where
     iduser ='.$_SESSION['id_user'].')';
    $resultado = mysqli_query($conexion, $sql);
    if (!empty($resultado) && mysqli_num_rows($resultado) != 0){
        $row = mysqli_fetch_assoc($resultado);
    }
    
    // Compruebo de que exista
    if(isset($row['idrol'])){
        if($row['idrol'] == $_SESSION['id_rol']){
            header('location: /bolsa-empleo-php/iaes-lgi-2021/vistas/dashboardAdmin.php');
        } else if($row['idrol'] == $_SESSION['id_rol']){
            header('location: /bolsa-empleo-php/iaes-lgi-2021/vistas/dashboardSecretaria.php');
        } else if($row['idrol'] == $_SESSION['id_rol']){
            header('location: /bolsa-empleo-php/iaes-lgi-2021/vistas/dashboardUser.php');
        }
    }
    mysqli_close($conexion);

}else{
    header('location: /bolsa-empleo-php/iaes-lgi-2021/index.php');
}









?>