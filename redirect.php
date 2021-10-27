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
            header('location: /login-php/views/dashboardAdmin.php');
        } else if($row['idrol'] == $_SESSION['id_rol']){
            header('location: /login-php/views/dashboardSecretaria.php');
        } else if($row['idrol'] == $_SESSION['id_rol']){
            header('location: /login-php/views/dashboardUser.php');
        }
    }
    mysqli_close($conexion);

}else{
    header('location: /login-php/index.php');
}









?>