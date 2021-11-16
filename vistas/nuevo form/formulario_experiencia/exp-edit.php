

<?php 

include ('conexionDb.php');
echo "dentro de edit ";
$idexp = $_POST['idexp'];
echo $idexp;
$empresa = $_POST['empresa'];
$puesto = $_POST['puesto'];
$desde = $_POST['desde'];
$hasta = $_POST['hasta'];
$contacto = $_POST['contacto'];

$query = "UPDATE `experiencia` SET `empresa`='$empresa', `puesto`='$puesto', `desde`='$desde', `hasta`='$hasta', `contacto`='$contacto' WHERE idexp='$idexp'";
$result = mysqli_query($conexion, $query);

if (!$result) {
    die('Query failed!');
}
echo "Task Update Successfully";  

?>