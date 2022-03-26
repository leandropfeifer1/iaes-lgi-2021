<?php 
session_start();
$empresa=$_POST['valor'];
$_SESSION['consulta']=$empresa;
echo $empresa;
?>