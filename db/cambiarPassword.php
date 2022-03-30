<?php
session_start();
require('./conexionDb.php');

$passwordHash = "";
$data = "";
$idloc = "";
$idLogUser = "";

if(isset($_POST['user']) && isset($_POST['password'])){
  $idUser = $_POST['user'];
  $newPassword = $_POST['password'];
   //Encripto la pass
  $passwordHash = password_hash($newPassword, PASSWORD_BCRYPT);

  // recupero el IDLOC del usuario
  // $consulta = "SELECT idlog FROM login WHERE idlog IN (SELECT idloc FROM usuario WHERE iduser = $idUser)";
  $consulta = "SELECT idloc FROM `usuario` WHERE iduser = ".$idUser;
  $respuesta = mysqli_query($conexion, $consulta);
  if(!empty($respuesta) && mysqli_num_rows($respuesta) != 0){
    $row = mysqli_fetch_assoc($respuesta);
    $idLoc = $row['idloc'];

    $consulta2 = "SELECT idlog FROM `login` WHERE idlog = ".$idLoc;
    $res = mysqli_query($conexion, $consulta2);
    if(!empty($res) && mysqli_num_rows($res) != 0){
      $col = mysqli_fetch_assoc($res);
      $idLogUser = $col['idlog'];
      // Uso el idLogUser para buscar el usuario en tabla LOGIN y cambiar la pass
      $sql = "UPDATE `login` SET login.password='".$passwordHash."' WHERE idlog=".$idLogUser;
      if (mysqli_query($conexion, $sql)) {
        $data = true;
      } else {
        $data = false;
      }
    }else{
      $data = false;
    }
  }else{
    $data = false;
  }
}

print json_encode($data); // returned data as json
mysqli_close($conexion);

?>