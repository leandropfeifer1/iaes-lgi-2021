<?php
session_start();
require('./conexionDb.php');

$idUser = (isset($_POST['user']))? $_POST['user']: '';
$newPassword = (isset($_POST['password']))? $_POST['password']: '';

$sql = 'UPDATE login SET password="'.$newPassword.'" WHERE iduser='.$idUser;
$resultado = mysqli_query($conexion, $sql);
$verificar = false;














?>