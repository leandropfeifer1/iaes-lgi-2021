<?php
session_start();
require('./conexionDb.php');

$idUser = $_POST['user'];
$newPassword = $_POST['password'];
$passwordHash = "";
$data = "";
$idLogUser= "";

// recupero el IDLOC del usuario
$query = "SELECT idloc from usuario where iduser=".$idUser.";";
$resultado = mysqli_query($conexion, $query);
//  && mysqli_num_rows($resultado) != 0
if(!empty($resultado)){
   $row = mysqli_fetch_assoc($resultado);
   $idLogUser = $row['idloc'];
   //Encripto la pass
  $passwordHash = password_hash($newPassword, PASSWORD_BCRYPT);

  // Uso el IDLOC para buscar el usuario en tabla LOGIN y cambiar la pass
  $sql = 'UPDATE login SET password="'.$passwordHash.'" WHERE idlog='.$idLogUser.";";
  if (mysqli_query($conexion, $sql)) {
    $data = true;
  } else {
    $data = false;
  }
}
print json_encode($data); // returned data as json
mysqli_close($conexion);

?>