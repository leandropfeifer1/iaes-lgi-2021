<?php

	$usuario = $_GET["nombre"];
	$correo = 	$_GET["correo"];
	require_once("config.php");
	
	// Consulta a la DB
	$query_sql = "INSERT INTO ejphp.clientes (email, nombre) VALUES ('".$correo."', '".$usuario."')";
	// Check la query
	if (mysqli_query($conexion, $query_sql)) {
	  echo "Se ha ingresado un nuevo registro";
	  echo "<div><a href='index2.html'>Volver</a></div>";
	} else {
	  echo "Error: " . $query_sql . "<br>" . mysqli_error($conexion);
	}

	mysqli_close($conexion); 
?>
