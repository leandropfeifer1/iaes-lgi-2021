

<?php 
	if (isset($_GET['edit1'])) {
		
		$id = $_GET['edit1'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM experiencia WHERE id=$id");

		if ($record) {
			$n = mysqli_fetch_array($record);
			$empresa = $n['empresa'];
			$puesto = $n['puesto'];
			$desde = $n['desde'];
			$hasta = $n['hasta'];
			$contacto = $n['contacto'];
			$iduser = $n['iduser'];
			$idempresa = $n['idempresa'];
		}
	}
	if (isset($_GET['edit2'])) {
		
		$id = $_GET['edit2'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM Empresas WHERE idempresa=$id");

		if ($record) {
			$n = mysqli_fetch_array($record);
			$nombre = $n[''];
			$rubro = $n[''];
			$direccion = $n[''];
			$email = $n[''];
			$contacto = $n[''];
			$encargado = $n[''];
			$ciudad = $n[''];
		}
	}
?>
