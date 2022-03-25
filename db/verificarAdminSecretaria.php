<?php 
session_start();
    $data;
    // // Si no tiene las credenciales no accede
    if(isset($_SESSION['id_user']) && isset($_SESSION['id_rol'])){
        $sql = 'SELECT descripcion from roles where idrol in (SELECT rol from login where idlog ='.$_SESSION['id_user'].')';
        $resultado = mysqli_query($conexion, $sql);
        if (!empty($resultado) && mysqli_num_rows($resultado) != 0){
            $row = mysqli_fetch_assoc($resultado);
        }
        if($row['descripcion']!='Admin' && $row['descripcion']!='Secretaria'){
            header('location: ./logout.php');
        }
        mysqli_close($conexion);
    }else{
        // header('location: ../db/logout.php');
         header('location: ./logout.php');
    }
?>