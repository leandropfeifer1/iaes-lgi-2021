
<?php
include('../conexionDb.php');

$iduser = $_POST['iduser'];
$empresa = $_POST['empresa'];
$puesto = $_POST['puesto'];
$desde = $_POST['desde'];
$hasta = $_POST['hasta'];
$contacto = $_POST['contacto'];

$query = "INSERT INTO `experiencia`(`iduser`, `empresa`, `puesto`, `desde`, `hasta`, `contacto`) VALUES ('$iduser','$empresa','$puesto','$desde','$hasta','$contacto')";
$result = mysqli_query($conexion, $query);
if (!$result) {
	die('Query failed!');
}
mysqli_close($conexion);
?>


