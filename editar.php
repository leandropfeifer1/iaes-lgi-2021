<!DOCTYPE html>
<head>
<title>Editar Datos</title>
</head>
<?php 
	$servername = "localhost";
	$username = "pineyro";
	$password = "1234";
	$db = "ejphp";
	$idcol = $_GET["idcol"];
	$conex = mysqli_connect($servername, $username, $password, $db);
	// Check connection
	if(!$conex) {
	  die("Conexion fallida: " . mysqli_connect_error());
	}
	$sql = 'SELECT email, nombre FROM clientes WHERE id ="'.$idcol.'"';
	if($resultado = mysqli_query($conex, $sql)){
		while($fila = mysqli_fetch_assoc($resultado)) {
		$nombre = $fila["nombre"];
		$email = $fila["email"];
		}
	}else {
	  echo "Error: " . $sql . "<br>" . mysqli_error($conex);
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
</body>

