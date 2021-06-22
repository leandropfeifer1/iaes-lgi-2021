<?php

	$usuario = $_GET["nombre"];
	$correo = 	$_GET["correo"];
	$servername = "localhost";
	$username = "pineyro";
	$password = "1234";
	$db = "ejphp";

	// Create connection
	$conexion = mysqli_connect($servername, $username, $password, $db);

	// Check connection
	if (!$conexion) {
	  die("Conexion fallida: " . mysqli_connect_error());
	}
	
	// Consulta a la DB
	$query_sql = "INSERT INTO ejphp.clientes (email, nombre) VALUES ('".$correo."', '".$usuario."')";
	
	// Check la query
	if (mysqli_query($conexion, $query_sql)) {
	  echo "Se ha ingresado un nuevo registro";
	  echo "<div><a href='index.html'>Volver</a></div>";
	} else {
	  echo "Error: " . $query_sql . "<br>" . mysqli_error($conexion);
	}

	mysqli_close($conexion); 
?>
