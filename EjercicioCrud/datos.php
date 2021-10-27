<!DOCTYPE html>
<html>
<head>
	<title>Ver datos</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="style_datos.css">
</head>
<body>
	<h1>DATOS DE LA TABLA CLIENTES</h1>
	
	<?php
		echo "<div id='back-div'><a id='back' href='index2.html'>Volver</a></div>";
		
		require_once("config.php"); // Agregago de la conexion
		
		$sql = "SELECT id, nombre, email FROM clientes";
		$consulta = mysqli_query($conexion, $sql);
		
		if (mysqli_num_rows($consulta) > 0) {
			echo "<table>";
			echo "<tr>";
			echo "<th>ID</th>";
			echo "<th>Nombre</th>";
			echo "<th>Email</th>";
			echo "<th>    </th>";
			echo "</tr>";
			
		  while($fila = mysqli_fetch_assoc($consulta)) {
			echo "<tr>";
			echo "<td>".$fila['id']."</td>";
			echo "<td>".$fila['nombre']."</td>";
			echo "<td>".$fila['email']."</td>";
			echo "<td><a href='http://localhost/php-pineyro/iaes-lgi-2021/editar.php?idcol=".$fila['id']."'>Editar</a></td>"; // Poner un link con el ID de la fila, para editarlo
			echo "<td><a href='http://localhost/php-pineyro/iaes-lgi-2021/delete.php?id=".$fila['id']."'>Elimnar</a></td>";
			echo "</tr>";
		  }
		} else {
		  echo "0 resultados";
		}
		echo "</table>";
		mysqli_close($conexion);
	?>
		
</body>
</html>
