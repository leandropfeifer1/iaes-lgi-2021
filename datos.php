<!DOCTYPE html>
<html>
<head>
	<title>Ver datos</title>
	<meta charset="utf-8">
	<style>
		table{
			width: 550px;
			border: 1px solid black;
			border-collapse: collapse;
		}
		td, tr{
			min-width: 100px;
			padding: 5px;
		}
		td{
			text-align: center;
		}
		tr{
			text-align: center;
		}
		#back{
			font-size: 50px;
		}
	</style>
</head>
<body>
	<h1>DATOS DE LA TABLA CLIENTES</h1>
	
	<?php
		echo "<a id='back' href='index2.html'>Volver</a>";
		$servername = "localhost";
		$username = "pineyro";
		$password = "1234";
		$db = "ejphp";
		
		$conexion = mysqli_connect($servername, $username, $password, $db);
		if (!$conexion) {
		  die("Conexion fallida: " . mysqli_connect_error());
		}
		
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
