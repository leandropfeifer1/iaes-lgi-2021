<?php 

	$servername = "localhost";
	$username = "pineyro";
	$password = "1234";
	$db = "ejphp";
	$id = $_GET["id"];
	
	$conexion = mysqli_connect($servername, $username, $password, $db);
	if (!$conexion) {
	  die("Conexion fallida: " . mysqli_connect_error());
	}
	$sql = 'DELETE FROM ejphp.clientes WHERE id ="'.$id.'"';
	if (mysqli_query($conexion, $sql)) {
	  echo "Se ha Eliminado el registro";
	  echo "<div><a href='datos.php'>Volver</a></div>";
	} else {
	  echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
	}

	mysqli_close($conexion); 




?>
