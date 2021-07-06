<?php
	//Config para enviar con require_once la conexion a la DB
	$servername = "localhost";
	$username = "pineyro";
	$password = "1234";
	$db = "ejphp";
		
	$conexion = mysqli_connect($servername, $username, $password, $db);
	if (!$conexion) {
		die("Conexion fallida: " . mysqli_connect_error());
	}
?>
