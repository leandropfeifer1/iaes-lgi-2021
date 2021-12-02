
<?php
include('conexionDb.php');

$iduser = $_POST['iduser'];
$idempresa = 1;
$empresa = $_POST['empresa'];
$puesto = $_POST['puesto'];
$desde = $_POST['desde'];
$hasta = $_POST['hasta'];
$contacto = $_POST['contacto'];



$query = "INSERT INTO `experiencia`(`iduser`, `idempresa`, `empresa`, `puesto`, `desde`, `hasta`, `contacto`) VALUES ('$iduser','$idempresa','$empresa','$puesto','$desde','$hasta','$contacto')";
$result = mysqli_query($conexion, $query);
if (!$result) {
	die('Query failed!');
}


/*
$y = mysqli_query($conexion,"SELECT * FROM experiencia WHERE iduser='$id'");
		if(mysqli_num_rows($y) == 0){
			$x = mysqli_query($conexion,"INSERT INTO `experiencia`(`iduser`, `idempresa`, `empresa`, `puesto`, `desde`, `hasta`, `contacto`) VALUES ('$iduser','$idempresa','$empresa','$puesto','$desde','$hasta','$contacto')");
		}else{			
			$x = mysqli_query($conexion, "UPDATE `experiencia` SET `iduser`='$iduser',`idempresa`='$idempresa',`empresa`='$empresa',`puesto`='$puesto',`desde`='$desde',`hasta`='$hasta',`contacto`='$contacto' WHERE iduser='$iduser'");
			}	*/

?>


