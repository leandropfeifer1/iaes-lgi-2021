<?php
	// conexion db
	require_once("config.php");
	
	// Consulta Editar Datos
	$identificador = $_GET["identificador"];
	$name = $_GET["name"];
	$mail =$_GET["mail"];
	
	$consulta = 'UPDATE ejphp.clientes SET email = "'.$mail.'", nombre = "'.$name.'" WHERE id ='.$identificador;
	if (mysqli_query($conexion, $consulta)) {
	  echo "Se ha Editado el registro";
	  echo "<div><a href='datos.php'>Volver</a></div>";
	} else {
	  echo "Error: " . $consulta . "<br>" . mysqli_error($conexion);
	}

	mysqli_close($conexion); 
?>
