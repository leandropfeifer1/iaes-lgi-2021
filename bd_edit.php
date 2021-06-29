<?php
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

	// Consulta Editar Datos
	
	$identificador = $_GET["identificador"];
	$name = $_GET["name"];
	$mail =$_GET["mail"];
	
	$consulta = "INSERT INTO ejphp.clientes (email, nombre) VALUES ('".$mail."', '".$name."')";
	if (mysqli_query($conexion, $consulta)) {
	  echo "Se ha Editado el registro";
	  echo "<div><a href='datos.php'>Volver</a></div>";
	} else {
	  echo "Error: " . $query_sql . "<br>" . mysqli_error($conexion);
	}

	mysqli_close($conexion); 

?>
