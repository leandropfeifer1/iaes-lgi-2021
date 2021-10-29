<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "bolsa_empleo";

$conexion = mysqli_connect($servername, $username, $password, $db);

if (!$conexion) {
  die("conexion fallida, error: " . mysqli_connect_error());
}
?>