<?php 
	require_once("config.php");	
	$id = $_GET["id"];
	
	$sql = 'DELETE FROM ejphp.clientes WHERE id ="'.$id.'"';
	if (mysqli_query($conexion, $sql)) {
	  echo "Se ha Eliminado el registro";
	  echo "<div><a href='datos.php'>Volver</a></div>";
	} else {
	  echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
	}

	mysqli_close($conexion); 

?>
