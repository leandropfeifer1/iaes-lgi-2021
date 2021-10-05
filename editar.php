<!DOCTYPE html>
<head>
<title>Editar Datos</title>
</head>
<?php 
	$idcol = $_GET["idcol"];
	// Check connection
	require_once("config.php");
	
	$sql = 'SELECT email, nombre FROM clientes WHERE id ="'.$idcol.'"';
	if($resultado = mysqli_query($conexion, $sql)){
		while($fila = mysqli_fetch_assoc($resultado)) {
		$nombre = $fila["nombre"];
		$email = $fila["email"];
		}
	}else {
	  echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
	}
?>
<body>
	<form method="get" action="bd_edit.php">
	<input readonly name="identificador" type="text" value="<?php echo $idcol ?>"><br>
	<label>Email</label>
	<input value="<?php echo $email ?>" type="text" name="mail"><br>
	<label>Nombre</label>
	<input value="<?php echo $nombre ?>" type="text" name="name"><br>
	<input value="Editar" type="submit">
	</form>
	<?php mysqli_close($conexion); ?>
</body>

