

<?php

//TRAE LA INFO DEL USUARIO Y LA CARGA EN LOS INPUTS
include '../db/conexionDb.php';

function mostrarPersonales()
{
	include '../db/conexionDb.php';
	$id = "1";
	$sql = "SELECT * FROM usuario where iduser=('$id')";
	$result = mysqli_query($conexion, $sql);
	$result = mysqli_fetch_assoc($result);
	mysqli_close($conexion);
	return $result;
}

function mostrarAcademicos()
{
	include '../db/conexionDb.php';
	$id = "189";
	$sql = "SELECT * FROM  where id=('$id')";
	$result = mysqli_query($conexion, $sql);
	//$result = mysqli_fetch_assoc($result);
	mysqli_close($conexion);
	return $result;
}

function mostrarHabilidades()
{
	include '../db/conexionDb.php';
	$id = "189";
	$sql = "SELECT * FROM  where id=('$id')";
	$result = mysqli_query($conexion, $sql);
	//$result = mysqli_fetch_assoc($result);
	mysqli_close($conexion);
        if ($result==null){
            printf("Sin resultados");
        }else{
	return $result;
        }
}

function mostrarPreferencias()
{
	include '../db/conexionDb.php';
	$id = "189";
	$sql = "SELECT * FROM  where id=('$id')";
	$result = mysqli_query($conexion, $sql);
	//$result = mysqli_fetch_assoc($result);
	mysqli_close($conexion);
	return $result;
}

function mostrarEmpresa()
{
	include '../db/conexionDb.php';
	$id = "16";
	$sql = "SELECT * FROM Empresas where idempresa=('$id')";
	$result = mysqli_query($conexion, $sql);
	$result = mysqli_fetch_assoc($result);
	mysqli_close($conexion);
	return $result;
}

function foto()
{
	$foto = "";
	$datos = mostrarPersonales();
	if (!empty($datos["fotodir"])) {
		$foto = $datos["fotodir"];
	} else {
		$foto = "img/iaes.png";
	}
	return $foto;
}
?>
