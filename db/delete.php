
<?php 
include'conexionDb.php';

if (isset($_GET['del'])) {
    $id = $_GET['del'];
    mysqli_query($conexion, "DELETE FROM experiencia WHERE id=$id");
    $_SESSION['message'] = "Registro eliminado"; 
    header('location: form_exp.php');
}

if (isset($_GET['del2'])) {
    $id = $_GET['del2'];
    mysqli_query($conexion, "DELETE FROM Empresas WHERE idempresa=$id");
    $_SESSION['message'] = "Registro eliminado"; 
    header('location: form_empresa.php');
}



function eliminarfoto(){
	include 'conexionDb.php';
	$id="1";
	$sql = "SELECT fotodir FROM usuario where iduser=('$id')";
	$result = mysqli_query($conexion, $sql);
	//$result = mysqli_fetch_assoc($result);
	$foto = $result['fotodir'];
	if (!empty($foto)){
		unlink($foto);
		}	
	mysqli_close($conexion);		
}
function eliminarcv(){
        include 'conexionDb.php';
	$id="1";
	$sql = "SELECT cvdir FROM usuario where iduser=('$id')";
	$result = mysqli_query($conexion, $sql);
	//$result = mysqli_fetch_assoc($result);
	$cv = $result['cvdir'];
	if (!empty($cv)){
		unlink($cv);
		}
	
	mysqli_close($conexion);		
}
?>
