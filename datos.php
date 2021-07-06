<!DOCTYPE html>
<html>
<head>
	<title>Ver datos</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="path/to/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

	<style>
		h1{
			margin: auto;
		}
		table{
			width: 600px;
			margin: auto;
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
		tr:hover{
			background-color: #aaa;
		}
		#back{
			font-size: 50px;
			margin: auto;
			text-align: center;
			width: 100%;
		}
		th{
			background-color: #835959;
			font-size: 1.5em;
		}
		
	</style>
</head>
<body>
	<h1>DATOS DE LA TABLA CLIENTES</h1>
	
	<?php
		echo "<div><a id='back' href='index2.html'>Volver</a></div>";
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
