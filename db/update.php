
<?php
include('../db/conexionDb.php');
//-------------------------------------------------------------------------------------------- EXPERIENCIA
if (isset($_POST['update1'])) {
	$id = $_POST['id'];
	$empresa = $_POST['empresa'];
	$puesto = $_POST['puesto'];
	$desde = $_POST['desde'];
	$hasta = $_POST['hasta'];
	$contacto = $_POST['contacto'];
	$iduser = 9;
	$idempresa = 10;

	mysqli_query($db, "UPDATE experiencia SET iduser= '$iduser', idempresa='$idempresa', empresa='$empresa', puesto='$puesto', desde='$desde', hasta='$hasta', contacto='$contacto' WHERE id=$id");

	header('location: form_exp.php');
}
//-------------------------------------------------------------------------------------------- EMPRESA
if (isset($_POST['update2'])) {
	$id = $_POST['id'];
	$empnombre = test_input($_POST["empnombre"]);
	$rubro = test_input($_POST["rubro"]);
	$empdireccion = test_input($_POST["empdireccion"]);
	$empnumero = test_input($_POST["empnumero"]);
	$empemail = test_input($_POST["empemail"]);
	$encargado = test_input($_POST["encargado"]);
	$empciudad = test_input($_POST["empciudad"]);

	mysqli_query($db, "UPDATE experiencia SET nombre= '$empnombre', rubro='$rubro', direccion='$empdireccion', telefono='$empnumero', email='$empemail', encargado='$encargado', ciudad='$empciudad' WHERE id=$id");

	header('location: form_empresa.php');
}
?>
