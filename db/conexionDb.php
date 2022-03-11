<?php
$servername = "localhost";
$username = "lgi21@iaes.edu.ar";
$password = "lwBx0c4dPEpKsgA";
$db = "iaes_lgi21";

$conexion = mysqli_connect($servername, $username, $password, $db);

if (!$conexion) {
  die("conexion fallida, error: " . mysqli_connect_error());
}
?>
